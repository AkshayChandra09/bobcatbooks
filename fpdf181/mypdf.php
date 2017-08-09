<?php
require('fpdf.php');

$recpt_no = $_POST["recpt_no"]; 
 
$user = $_POST["user"]; 
$user = json_decode($user);
$books = $_POST["books"];
$books = json_decode($books);

$total = $_POST["total"];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$pdf->Image('logo2.jpg',5,5,200);
$pdf->Ln(10);
$pdf->Cell(40,10,"Purchase e-Receipt");
$pdf->Ln(6);
$pdf->Cell(40,10,$recpt_no);
$pdf->Ln(6);
$pdf->Cell(40,10,$user[0]);
$pdf->Ln(6);
$pdf->Cell(40,10,$user[1]);
$pdf->Ln(6);
$pdf->Cell(40,10,$user[2]);
$pdf->Ln(6);
$pdf->Cell(40,10,$user[3]);
$pdf->Ln(6);
$pdf->Cell(40,10,$user[4]);
$pdf->Ln(6);
$pdf->Cell(40,10,$user[5]);
$pdf->Ln(6);
$pdf->Cell(40,10,$user[6]);
$pdf->Ln(6);
//--------books--------------
	foreach($books as $book)
	{
		$pdf->Cell(40,10,$book[0]);
		$pdf->Ln(6);
		$pdf->Cell(40,10,$book[1]);
		$pdf->Ln(6);
		$pdf->Cell(40,10,$book[2]);
		$pdf->Ln(6);
		$pdf->Cell(40,10,$book[3]);
		$pdf->Ln(6);
		$pdf->Cell(40,10,$book[4]);
		$pdf->Ln(6);
	}

	//$pdf->Cell(40,10,$total);
	//$pdf->Ln(6);

    // Arial 12
    $pdf->SetFont('Arial','',16);
    // Background color
    $pdf->SetFillColor(200,220,255);
    // Title
    $pdf->Cell(0,6,"Total $total",0,1,'L',true);
    // Line break
    $pdf->Ln(4);

$pdf->Output();
?>

