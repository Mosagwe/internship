<?php

namespace App\Http\Traits;
use Crabbly\Fpdf\Fpdf as FPDF;

class PDFTrait extends FPDF{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('img/logo.png',25,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(90,10,'MALIPO LTD',0,0,'C');
        // Line break
        $this->Ln(12);

        ////set title
        $this->SetFont('Arial','b',10);

//
    }

// Page footer
    function Footer()
    {
        //$this->Ln(20);
        $this->SetY(-50);
        //for authorization Signature and Date
        /*$this->Cell(20);
        $this->Cell(50,6,'NOTE',0);
        $this->Ln(4);
        $this->SetFont('Arial','I',8);
        $this->Cell(20);
        $this->Cell(50,6,'KEY: MIR (Mortgage Interest Relief), HSC (Huduma Sacco Contribution), Extr (Extraneous Allowance)');
        $this->Ln(3);
        $this->Cell(20);
        $this->Cell(50,6,'*  PLWD exempted from taxation. An addition of KES 15,000 to the basic salary.');
        $this->Ln(3);
        $this->Cell(20);
        $this->Cell(50,6,'*** Please note that the GOK payment indicated has already been taxed and hence the need to deduct before applying tax. This is only for the officers who are in the Government payroll.',0);
        $this->Ln(3);
        $this->Cell(20);
        $this->Cell(50,6,'Note: The salary increment date for staff whose contracts commenced on Aug 2015 is Aug 2017',0);*/
        //for signing
        $this->Ln(6);
        $this->Cell(20);
        $this->Cell(50,6,'Prepared by:',0,0,'L');
        $this->Cell(90);
        $this->Cell(50,6,'Authorised by:',0,0,'L');
        $this->Ln(2);
        $this->Cell(10);
        $this->Cell(50,10,'',0,0,'C');

        $this->Cell(1);

        $this->Cell(50,10,'',0);
        $this->Ln();
        $this->Cell(20);
        $this->Cell(50,6,'..................................................',0,0,'C');
        $this->Cell(1);
        $this->Cell(50,6,'......................................',0,0,'C');
        $this->Cell(40);
        $this->Cell(50,6,'..................................................',0,0,'C');
        $this->Cell(1);
        $this->Cell(50,6,'......................................',0,0,'C');
        $this->SetFont('Arial','I',7);

        $this->Ln(2);
        $this->Cell(20);

        $this->Cell(50,6,'Signature',0,0,'C');
        $this->Cell(10);
        $this->Cell(30,6,'Date',0,0,'C');
        $this->Cell(50);
        $this->Cell(50,6,'Signature',0,0,'C');
        $this->Cell(10);
        $this->Cell(30,6,'Date',0,0,'C');

//

        $this->SetFont('Arial','B',8);
//
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }


}
