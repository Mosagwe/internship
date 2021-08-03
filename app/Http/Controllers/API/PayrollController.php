<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayslipRequest;
use App\Http\Traits\PDFTrait;
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
        $count = 1;

        $this->pdf = new PDFTrait('L', 'mm', 'a4');
        $this->pdf->AliasNbPages();
        $this->pdf->SetAutoPageBreak(false);
        //add first page
        $this->pdf->AddPage();
        //set initial y axis position per page
        $y_axis_initial = 35;

        $this->pdf->SetLeftMargin(10);
        $this->pdf->SetFont('Arial', '', 10);
        //set title
        $this->pdf->Cell(70);
        //$pdf->Ln(4);
        $this->pdf->Cell(90, 8, 'Payroll Register for the Month of ' . date('F Y', strtotime($payrolls[0]->period)));
        $this->pdf->Ln(10);
        // column headers
        $this->pdf->SetLeftMargin(10);
        $this->pdf->SetFont('Arial', '', 10);
        //set title
        $this->pdf->Cell(70);
        $this->pdf->Ln(20);

        //column headers
        $this->pdf->SetFont('Arial', 'b', 8);
        $this->pdf->SetY($y_axis_initial);
        $this->pdf->SetX(15);
        $this->pdf->Cell(8, 8, 'SN', 1, 0, 'C');
        $this->pdf->Cell(50, 8, 'Name', 1, 0, 'C');
        $this->pdf->Cell(15, 8, 'Gender', 1, 0, 'C');
        $this->pdf->Cell(30, 8, 'KRA PIN', 1, 0, 'C');
        $this->pdf->Cell(50, 8, 'Category', 1, 0, 'C');
        $this->pdf->Cell(25, 8, 'Gross', 1, 0, 'C');
        $this->pdf->Cell(25, 8, 'Taxable', 1, 0, 'C');
        $this->pdf->Cell(25, 8, 'PAYE', 1, 0, 'C');
        $this->pdf->Cell(25, 8, 'Net Due', 1, 0, 'C');
        //$pdf->Cell(16,8,'IFMIS No',1,0,'C');
        //Set Row Height
        $row_height = 8;
        $y_axis = $y_axis_initial + $row_height;
        //initialize counter
        $i = 0;
        //Set maximum rows per page
        $max = 15;
        //Set Row Height
        $row_height = 8;
        foreach ($payrolls as $key => $d) {
            if ($i == $max) {
                $this->pdf->AddPage();
                //print column titles for the current page
                $this->pdf->SetFont('Arial', 'b', 8);
                $this->pdf->SetY($y_axis_initial);
                $this->pdf->SetX(15);
                $this->pdf->Cell(8, 8, 'SN', 1, 0, 'C');
                $this->pdf->Cell(50, 8, 'Name', 1, 0, 'C');
                $this->pdf->Cell(15, 8, 'Gender', 1, 0, 'C');
                $this->pdf->Cell(30, 8, 'KRA PIN', 1, 0, 'C');
                $this->pdf->Cell(50, 8, 'Category', 1, 0, 'C');
                $this->pdf->Cell(25, 8, 'Gross', 1, 0, 'C');
                $this->pdf->Cell(25, 8, 'Taxable', 1, 0, 'C');
                $this->pdf->Cell(25, 8, 'PAYE', 1, 0, 'C');
                $this->pdf->Cell(25, 8, 'Net Due', 1, 0, 'C');
                //Go to next row
                $y_axis = $y_axis_initial + $row_height;

                //Set $i variable to 0 (first row)
                $i = 0;
            }
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Ln();
            //foreach($row as $column)
            $this->pdf->SetY($y_axis);
            $this->pdf->SetX(15);
            $this->pdf->Cell(8, 8, $count . '.', 1, 0, 'R');
            if ($d->employee->pwd == 1) {
                $this->pdf->Cell(50, 8, $d->employee->fullname . ' * ', 1);
            } else {
                $this->pdf->Cell(50, 8, $d->employee->fullname, 1);
            }

            $this->pdf->Cell(15, 8, $d->employee->gender, 1);
            $this->pdf->Cell(30, 8, strtoupper($d->employee->krapin), 1);
            $this->pdf->Cell(50, 8, $d->employee->category->name, 1);
            $this->pdf->Cell(25, 8, number_format(round($d->grossincome, 1), 2, '.', ','), 1, 0, 'R');
            $this->pdf->Cell(25, 8, number_format(round($d->taxableincome, 1), 2, '.', ','), 1, 0, 'R');
            $this->pdf->Cell(25, 8, number_format(round($d->paye, 1), 2, '.', ','), 1, 0, 'R');


            $this->pdf->SetFont('Arial', 'B', 10);
            $this->pdf->Cell(25, 8, number_format(round($d->net_income, 1), 2, '.', ','), 1, 0, 'R');
            $this->pdf->SetFont('Arial', 'BI', 7);
            //$pdf->Cell(16,8,$d->ifmisno,1,0,'R');
            //$count+=1;
            //Go to next row
            $y_axis = $y_axis + $row_height;
            $i = $i + 1;
            $count += 1;

        }
        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Ln();
        $this->pdf->Cell(21);
        $this->pdf->Cell(137,6,'Grand Totals: (KSH)',0);
        $this->pdf->Cell(25,6,number_format((float)round($payrolls->sum('grossincome'),1), 2, '.', ','),1,0,'R');
        $this->pdf->Cell(25,6,number_format((float)round($payrolls->sum('grossincome'),1), 2, '.', ','),1,0,'R');
        $this->pdf->Cell(25,6,number_format((float)round($payrolls->sum('paye'),1), 2, '.', ','),1,0,'R');
        $this->pdf->Cell(25,6,number_format((float)round($payrolls->sum('net_income'),1), 2, '.', ','),1,0,'R');





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
