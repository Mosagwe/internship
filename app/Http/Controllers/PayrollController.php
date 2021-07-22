<?php

namespace App\Http\Controllers;

use App\DataTables\PayrollDataTable;
use App\Http\Traits\IncomeTaxTrait;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Payroll;

//use Barryvdh\DomPDF\PDF;

use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PayrollController extends Controller
{
    use IncomeTaxTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $period = $request->period;
        $category = $request->category;
        $payrolls = Payroll::whereDate('period', $period)
            ->whereIn('category_id', $category)
            ->get();

        if(!count($payrolls)){
            $payrolls = Payroll::whereDate('period', $period)->get();
        }

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

        return view('payrolls.index', compact('payrolls',));

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
                $taxable = $contract->employee->category->salary;
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
            $payroll->gender = $contract->employee->gender;
            $payroll->period = $period;
            $payroll->paycode = $paycode;
            $payroll->grossincome = $contract->employee->category->salary;
            $payroll->taxableincome = $taxable;
            $payroll->grosstax = $grosstax;
            $payroll->personal_relief = $p_relief;
            $payroll->paye = $paye;
            $payroll->net_income = $netincome;
            $payroll->station_id = $contract->station_id;
            $payroll->employee_type_id = $contract->employee_type_id;
            $payroll->category_id = $contract->employee->category_id;
            $payroll->krapin = $contract->employee->krapin;
            $payroll->idno = $contract->employee->idno;
            $payroll->save();
        }
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
            ->whereIn('category_id', $category)
            ->get();

        if(!count($payrolls)){
            $payrolls = Payroll::whereDate('period', $period)->get();
        }

        $pdf = PDF::loadView('payrolls.schedule', compact('payrolls'))
            ->setOptions(['defaultFont' => 'sans-serif'])
            ->setPaper('a4', 'landscape');
        //return $pdf->download('payrolls.pdf');
        return $pdf->stream('payrolls.pdf', array("Attachment" => false));

        //return view('payrolls.index', compact('payrolls'));

    }
}
