<?php
  session_start();
  
  if(isset($_SESSION['login_type'])) 
  {
	if ($_SESSION['login_type']=="Doctor")
	{
		header("location: ../doctor_home.php");
	}
  }
  else 
  {
		header("location: ../index.php");
  }
  
  require("../fpdf17/fpdf.php");
  
if (isset($_POST['print']))
{
  $doc_name = $_POST['Doctor'];
  if ($_POST['Dependent']=="")
  {
	$pat_name = $_POST['Name'];
  }
  else $pat_name = $_POST['Dependent'];
  $cause = $_POST['Cause'];
  $days = $_POST['NoOfDays'];
  $from = $_POST['FromDate'];
  
  $pdf = new FPDF();
  // var_dump(get_class_methods($pdf)); displays all the functions available in fpdf
  
  $pdf->AddPage();
  $pdf->SetXY(0,30);
  $pdf->SetFont("Times","BU","20");          //Arguments are font-family, style(B, I, U), Size
  $pdf->Cell(0,20,"MEDICAL CERTIFICATE",0,1,"C");  //Width, height, string to be displayed, border size, same line or newline(0 or 1),alignment-centre,left, right 
  $pdf->SetFont("Times","","14");
  $pdf->SetXY(140,50);  
  $dt = date("d/m/Y");
  $pdf->Cell(0,20, "Signature of the applicant",0,1,"L");
  $pdf->SetXY(15,80);
  $pdf->MultiCell(0,20, "I   '$doc_name'    after careful personal examination of the case do hereby certify that    '$pat_name'   whose signature is given above is suffering from    '$cause'   and I consider that a period of absence from duty of   '$days'  days with effect from   '$from'  is absolutely necessary for the restoration of his/her health.",0);
  $pdf->SetXY(17,175);
  $pdf->Cell(0,20, "Place : ",0,1,"L");
  $pdf->SetXY(17,190);
  $pdf->Cell(0,20, "Date : ",0,0,"L");
  $pdf->SetXY(35,190);
  $pdf->Cell(0,20, $dt,0,1,"L");
  $pdf->SetXY(148,175);
  $pdf->Cell(0,20, "Reg. Medical Practitioner",0,1,"L");
  $pdf->SetXY(148,190);
  $pdf->Cell(0,20, "(Reg No                           )",0,1,"L");
  
  $pdf->Output();
	  
}
else 
{
  $pdf = new FPDF();
  // var_dump(get_class_methods($pdf)); displays all the functions available in fpdf
  
  $pdf->AddPage();
  $pdf->SetXY(0,30);
  $pdf->SetFont("Times","BU","20");          //Arguments are font-family, style(B, I, U), Size
  $pdf->Cell(0,20,"MEDICAL CERTIFICATE",0,1,"C");  //Width, height, string to be displayed, border size, same line or newline(0 or 1),alignment-centre,left, right 
  $pdf->SetFont("Times","","14");
  $pdf->SetXY(140,50);  
  $dt = date("d/m/Y");
  $pdf->Cell(0,20, "Signature of the applicant",0,1,"L");
  $pdf->SetXY(15,80);
  $pdf->MultiCell(0,20, "I ......................................... after careful personal examination of the case do hereby certify that ............................ whose signature is given above is suffering from ..................... and I consider that a period of absence from duty of ........................ with effect from .......................... is absolutely necessary for the restoration of his/her health.",0);
  $pdf->SetXY(17,175);
  $pdf->Cell(0,20, "Place : ",0,1,"L");
  $pdf->SetXY(17,190);
  $pdf->Cell(0,20, "Date : ",0,0,"L");
  $pdf->SetXY(35,190);
  $pdf->Cell(0,20, $dt,0,1,"L");
  $pdf->SetXY(148,175);
  $pdf->Cell(0,20, "Reg. Medical Practitioner",0,1,"L");
  $pdf->SetXY(148,190);
  $pdf->Cell(0,20, "(Reg No                           )",0,1,"L");
  
  $pdf->Output();
}
?>

<!doctype html>
<html>
	<head>
		<title>Medical Certificate</title>
	</head>

</html>

