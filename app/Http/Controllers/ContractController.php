<?php

namespace App\Http\Controllers;

use App\DataTables\ContractDataTable;
use App\DataTables\ExpiredContractsDataTable;
use App\Mail\ContractExpiring;
use App\Models\Bank;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\PayableEmployee;
use App\Models\Payroll;
use App\Models\Station;
use App\Models\Unit;
use App\Notifications\ContractExpiringNotification;
use App\Notifications\ContractExpiryNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;


class ContractController extends Controller
{
    /**
     *
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContractDataTable $dataTable)
    {

        //return view('contracts.index2');
       return $dataTable->render('contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $stations = Station::all();
        $units = Unit::all();
        $banks = Bank::all();
        return view('contracts.create', compact('employees', 'stations', 'units', 'banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return redirect()->route('contract.index');
        $validator=Validator::make($request->all(),[
            'station_id'=>'required',
            'start_date'=>'required'
        ]);

       if($validator->fails()){
           return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);

       }else{
           $end_date=Carbon::createFromFormat('Y-m-d',$request->start_date)->addMonths(3)->format('Y-m-d');
           $contract=new Contract;
           $contract->employee_id=$request->employee_id;
           $contract->station_id=$request->station_id;
           $contract->start_date=$request->start_date;
           $contract->end_date=$end_date;

           if($contract->save()){
               return response()->json(['status'=>1,'msg'=>'Record created successfully']);
           }
       }


        //Contract::create($request->only('employee_id','station_id','start_date'));
        //return response()->json(['message'=>'Record saved successfully.'],200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        return view('contracts.show',compact('contract'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contract=Contract::find($id);
        return view('contracts.edit',compact('contract'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        $this->validate($request,[
            'start_date'=>'required',
            'station_id'=>'required',
        ]);

        $contract->start_date=Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $contract->end_date=Carbon::createFromFormat('d/m/Y', $request->start_date)->addMonths(3)->format('Y-m-d');
        $contract->station_id=$request->station_id;
        $contract->save();

        return redirect()->route('contract.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }

    public function terminate($id)
    {
        $contract = Contract::find($id);
        $contract->status = 0;
        if ($contract->save()) {
            return redirect()->route('contract.index');
        } else {
            return back();
        }

    }

    public function expiredContractForm(ExpiredContractsDataTable $dataTable)
    {
       return $dataTable->render('contracts.expired');
    }

    public function getPayableForm()
    {
        return view('contracts.payableemployees');
    }
    public function getpayable(Request $request)
    {
        $date = $request->period;
        $month=Carbon::createFromFormat('Y-m-d',$date)->format('m');
        $year=Carbon::createFromFormat('Y-m-d',$date)->format('Y');
        $p_ids = PayableEmployee::whereDate('period', $date)->pluck('employee_id')->all();
        $contracts = Contract::whereMonth('end_date','>=',$month)
            ->whereYear('end_date',$year)
            ->where('station_id',Auth::user()->station_id)
            ->whereNotIn('employee_id', $p_ids)->select('*')->get();

        return view('contracts.payableemployees', compact('contracts'));
    }
}
