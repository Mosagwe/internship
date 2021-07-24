<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

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

    public function payslip(Request $request)
    {
        $payslip = Payroll::whereDate('period', $request->period)
            ->where('idno', $request->idno)->first();
        if ($payslip->count() > 0) {
           /* $pdf = PDF::loadView('payrolls.payslippdf', compact('payslip'))
                ->setOptions(['defaultFont' => 'sans-serif'])
                ->setPaper('a4');
            return $pdf->download('payslip.pdf');*/
            return view('payrolls.payslippdf',compact('payslip'));
            //return $pdf->stream('payslip.pdf', array("Attachment" => false));
        }

    }
}
