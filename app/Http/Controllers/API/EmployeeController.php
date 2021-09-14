<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Contract;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $end_date = Carbon::createFromFormat('Y-m-d', $request->start_date)->addMonths(3)->format('Y-m-d');

        DB::transaction(function () use ($request, $end_date) {
            $employee = Employee::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'middlename' => $request->othername,
                'gender' => $request->gender,
                'idno' => $request->idno,
                'email' => $request->email,
                'employee_type_id' => $request->emptype_id,
                'phonenumber' => $request->phonenumber,
                'krapin' => $request->krapin,
                'qualification_id' => $request->qualification_id,
                'category_id' => $request->category_id,
                'coursename' => $request->coursename,
                'date_hired' => $request->date_hired,
                'is_active' => 1,
                'next_of_kin'=>$request->next_of_kin,
                'next_of_kin_phone'=>$request->next_of_kin_phone,
                'next_of_kin_relation'=>$request->next_of_kin_relation,
                'dob'=>$request->dob,
                'pwd'=>$request->pwd,
                'pwd_category'=>$request->pwd_no,
                'ref1_name'=>$request->ref1_name,
                'ref1_email'=>$request->ref1_email,
                'ref1_phone'=>$request->ref1_phone,
                'ref1_occupation'=>$request->ref1_occupation,
                'ref1_period'=>$request->ref1_period,
                'ref2_name'=>$request->ref2_name,
                'ref2_email'=>$request->ref2_email,
                'ref2_phone'=>$request->ref2_phone,
                'ref2_occupation'=>$request->ref2_occupation,
                'ref2_period'=>$request->ref2_period,
            ]);

            $contract = Contract::create([
                'employee_id' => $employee->id,
                'employee_type_id' => $employee->employee_type_id,
                'start_date' => Carbon::createFromFormat('Y-m-d', $request->start_date)->format('Y-m-d'),
                'end_date' => $end_date,
                'station_id' => $request->station_id,
                'category_id' => $request->category_id,
            ]);
        });

        return response()->json(['message'=>'Record created successfully'],200);

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
