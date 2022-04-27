<?php 
include_once('fpdf.php');
include_once("../dbconfig.php"); 
$type = $_POST['status'];

// $month = date("yyyyMM",strtotime(date("ym")));

$month = date('Y/m');


class PDF extends FPDF

{
// Page header
function Header()
{
    // Logo
    $this->Image('../image/logo.png',10,-1,70);
    $this->SetFont('Arial','B',13);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(80,10,'Appointment Report',1,0,'C');
    // Line break
    $this->Ln(20);
}
 
// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
 


$display_heading = array('appointment_detail_id'=>'Status ID','appointment_id'=>'Appointment ID', 'status'=> 'Status','date_accepted'=> 'Date Validated','appointment_date'=> 'Appointment Date','comment'=> 'comment',);
 
$result = mysqli_query($db, "SELECT appointment_detail_id, appointment_id, status, date_accepted, appointment_date, comment FROM tbl_appointment_detail WHERE status= '$type' ");





$header = mysqli_query($db, "SHOW columns FROM tbl_appointment_detail");


$pdf = new PDF();
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',8);
foreach($header as $heading) {
$pdf->Cell(40,12,$display_heading[$heading['Field']],1);
}
foreach($result as $row) {
$pdf->Ln();
foreach($row as $column)
$pdf->Cell(40,12,$column,1);
}
$pdf->Output();

?>