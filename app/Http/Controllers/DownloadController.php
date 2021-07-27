<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Barryvdh\DomPDF\Facade as PDF;
use Crabbly\Fpdf\Fpdf as FPDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Svg\Tag\Rect;

class DownloadController extends Controller
{
    public function payregister(Request $request)
    {
        $categories = $request->category_id;
        $period = $request->period;
        $payrolls = Payroll::whereDate('period', $period)
            ->where('status', 1)
            ->whereIn('category_id', $categories)
            ->get();
        if ($payrolls->count() > 0) {
            $pdf = PDF::loadView('payrolls.schedule', compact('payrolls'))
                ->setOptions(['defaultFont' => 'sans-serif'])
                ->setPaper('a4', 'landscape');
            return $pdf->stream('payrolls.pdf', array("Attachment" => false));
        }


        /*
         * Store the pdf;
         */
        /* $path=public_path('pdfs');
         $fileName='payregister.pdf';
         $pdf->save($path.'/'.$fileName);*/
        /*
         * To download the pdf
         */
        //return $pdf->download('payrolls.pdf');

        //return view('payrolls.index', compact('payrolls'));

    }

    public function payslip($id)
    {


        $payslip = Payroll::find($id);
        if ($payslip):
            $this->pdf = new FPDF('p', 'mm', 'a4');
            $this->pdf->AddPage();
            $this->pdf->AliasNbPages();
            $this->pdf->SetLeftMargin(30);
            $this->pdf->SetDrawColor(36,94,51);
            $this->pdf->Rect(25,15,95,137);


            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->SetFillColor(255,0,0);
            //$this->pdf->Cell(30, 8, '', 1, 0, 'L');
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

            $this->pdf->SetDrawColor(250,0,0);
            $this->pdf->Line(27,40,117,40);
            $this->pdf->Line(27,40,117,40);

            $this->pdf->SetDrawColor(36,94,51);
            $this->pdf->Line(27,41,117,41);
            $this->pdf->Line(27,41,117,41);

            $this->pdf->Ln(10);
            $this->pdf->SetFont('Arial', 'B', 16);
            $this->pdf->Cell(85, 8, 'Payslip', 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->Cell(80, 8, 'Period : ' . date('F Y', strtotime($payslip->period)), 0, 0, 'L');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial', '', 11);
            $this->pdf->Cell(25, 4, 'Name', 0, 0, 'L');
            $this->pdf->Cell(60, 4, ': ' . strtoupper( $payslip->fullname), 0, 0, 'L');
            $this->pdf->Ln(5);

            //$pdf->Cell(15);
            $this->pdf->Cell(25, 4, 'KRA PIN', 0, 0, 'L');
            $this->pdf->Cell(60, 4, ': '. strtoupper($payslip->krapin), 0, 0, 'L');
            $this->pdf->Ln(5);
            $this->pdf->Cell(25, 4, 'ID Number', 0, 0, 'L');
            $this->pdf->Cell(60, 4, ': ' . $payslip->idno, 0, 0, 'L');
            //
            $this->pdf->Ln(8);
            $this->pdf->SetFont('Arial', 'BI', 12);
            $this->pdf->SetFillColor(255,0,0);
            $this->pdf->Cell(50, 4, 'Payment Description', 0, 0, 'L');
            $this->pdf->Cell(35, 4, 'KShs', 0, 0, 'C');
            $this->pdf->Ln(5);
            //
            $this->pdf->SetFont('Arial', '', 11);
            $this->pdf->Cell(8);
            $this->pdf->Cell(42, 4, 'Basic Salary', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)$payslip->grossincome, 2, '.', ','), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->Cell(8);
            $this->pdf->Cell(42, 4, 'Other Allowances', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)0, 2, '.', ','), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->Cell(4);
            $this->pdf->Cell(46, 4, 'Gross Income', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)$payslip->grossincome, 2, '.', ','), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->SetFont('Arial', '', 11);
            $this->pdf->Cell(4);
            $this->pdf->Cell(46, 4, 'Taxable Income', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)$payslip->taxableincome, 2, '.', ' '), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->Cell(8);
            $this->pdf->Cell(42, 4, 'Taxable Tax', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)$payslip->grosstax, 2, '.', ','), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->Cell(8);
            $this->pdf->Cell(42, 4, 'Personal Relief', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)$payslip->personal_relief, 2, '.', ' '), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->Cell(8);
            $this->pdf->Cell(42, 4, 'PAYE', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)$payslip->paye, 2, '.', ' '), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->Cell(4);
            $this->pdf->Cell(46, 4, 'Total Deductions', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)$payslip->paye, 2, '.', ' '), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->Cell(4);
            $this->pdf->Cell(46, 4, 'Net Salary', 0, 0, 'L');
            $this->pdf->Cell(35, 4, number_format((float)$payslip->net_income, 2, '.', ' '), 0, 0, 'R');
            $this->pdf->Ln(5);
            $this->pdf->Image('img/frame.png',90,125,25);


            //$this->pdf->Output();
            $headers=['Content-type'=>'application/pdf'];

            return Response::make($this->pdf->Output(), 200, $headers);
            //exit;
        endif;


        /* if ($payslip) {
             $pdf = PDF::loadView('payrolls.payslippdf', compact('payslip'))
                 ->setOptions(['defaultFont' => 'sans-serif'])
                 ->setPaper('a4');

              return $pdf->download('payslip.pdf');
             // return view('payrolls.payslippdf',compact('payslip'));
              //return $pdf->stream('payslip.pdf', array("Attachment" => false));
             //return view('payrolls.payslippdf',compact('payslip'));
          }*/

    }
}
