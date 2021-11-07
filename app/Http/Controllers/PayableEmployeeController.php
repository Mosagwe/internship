<?php

namespace App\Http\Controllers;

use App\Http\Traits\IncomeTaxTrait;
use App\Models\Contract;
use App\Models\PayableEmployee;
use App\Http\Controllers\Controller;
use App\Models\Payroll;
use App\Models\User;
use App\Notifications\ProcessedPayrollNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayableEmployeeController extends Controller
{
    use IncomeTaxTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payableemployees=PayableEmployee::all();
        return $payableemployees;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $ids = $request->ids;
        $period = $request->period;
        $contracts = Contract::whereIn('id', $ids)->get();


        foreach ($contracts as $contract) {
            if (isset($contract->employee->category)) {
                $days_worked=$this->getDays($contract->start_date,$contract->end_date);
                $entitled=$contract->employee->category->salary;
            }

            $payableEmployee = new PayableEmployee();
            $payableEmployee->employee_id = $contract->employee_id;
            $payableEmployee->firstname = $contract->employee->firstname;
            $payableEmployee->lastname = $contract->employee->lastname;
            $payableEmployee->othername = $contract->employee->othername;
            $payableEmployee->gender = $contract->employee->gender;
            $payableEmployee->period = $period;
            $payableEmployee->monthcode = date('Ym',strtotime($period));
            $payableEmployee->entitledsalary = $entitled;
            $payableEmployee->daysworked=$days_worked;
            $payableEmployee->station_id = $contract->station_id;
            $payableEmployee->employee_type_id = $contract->employee->employee_type_id;
            $payableEmployee->category_id = $contract->employee->category_id;
            $payableEmployee->krapin = $contract->employee->krapin;
            $payableEmployee->idno = $contract->employee->idno;
            $payableEmployee->payable =1;
            $payableEmployee->created_by = Auth::id();
            $payableEmployee->save();
        }



        //return redirect()->route('payrolls.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PayableEmployee  $payableEmployee
     * @return \Illuminate\Http\Response
     */
    public function show(PayableEmployee $payableEmployee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PayableEmployee  $payableEmployee
     * @return \Illuminate\Http\Response
     */
    public function edit(PayableEmployee $payableEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PayableEmployee  $payableEmployee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PayableEmployee $payableEmployee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PayableEmployee  $payableEmployee
     * @return \Illuminate\Http\Response
     */
    public function destroy(PayableEmployee $payableEmployee)
    {
        //
    }
}
