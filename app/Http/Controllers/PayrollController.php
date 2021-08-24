<?php

namespace App\Http\Controllers;

use App\DataTables\PayrollDataTable;
use App\Http\Traits\IncomeTaxTrait;
use App\Jobs\SendBulkPayslipsJob;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Payroll;
use App\Http\Controllers\DownloadController;

//use Barryvdh\DomPDF\PDF;

use App\Models\Sendbulkypayslip;
use App\Models\User;
use App\Notifications\ProcessedPayrollNotification;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PayrollController extends Controller
{
    use IncomeTaxTrait;

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $latestDate = Payroll::max('period');
          //$payrolls=Payroll::whereDate('period',$latestDate)->get();
          $payrolls = Payroll::whereDate('period', $latestDate)->groupBy('category_id', 'period', 'status')
              ->orderBy(DB::raw('COUNT(id)', 'desc'))
              ->get(array('category_id', 'period', 'status', DB::raw('count(category_id) as categorycount,sum(taxableincome) as totaltaxable,sum(paye) as totalpaye,sum(net_income) as totalnetincome')));
          return view('payrolls.index', compact('payrolls'));

        /*foreach ($payrolls as $payroll){
            echo $payroll->category->name.'  -  '. $payroll->totals .'<br>';
        }*/

        /*$period = $request->period;
        $category = $request->category;
        $payrolls = Payroll::whereDate('period', $period)
            ->whereIn('category_id', $category)
            ->get();

        if(!count($payrolls)){
            $payrolls = Payroll::whereDate('period', $period)->get();
        }*/

        /*$categories = Category::all();
        if ($request->has('period') && $request->has('category') && $request->category != null) {
            $payrolls = Payroll::whereDate('period', $period)
                ->where('category_id', $category)
                ->get();
            return view('payrolls.index', compact('categories', 'payrolls'));
        } elseif ($request->has('period') && $request->category == null) {
            $payrolls = Payroll::whereDate('period', $period)
                ->paginate(10);
            return view('payrolls.index', compact('categories', 'payrolls'));
        }*/

        //return view('payrolls.index', compact('payrolls'));

        /*if ($request->ajax()){
          $data=Payroll::latest()->get();


          return DataTables::of($data)
              ->addIndexColumn()
              ->addColumn('status', function($row){
                  if($row->status){
                      return '<span class="badge badge-success">approved</span>';
                  }else{
                      return '<span class="badge rounded-pill badge-warning">pending approval</span>';
                  }
              })
              ->filter(function ($instance) use($request){
                 if (!empty($request->get('period'))) {
                      $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                          return Str::contains($row['period'], $request->get('period')) ? true : false;
                      });
                  }
                  if (!empty($request->get('category'))) {
                      $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                          return Str::contains($row['category_id'], $request->get('category')) ? true : false;
                      });

                  }
                  if (!empty($request->get('search'))) {
                      $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                          if (Str::contains(Str::lower($row['gender']), Str::lower($request->get('search')))){
                              return true;
                          }else if (Str::contains(Str::lower($row['idno']), Str::lower($request->get('search')))) {
                              return true;
                          }
                          return false;

                      });
                  }
              })

              ->addColumn('action',function ($row){
                  $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                  return $btn;
              })
              ->rawColumns(['status','action'])
              ->make(true);
      }*/
        //return view('payrolls.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payrolls.runpayroll');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ids = $request->ids;
        $period = $request->period;

        $contracts = Contract::active()->whereIn('id', $ids)->get();
        $taxable = 0;
        $grosstax = 0;
        $p_relief = 2400;
        $paye = 0;
        $netincome = 0;
        $paycode = uniqid();

        foreach ($contracts as $contract) {
            if (isset($contract->employee->category)) {
                $days_worked=$this->getDays($contract->start_date,$contract->end_date);
                $entitled=$contract->employee->category->salary;
                $grossincome=round($this->prorataRatio($days_worked) * $entitled,2);
                $taxable = $grossincome;

                $grosstax = $this->taxation($taxable);

                if (($grosstax - $p_relief) <= 0) {
                    $paye = 0;
                } else {
                    $paye = round($grosstax - $p_relief, 1);
                }
                $netincome = round($taxable - $paye, 1);
            }

            $payroll = new Payroll();
            $payroll->employee_id = $contract->employee_id;
            $payroll->fullname = $contract->employee->full_name;
            $payroll->gender = $contract->employee->gender;
            $payroll->period = $period;
            $payroll->paycode = $paycode;
            $payroll->entitledsalary = $entitled;
            $payroll->daysworked=$days_worked;
            $payroll->grossincome = $grossincome;
            $payroll->taxableincome = $taxable;
            $payroll->grosstax = $grosstax;
            $payroll->personal_relief = $p_relief;
            $payroll->paye = $paye;
            $payroll->net_income = $netincome;
            $payroll->station_id = $contract->station_id;
            $payroll->employee_type_id = $contract->employee->employee_type_id;
            $payroll->category_id = $contract->employee->category_id;
            $payroll->krapin = $contract->employee->krapin;
            $payroll->idno = $contract->employee->idno;
            $payroll->save();
        }


        \Illuminate\Support\Facades\Notification::send(User::hrmanager(), new ProcessedPayrollNotification($payroll));
        return redirect()->route('payrolls.index');
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Payroll $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Payroll $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll $payroll)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Payroll $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Payroll $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        //
    }

    /*
     * Fetch employees whose contract is active for payroll processing
     */

    public function getEmployees(Request $request)
    {
        $date = $request->period;
        $p_ids = Payroll::whereDate('period', $date)->pluck('employee_id')->all();
        $contracts = Contract::active()->whereNotIn('employee_id', $p_ids)->select('*')->get();

        return view('payrolls.runpayroll', compact('contracts'));
    }

    public function showSearchForm()
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        return view('payrolls.search', compact('categories'));

    }

    public function getPayrollRecords(Request $request)
    {
        $this->validate($request, [
            'period' => 'required',
            'category' => 'required',
        ]);

        $period = $request->period;
        $category = $request->category;

        $payrolls = Payroll::whereDate('period', $period)
            ->where('status', 1)
            ->whereIn('category_id', $category)
            ->get();

        return view('payrolls.payregister', compact('payrolls'));


    }

    public function pending()
    {
        //$data=Payroll::where('status',0)->get();
        /* $payrolls=Payroll::where('status',0)->groupBy('period','paycode')
             ->orderBy(DB::raw('COUNT(id)','desc'))
             ->get(array('period','paycode',DB::raw('count(id) as paycount,sum(taxableincome) as totaltaxable,sum(paye) as totalpaye,sum(net_income) as totalnetincome')));
         return view('payrolls.pending',compact('payrolls'));*/
        return view('payrolls.pending');

    }

    public function prorataRatio($days)
    {
        $monthdays=Carbon::now()->daysInMonth;
        $ratio=round($days/$monthdays,4);
        return $ratio;
    }


    public function getDays($start, $end)
    {
        $currmonth = Carbon::now();
        if ($currmonth->format('m-Y') == Carbon::createFromFormat('Y-m-d', $start)->format('m-Y')) {
            $startdate = new Carbon($start);
            $nodays = $startdate->diffInDays($currmonth->endOfMonth());
        } elseif ($currmonth->format('m-Y') == Carbon::createFromFormat('Y-m-d', $end)->format('m-Y')) {
            $startdate = $currmonth->startOfMonth();
            $nodays = $startdate->diffInDays($end);
            $nodays = $nodays + 1;
        } else {
            $nodays = $currmonth->daysInMonth;
        }
        return $nodays;
    }

    public function payslipform()
    {
        return view('payrolls.payslipform');
    }

    public function payslipformall()
    {
        return view('payrolls.payslipformall');
    }

    public function getpayslip(Request $request)
    {
        $this->validate($request, [
            'period' => 'required',
            'idnumber' => 'required'
        ],
            [
                'period.required' => 'Please select the month!',
                'idnumber.required' => 'The ID number is required!',
            ]);
        $period = $request->period . '-01';

        $payslip = Payroll::whereDate('period', $period)
            ->where('status', 1)
            ->where('idno', $request->idnumber)
            ->first();

        return view('payrolls.payslipform', compact('payslip'));

    }

    public function getpayslipsAll(Request $request)
    {
        $this->validate($request, [
            'period' => 'required'
        ],
            [
                'period.required' => 'Please select the month!',
            ]);
        $period = $request->period . '-01';

        $payslips = Payroll::whereDate('period', $period)
            ->where('status', 1)
            ->get();

        return view('payrolls.payslipformall', compact('payslips'));

    }

    public function sendBulkPayslips($month)
    {
        ini_set('memory_limit', -1);
        $model = new Sendbulkypayslip();
        $model->period = $month;
        $model->created_by = Auth::id();
        $model->updated_by = Auth::id();
        $model->save();

        $job = (new SendBulkPayslipsJob($model))
            ->delay(Carbon::now()->addMinute());
        $this->dispatch($job);

        return redirect('/home');
        /*$payrolls=Payroll::where('period',$month)->chunk(10,function($pays){
              foreach ($pays as $pay){
                  $this->emailPayslip($pay);
              }

        });*/
        /* Payroll::where('period',$month)->chunk(10,function($pays){
             foreach ($pays as $pay){
                 $this->emailPayslip($pay);
             }
         });*/

    }

    public function emailPayslip($pay)
    {
        ini_set('memory_limit', -1);
        $download = new DownloadController();
        $path = $download->payslip($pay->id, "FilePath");

        $files = $path . '' . $pay->id . '.pdf';

        $name = $pay->fullname;
        $email = $pay->employee->email;
        $email = 'pomosagwe@gmail.com';

        $body = 'Attached find your' . date('F Y', strtotime($pay->period)) . ' payslip.';
        $subject = 'Payslip';
        $cc_email = 'test@hks.com';
        $attachpath = array($files);

        $mail = \Mail::send('mail.layout', ['mail_body' => $body], function ($message) use ($email, $name, $attachpath, $subject, $cc_email) {

            $message->to($email, $name)
                ->from('no-reply@hudumakenya.go.ke', 'Huduma Kenya Secretariat')
                ->subject($subject);;

            foreach ($attachpath as $path) {
                $message->attach($path);
            }

        });
    }
}
