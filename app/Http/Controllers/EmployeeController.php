<?php

namespace App\Http\Controllers;


use App\DataTables\EmployeesDataTable;
use App\Http\Resources\EmployeeResource;
use App\Models\Bank;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\Qualification;
use App\Models\Station;
use App\Models\Unit;
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
    public function index(EmployeesDataTable $dataTable)
    {
        return $dataTable->render('employees.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualifications=Qualification::all();
        $stations=Station::all();
        $units=Unit::all();
        return view('employees.create',compact('qualifications','stations','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation=$this->validate($request,[
            'firstname'=>'required',
            'lastname'=>'required',
            'gender'=>'required',
            'idno'=>'required|unique:employees|max:15',
            'email'=>'required|email|unique:employees',
            'phonenumber'=>'required|unique:employees|max:15',
            'krapin'=>'required|unique:employees|max:15',
            'qualification_id'=>'required',
            'coursename'=>'required',
            'date_hired'=>'required',
            'emptype'=>'required',
            'station_id'=>'required',
            'unit_id'=>'required',
            'duration'=>'required',
            'salary'=>'required_if:emptype,casual',
            'start_date'=>'required'
        ]);

        if (!$validation)
        {
            redirect()->back()->withInput();
        }

        $end_date=Carbon::createFromFormat('d/m/Y',$request->start_date)->addMonths($request->duration)->format('Y-m-d');

        DB::transaction(function () use ($request,$end_date) {
            $employee=Employee::create([
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'middlename'=>$request->othername,
                'gender'=>$request->gender,
                'idno'=>$request->idno,
                'email'=>$request->email,
                'phonenumber'=>$request->phonenumber,
                'krapin'=>$request->krapin,
                'qualification_id'=>$request->qualification_id,
                'coursename'=>$request->coursename,
                'date_hired'=>$request->date_hired,
                'is_active'=>1
            ]);

            $contract=Contract::create([
                'user_id'=>$employee->id,
                'employee_type'=>$request->emptype,
                'start_date'=>Carbon::createFromFormat('d/m/Y',$request->start_date)->format('Y-m-d'),
                'end_date'=>$end_date,
                'station_id'=>$request->station_id,
                'unit_id'=>$request->unit_id,
                'salary'=>$request->salary,
            ]);
        });

        return redirect()->route('employee.index');




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function getEmployees()
    {
        $employees=Employee::all();
        $stations=Station::all();
        $units=Unit::all();
        $banks=Bank::all();

        return response()->json([
            'employees'=>$employees,
            'stations'=>$stations,
            'units'=>$units,
            'banks'=>$banks
        ],200);
    }
}
