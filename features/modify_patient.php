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
<title>Modify Patient Record</title>
<link href="../css/add_patient.css" rel="stylesheet" type="text/css">

<script src="../jQueryAssets/js/jquery.min.js"></script>        
<link rel="stylesheet" href="../jQueryAssets/js_css/jquery-ui.css" /> 
<script src="../jQueryAssets/js/jquery-ui.min.js"></script>‌​
<script type="text/javascript" src="../jQueryAssets/js/mod_pat.js"></script>‌​

<!-- Datepicker -->
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">


<script type="text/javascript">
$(function() {
	$( "#datepicker" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true, dateFormat:"dd-mm-yy",yearRange: '1920:2050'}); 
});
</script>

</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="add_patient_form">
Modify Patient Details :-
<form action="../lib/pat_mod.php" method="post">
	Patient ID: <input name="Patient_Id" type="text" id="Patient_Id" class ="input_class_med" onchange="get_patient_by_id()">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" id="Name" class ="input_class_med" oninput="get_patient_by_name()"><br>
    Dependent: <input name="Dependent" type="text" id="Dependent" class ="input_class_med" onblur="get_patient_by_dependent()">&nbsp;&nbsp;&nbsp;&nbsp;
	<label>
    Sex:&nbsp;<input name="Sex" type="radio" id="M" value="Male" checked>Male &nbsp;
    		  <input name="Sex" type="radio" id="F" value="Female">Female &nbsp;&nbsp;
    Age: <input name="Age" type="text" class ="input_class_small" readonly><br>
	Ph. No: <input name="Ph_No" type="text" class ="input_class_med" autocomplete="on" readonly>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    DOB: <input name="DOB" type="text" class ="input_class_med" autocomplete="on" readonly><br>    
    Alt. Ph. No: <input name="AltPh_No" type="text" class ="input_class_med" autocomplete="on" readonly><br>
    
	Permanent Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    Local Address: <br>
    <textarea id="Permadd" name="Permanent_Address" cols="23" rows="4" readonly></textarea>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;
    <textarea id="locadd" name="Local_Address" cols="27" rows="4" readonly></textarea><br>
	</label>
    <input type="submit" name="submit" value="Update" >
</form>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
</body>
</html>
