<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayslipRequest;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    public function pending()
    {
        $data=Payroll::where('status',0)->groupBy('period','paycode')
            ->orderBy(DB::raw('COUNT(id)','desc'))
            ->get(array('period','paycode',DB::raw('count(id) as paycount,sum(taxableincome) as totaltaxable,sum(paye) as totalpaye,sum(net_income) as totalnetincome')));

        return response()->json(['data'=>$data]);

    }

    public function approve($paycode)
    {
        $payrolls=Payroll::where('paycode',$paycode)->get();
        foreach ($payrolls as $payroll){
            $payroll->status=1;
            $payroll->save();
        }
        return response()->json('Approved');
    }

    public function getpayslipsAll(PayslipRequest $request)
    {
        $period=$request->period.'-01';
        $idno=$request->idnumber;
        $payslips=Payroll::whereDate('period',$period)
            ->where('status',1)
            ->where('idno',$idno)
            ->get();
        return response()->json(['payslips'=>$payslips]);
    }
}
