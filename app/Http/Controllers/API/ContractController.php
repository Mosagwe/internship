<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return 'Uko sawa';
       /* $this->validate($request,[
            'employee_id'=>'required',
            //'firstname'=>'required',
             'emptype'=>'required',
             // 'start_date'=>'required',
              //'station_id'=>'required',
              'unit_id'=>'required',
              'salary'=>'required_if:emptype,casual',
              'bank_id'=>'required',
              'bank_branch'=>'required',
              'bank_account'=>'required',
        ]);*/



        $end_date=Carbon::createFromFormat('Y-m-d',$request->start_date)->addMonths(3)->format('Y-m-d');

         Contract::create([
             'employee_id'=>$request->employee_id,
             'employee_type'=>$request->emptype,
             'start_date'=>Carbon::createFromFormat('Y-m-d',$request->start_date)->format('Y-m-d'),
             'end_date'=>$end_date,
             'station_id'=>$request->station_id,
             'unit_id'=>$request->unit_id,
             'salary'=>$request->salary,
             'bank_id'=>$request->bank_id,
             'bank_branch'=>$request->bank_branch,
             'bank_account'=>$request->bank_account,
         ]);

        return redirect()->route('contract.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
