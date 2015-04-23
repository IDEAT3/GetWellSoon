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
<title>Update Patient Record</title>
<link href="../css/add_patient.css" rel="stylesheet" type="text/css">

<script src="../jQueryAssets/js/jquery.min.js"></script>        
<link rel="stylesheet" href="../jQueryAssets/js_css/jquery-ui.css" /> 
<script src="../jQueryAssets/js/jquery-ui.min.js"></script>‌​

<!-- Datepicker -->
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">


<script type="text/javascript">
$(function() {
	$( "#datepicker" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true, dateFormat:"dd-mm-yy",yearRange: '1920:2050'}); 
});
</script>
<script>
 $(document).ready(function(){
	$("#Patient_Id").val("<?php echo $_POST['Patient_Id']; ?>");
	$("#Name").val("<?php echo $_POST['Name']; ?>");
	$("#Dependent").val("<?php echo $_POST['Dependent']; ?>");
	if("<?php echo $_POST['Sex'] ;?>" =="Female") {$( "#F" ).prop("checked", true);} else {$( "#M" ).prop("checked", true);}
	$("input:text[name=Age]").val("<?php echo $_POST['Age']; ?>");
	$("input:text[name=Ph_No]").val("<?php echo $_POST['Ph_No']; ?>");
	$("input:text[name=DOB]").val("<?php echo $_POST['DOB']; ?>");
	$("input:text[name=AltPh_No]").val("<?php echo $_POST['AltPh_No']; ?>");
		});
</script>
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="add_patient_form">
Update Patient Details :-

<?php   
	if(isset($_POST['submit'])) {
		$_SESSION['pid']=$_POST['Patient_Id'];
		$_SESSION['name']=$_POST['Name'];
		$_SESSION['dependent']=$_POST['Dependent'];
	}
	else if(!isset($_POST['update'])){
		?> <script> alert('The patient selected does not exist');</script> <?php
		header("location: ../features/modify_patient.php");
	}
	if (isset($_POST['update'])) {
		$date=date("Y-m-d", strtotime($_POST['DOB']));
		?><script> //alert("<?php echo $_SESSION['pid']; ?>");
		</script><?php  
		$sql="UPDATE `patient` SET `Patient_Id`= '{$_POST['Patient_Id']}' , `Name`= '{$_POST['Name']}' , `Dependent`= '{$_POST['Dependent']}', `Sex`= '{$_POST['Sex']}', `Age`= '{$_POST['Age']}', `Ph.No`= '{$_POST['Ph_No']}', `Alt.Ph.No`= '{$_POST['AltPh_No']}', `DOB`= '{$date}', `PermanentAddress`= '{$_POST['Permanent_Address']}' , `LocalAddress`= '{$_POST['Local_Address']}' WHERE `Patient_Id` = '{$_SESSION['pid']}' AND `Name`='{$_SESSION['name']}' AND `Dependent`='{$_SESSION['dependent']}'";
		if($conn->query($sql) == TRUE) {
			?><script> alert("successfully updated"); 
			window.location.assign("../features/modify_patient.php");
			</script><?php
			
		}
		else {
			?><script> alert("Not updated"); </script><?php
		}
	}
?>	

<form action="" method="post">
	Patient ID: <input name="Patient_Id" type="text" id="Patient_Id" class ="input_class_med" >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" id="Name" class ="input_class_med"><br>
    Dependent: <input name="Dependent" type="text" id="Dependent" class ="input_class_med" >&nbsp;&nbsp;&nbsp;&nbsp;
    Sex:&nbsp;<input name="Sex" type="radio" id="M" value="Male" checked>Male &nbsp;
    		  <input name="Sex" type="radio" id="F" value="Female">Female &nbsp;&nbsp;
    Age: <input name="Age" type="text" class ="input_class_small"><br>
	Ph. No: <input name="Ph_No" type="text" class ="input_class_med" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    DOB: <input name="DOB" id="datepicker" type="text" class ="input_class_med" autocomplete="on"><br>    
    Alt. Ph. No: <input name="AltPh_No" type="text" class ="input_class_med" autocomplete="on"><br>
    
	Permanent Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    Local Address: <br>
    <textarea id="Permadd" name="Permanent_Address" cols="37" rows="13"><?php echo $_POST['Permanent_Address']; ?></textarea>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" class="button" value="Same" onClick="document.getElementById('locadd').value = document.getElementById('Permadd').value">
    <textarea id="locadd" name="Local_Address" cols="37" rows="13"><?php echo $_POST['Local_Address'];?></textarea><br>
    <input type="submit" name="update" value="Update" >
</form>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
</body>
</html>
