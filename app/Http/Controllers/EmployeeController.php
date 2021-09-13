<?php

namespace App\Http\Controllers;


use App\DataTables\EmployeesDataTable;
use App\Http\Resources\EmployeeResource;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Contract;
use App\Models\Employee;
use App\Models\EmployeeType;
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
        $qualifications = Qualification::all();
        $stations = Station::all();
        $emptypes = EmployeeType::all();
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        return view('employees.addemployee', compact('qualifications', 'emptypes', 'stations', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'dob' => 'required',
            'idno' => 'required|unique:employees|max:15',
            'email' => 'required|email|unique:employees',
            'phonenumber' => 'required|unique:employees|max:15',
            'krapin' => 'required|unique:employees|max:15',
            'qualification_id' => 'required',
            'coursename' => 'required',
            'date_hired' => 'required',
            'emptype_id' => 'required',
            'station_id' => 'required',
            'category_id' => 'required',
            'start_date' => 'required',
            'next_of_kin'=>'required',
            'next_of_kin_phone'=>'required',
            'next_of_kin_relation'=>'required',
            'pwd'=>'required',
            'pwd_no'=>'nullable',
            'ref1_name'=>'required',
            'ref1_email'=>'required',
            'ref1_phone'=>'required',
            'ref1_occupation'=>'required',
            'ref1_period'=>'required',
            'ref2_name'=>'required',
            'ref2_email'=>'required',
            'ref2_phone'=>'required',
            'ref2_occupation'=>'required',
            'ref2_period'=>'required',
        ]);

        if (!$validation) {
            redirect()->back()->withInput();
        }

        $end_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->addMonths(3)->format('Y-m-d');

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
                'pwd_category'=>$request->pwd_category,
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
                'employee_type_id' => $request->emptype_id,
                'start_date' => Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d'),
                'end_date' => $end_date,
                'station_id' => $request->station_id,
                'category_id' => $request->category_id,
            ]);
        });


        return redirect()->route('employee.index');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $qualifications = Qualification::all();
        $stations = Station::all();
        $emptypes = EmployeeType::all();
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        return view('employees.edit', compact('qualifications', 'emptypes', 'stations', 'categories', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
         $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'idno' => 'required|max:15|unique:employees,idno,' . $employee->id,
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'phonenumber' => 'required|max:15',
            'krapin' => 'required|max:15|unique:employees,krapin,'.$employee->id,
            'qualification_id' => 'required',
            'coursename' => 'required',
            'date_hired' => 'required',
            'emptype_id' => 'required',
            'category_id' => 'required',
        ]);

        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->middlename = $request->middlename;
        $employee->gender = $request->gender;
        $employee->idno = $request->idno;
        $employee->email = $request->email;
        $employee->employee_type_id = $request->emptype_id;
        $employee->phonenumber = $request->phonenumber;
        $employee->krapin = $request->krapin;
        $employee->qualification_id = $request->qualification_id;
        $employee->category_id = $request->category_id;
        $employee->coursename = $request->coursename;
        $employee->date_hired = $request->date_hired;
        $employee->save();

        return redirect()->route('employee.show', $employee->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //$employee=Employee::find(Employee $employee);
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Record deleted successfully');

    }

    public function changeStatus($id)
    {
        $employee = Employee::find($id);
        $employee->is_active = !$employee->is_active;
        if ($employee->save()) {
            return redirect()->route('employee.index');
        } else {
            return back();
        }

    }


}
