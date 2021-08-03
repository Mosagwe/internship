<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayslipRequest;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\directoryExists;
use Crabbly\Fpdf\Fpdf as FPDF;

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

        $this->pdf = new FPDF('l', 'mm', 'a4');
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(30);
        $this->pdf->SetFont('Arial', 'B', 12);
        $this->pdf->Cell(33);
        $this->pdf->Ln(10);
        $this->pdf->Image('img/hudumalogo2.png',30,20,12);
        $this->pdf->Cell(15);
        $this->pdf->Cell(70, 6, 'The Presidency', 0, 0, 'C');
        $this->pdf->Ln();
        $this->pdf->SetFont('Arial', '', 10);
        $this->pdf->Cell(15);
        $this->pdf->Cell(70, 6, 'Ministry of Public Service & Gender Affairs', 0, 0, 'C');
        $this->pdf->Ln();
        $this->pdf->Cell(15);
        $this->pdf->Cell(70, 6, 'Huduma Kenya Secretariat', 0, 0, 'C');




        if (!file_exists(public_path('Payroll/Payregisters'))){
            mkdir(public_path('Payroll/Payregisters'),0777,true);
        }
        $filename=date('Ymdhi').'.pdf';
        $this->pdf->Output(public_path('Payroll/Payregisters/'.$filename),'F');

        return response()->json('Approved');

    }

    public function getpayslip(PayslipRequest $request)
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
