<?php

namespace App\Http\Controllers;

use App\DataTables\PayrollDataTable;
use App\Http\Traits\IncomeTaxTrait;
use App\Models\Contract;
use App\Models\Payroll;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    use IncomeTaxTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PayrollDataTable $dataTable)
    {
        return $dataTable->render('payrolls.index');
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
        $period=$request->period;

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
                $grosstax=$this->taxation($taxable);

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
        /*foreach ($contracts as $contract) {
            if ($contract->employee->category->salary > 0) {
                echo $contract->employee_id . '<br>';
                echo $contract->employee->full_name . '<br>';
                echo $contract->employee->category->salary . '<br>';
            }
        }*/
    }
}
