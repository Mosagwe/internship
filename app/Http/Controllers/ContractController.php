<?php

namespace App\Http\Controllers;

use App\DataTables\ContractDataTable;
use App\Models\Bank;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Station;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContractDataTable $dataTable)
    {
        return $dataTable->render('contracts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees=Employee::all();
        $stations=Station::all();
        $units=Unit::all();
        $banks=Bank::all();
        return view('contracts.create',compact('employees','stations','units','banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
            'employee_id'=>'required',
          'firstname'=>'required'
          /* 'emptype'=>'required',
            'start_date'=>'required',
            'station_id'=>'required',
            'unit_id'=>'required',
            'salary'=>'required_if:emptype,casual',
            'bank_id'=>'required',
            'bank_branch'=>'required',
            'bank_account'=>'required',*/
        ]);

       return $request->all();

       /* $end_date=Carbon::createFromFormat('d/m/Y',$request->start_date)->addMonths(3)->format('Y-m-d');

        Contract::create([
            'employee_id'=>$request->employee_id,
            'employee_type'=>$request->emptype,
            'start_date'=>Carbon::createFromFormat('d/m/Y',$request->start_date)->format('Y-m-d'),
            'end_date'=>$end_date,
            'station_id'=>$request->station_id,
            'unit_id'=>$request->unit_id,
            'salary'=>$request->salary,
            'bank_id'=>$request->bank_id,
            'bank_branch'=>$request->bank_branch,
            'bank_account'=>$request->bank_account,
        ]);*/



        //return redirect()->route('contract.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
