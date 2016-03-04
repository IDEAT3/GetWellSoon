<?php
include ('../lib/configure.php');
session_start();
if(isset($_SESSION['login_user'])){
	if ($_SESSION['login_user']=="doctor") {
		header("location: ../doctor_home.php");
	}
}
else {
	header("location: ../index.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Issue Medicine</title>
<link href="../css/issue_med.css" rel="stylesheet" type="text/css">
<!-- <link href="../css/record_tables.css" rel="stylesheet" type="text/css"> -->
<script src="../jQueryAssets/js/issuemed.js" ></script>
<script src="../jQueryAssets/js/jquery.min.js"></script>        
<link rel="stylesheet" href="../jQueryAssets/js_css/jquery-ui.css" /> 
<script src="../jQueryAssets/js/jquery-ui.min.js"></script>‌​
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<div id="issue_med_form">
Issue Medicine:-
	<form id="f1" action="issue_medicine.php" method="post">
    Patient ID:<input name="Patient_Id" id="Patient_Id" type="text" class ="input_class_id" onchange="get_patient_by_id()">&nbsp;
    Name: <input name="Name" type="text" id="Name" class ="input_class_name" oninput="get_patient_by_name()">&nbsp;
    Dependent: <input name="Dependent" type="text" id="Dependent" class ="input_class_name" onblur="get_patient_by_dependent()">&nbsp;&nbsp;&nbsp;
    Sex: <input name="Sex" type="text" id="Sex" readonly class ="input_class_small">&nbsp;&nbsp;&nbsp;
    Age:<input name="Age" readonly type="text" id="Age" class ="input_class_small"> 
<br/>
	Cause: <input type='text' name='Cause' class ='input_class_id'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="submit" value="Issue" >
    </form>
</div>
</body>
</html>
