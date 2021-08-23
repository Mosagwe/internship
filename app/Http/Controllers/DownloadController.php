<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Traits\PDFTrait;
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
        $count = 1;
        $payrolls = Payroll::whereDate('period', $period)
            ->where('status', 1)
            ->whereIn('category_id', $categories)
            ->get();
        if ($payrolls->count() > 0) {
            $pdf = new PDFTrait('L', 'mm', 'a4');
            $pdf->AliasNbPages();
            $pdf->SetAutoPageBreak(false);
            //add first page
            $pdf->AddPage();
            //set initial y axis position per page
            $y_axis_initial = 35;

            $pdf->SetLeftMargin(10);
            $pdf->SetFont('Arial', '', 10);
            //set title
            $pdf->Cell(70);
            //$pdf->Ln(4);
            $pdf->Cell(90, 8, 'Payroll Register for the Month of ' . date('F Y', strtotime($payrolls[0]->period)));
            $pdf->Ln(10);
            // column headers
            $pdf->SetLeftMargin(10);
            $pdf->SetFont('Arial', '', 10);
            //set title
            $pdf->Cell(70);
            $pdf->Ln(20);

            //column headers
            $pdf->SetFont('Arial', 'b', 8);
            $pdf->SetY($y_axis_initial);
            $pdf->SetX(15);
            $pdf->Cell(8, 8, 'SN', 1, 0, 'C');
            $pdf->Cell(50, 8, 'Name', 1, 0, 'C');
            $pdf->Cell(15, 8, 'Gender', 1, 0, 'C');
            $pdf->Cell(30, 8, 'KRA PIN', 1, 0, 'C');
            $pdf->Cell(50, 8, 'Category', 1, 0, 'C');
            $pdf->Cell(25, 8, 'Gross', 1, 0, 'C');
            $pdf->Cell(25, 8, 'Taxable', 1, 0, 'C');
            $pdf->Cell(25, 8, 'PAYE', 1, 0, 'C');
            $pdf->Cell(25, 8, 'Net Due', 1, 0, 'C');
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
                    $pdf->AddPage();
                    //print column titles for the current page
                    $pdf->SetFont('Arial', 'b', 8);
                    $pdf->SetY($y_axis_initial);
                    $pdf->SetX(15);
                    $pdf->Cell(8, 8, 'SN', 1, 0, 'C');
                    $pdf->Cell(50, 8, 'Name', 1, 0, 'C');
                    $pdf->Cell(15, 8, 'Gender', 1, 0, 'C');
                    $pdf->Cell(30, 8, 'KRA PIN', 1, 0, 'C');
                    $pdf->Cell(50, 8, 'Category', 1, 0, 'C');
                    $pdf->Cell(25, 8, 'Gross', 1, 0, 'C');
                    $pdf->Cell(25, 8, 'Taxable', 1, 0, 'C');
                    $pdf->Cell(25, 8, 'PAYE', 1, 0, 'C');
                    $pdf->Cell(25, 8, 'Net Due', 1, 0, 'C');
                    //Go to next row
                    $y_axis = $y_axis_initial + $row_height;

                    //Set $i variable to 0 (first row)
                    $i = 0;
                }
                $pdf->SetFont('Arial', '', 10);
                $pdf->Ln();
                //foreach($row as $column)
                $pdf->SetY($y_axis);
                $pdf->SetX(15);
                $pdf->Cell(8, 8, $count . '.', 1, 0, 'R');
                if ($d->employee->pwd == 1) {
                    $pdf->Cell(50, 8, $d->employee->fullname . ' * ', 1);
                } else {
                    $pdf->Cell(50, 8, $d->employee->fullname, 1);
                }

                $pdf->Cell(15, 8, $d->employee->gender, 1);
                $pdf->Cell(30, 8, strtoupper( $d->employee->krapin), 1);
                $pdf->Cell(50, 8, $d->employee->category->name, 1);
                $pdf->Cell(25, 8, number_format(round($d->grossincome, 1), 2, '.', ','), 1, 0, 'R');
                $pdf->Cell(25, 8, number_format(round($d->taxableincome, 1), 2, '.', ','), 1, 0, 'R');
                $pdf->Cell(25, 8, number_format(round($d->paye, 1), 2, '.', ','), 1, 0, 'R');


                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(25, 8, number_format(round($d->net_income, 1), 2, '.', ','), 1, 0, 'R');
                $pdf->SetFont('Arial', 'BI', 7);
                //$pdf->Cell(16,8,$d->ifmisno,1,0,'R');
                //$count+=1;
                //Go to next row
                $y_axis = $y_axis + $row_height;
                $i = $i + 1;
                $count += 1;

            }
            $pdf->SetFont('Arial','B',8);
            $pdf->Ln();
            $pdf->Cell(21);
            $pdf->Cell(137,6,'Grand Totals: (KSH)',0);
            $pdf->Cell(25,6,number_format((float)round($payrolls->sum('grossincome'),1), 2, '.', ','),1,0,'R');
            $pdf->Cell(25,6,number_format((float)round($payrolls->sum('grossincome'),1), 2, '.', ','),1,0,'R');
            $pdf->Cell(25,6,number_format((float)round($payrolls->sum('paye'),1), 2, '.', ','),1,0,'R');
            $pdf->Cell(25,6,number_format((float)round($payrolls->sum('net_income'),1), 2, '.', ','),1,0,'R');

            $headers = ['Content-type' => 'application/pdf'];
            return Response::make($pdf->Output(), 200, $headers);
            /* $pdf = PDF::loadView('payrolls.schedule', compact('payrolls'))
                  ->setOptions(['defaultFont' => 'sans-serif'])
                  ->setPaper('a4', 'landscape');
              return $pdf->stream('payrolls.pdf', array("Attachment" => false));*/
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

    public function payslip($id,$returntype=false)
    {
        if($returntype==false)
        {
            $returntype="download";
        }
        $payslip = Payroll::find($id);

        if ($payslip):
            $this->pdf = new FPDF('p', 'mm', 'a4');
            $this->pdf->AddPage();
            $this->pdf->AliasNbPages();
            $this->pdf->SetLeftMargin(30);
            $this->pdf->SetDrawColor(36, 94, 51);
            $this->pdf->Rect(25, 15, 95, 137);


            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->SetFillColor(255, 0, 0);
            //$this->pdf->Cell(30, 8, '', 1, 0, 'L');
            $this->pdf->Cell(33);
            $this->pdf->Ln(10);
            //$this->pdf->Image('img/hudumalogo2.png', 30, 20, 12);
            $this->pdf->Cell(15);
            $this->pdf->Cell(70, 6, 'The Presidency', 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Cell(15);
            $this->pdf->Cell(70, 6, 'Ministry of Public Service & Gender Affairs', 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->Cell(15);
            $this->pdf->Cell(70, 6, 'Huduma Kenya Secretariat', 0, 0, 'C');

            $this->pdf->SetDrawColor(250, 0, 0);
            $this->pdf->Line(27, 40, 117, 40);
            $this->pdf->Line(27, 40, 117, 40);

            $this->pdf->SetDrawColor(36, 94, 51);
            $this->pdf->Line(27, 41, 117, 41);
            $this->pdf->Line(27, 41, 117, 41);

            $this->pdf->Ln(10);
            $this->pdf->SetFont('Arial', 'B', 16);
            $this->pdf->Cell(85, 8, 'Payslip', 0, 0, 'C');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->Cell(80, 8, 'Period : ' . date('F Y', strtotime($payslip->period)), 0, 0, 'L');
            $this->pdf->Ln();
            $this->pdf->SetFont('Arial', '', 11);
            $this->pdf->Cell(25, 4, 'Name', 0, 0, 'L');
            $this->pdf->Cell(60, 4, ': ' . strtoupper($payslip->fullname), 0, 0, 'L');
            $this->pdf->Ln(5);

            //$pdf->Cell(15);
            $this->pdf->Cell(25, 4, 'KRA PIN', 0, 0, 'L');
            $this->pdf->Cell(60, 4, ': ' . strtoupper($payslip->krapin), 0, 0, 'L');
            $this->pdf->Ln(5);
            $this->pdf->Cell(25, 4, 'ID Number', 0, 0, 'L');
            $this->pdf->Cell(60, 4, ': ' . $payslip->idno, 0, 0, 'L');
            //
            $this->pdf->Ln(8);
            $this->pdf->SetFont('Arial', 'BI', 12);
            $this->pdf->SetFillColor(255, 0, 0);
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
            //$this->pdf->Image('img/frame.png', 90, 125, 25);
            $filename=$payslip->id.'.pdf';
            $this->pdf->Output(public_path('Payroll/Payslips/'.$filename),'F');
            //return file pat
           if($returntype=="download")
           {
               $headers = ['Content-type' => 'application/pdf'];
               return Response::make($this->pdf->Output(), 200, $headers);

           }else{
               $path=public_path('Payroll/Payslips/');

               return $path;

           }



            /*$headers = ['Content-type' => 'application/pdf'];
            return Response::make($this->pdf->Output(), 200, $headers);
            //exit;*/
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
