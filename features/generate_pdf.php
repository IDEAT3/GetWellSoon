<?php
  session_start();
  require("../fpdf17/fpdf.php");
  
  $yr = $_SESSION['year'];
  $opbal = $_SESSION['opbal'];
  $pur = $_SESSION['pur'];
  $consumption = $_SESSION['consumption'];
  $clbal = $_SESSION['clbal'];
  $pdf = new FPDF();
  // var_dump(get_class_methods($pdf)); displays all the functions available in fpdf
  
  $pdf->AddPage();
  $pdf->SetXY(0,30);
  $pdf->SetFont("Times","B","20");          //Arguments are font-family, style(B, I, U), Size
  $pdf->Cell(0,20,"NATIONAL INSTITUTE OF TECHNOLOGY CALICUT",0,1,"C");  //Width, height, string to be displayed, border size, same line or newline(0 or 1),alignment-centre,left, right 
  $pdf->SetFont("Arial","B","15");
  $pdf->Cell(0,20,"HEALTH CENTRE",0,1,"C");
  $pdf->SetFont("Times","","14");
  $prv = $yr-1;
  $dt = date("d/m/Y");
  $pdf->Cell(160,20, "A3/Annual A/c - Closing Stock / $prv / $yr",0,0,"L");
  $pdf->Cell(0,20, $dt,0,1,"L");
  $pdf->SetXY(10,100);
  $pdf->SetFont("Times","B","17");
  $pdf->Cell(12,0, "Sub",0,0,"L");             //height and document text
  $pdf->SetFont("Times","I","15");
  $pdf->Cell(0,0, ": Closing Stock of Medicines and Lab Chemicals Regarding",0,1,"L");
  $pdf->SetXY(10,115);
  $pdf->SetFont("Times","","15");
  $pdf->MultiCell(0,10, "The consolidated value of closing stock of Medicines as on 31-03-$yr is given below.",0); 
  $pdf->Cell(0,20,"Statement as on 31/03/$yr",0,1,"C");
  
  $pdf->Cell(90,9,"Opening Balance as on 01/04/$prv",1,0,"L");
  $pdf->Cell(80,9,"   Rs. $opbal",1,1);  
  $pdf->Cell(90,9,"Total Purchase made during $prv-$yr",1,0,"L");
  $pdf->Cell(80,9,"   Rs. $pur",1,1);
  $pdf->Cell(90,9,"Consumption during the year",1,0,"L");
  $pdf->Cell(80,9,"   Rs. $consumption",1,1);
  $pdf->Cell(90,9,"Closing balance as on 31/03/$yr",1,0,"L");
  $pdf->Cell(80,9,"   Rs. $clbal",1,1);
  $pdf->SetXY(23,220);
  $pdf->Cell(180,9,"\n\n\n\nRESIDENT MEDICAL OFFICER",0,1,"R");

  $pdf->Output();
?>

<!doctype html>
<html>
	<head>
		<title>Print</title>
	</head>

</html>
