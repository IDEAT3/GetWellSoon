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
<link rel="icon" href="../images/cross.png" type="image/gif" sizes="16x16"> 
<title>Add Patient Record</title>
<link href="../css/add_patient.css" rel="stylesheet" type="text/css">

<!-- Datepicker -->
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="../jQueryAssets/datepicker/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../jQueryAssets/datepicker/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$( "#Datepicker" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true, dateFormat:"dd-mm-yy",yearRange: '1920:2050'}); 
});
</script>
</head>

<body>
	
<?php   
	if (isset($_POST['submit'])) {
		$pid=$_POST['Patient_Id'];
		if($pid == "") {echo '<script>alert("You must enter a Patient ID.");window.location.assign("./add_patient.php");</script>';}
		else {
		if($_POST['Name'] == "") {echo '<script>alert("You must enter a Patient Name.");window.location.assign("./add_patient.php");</script>';}
		else {
		$sql="SELECT Name FROM patient WHERE Patient_Id = '$pid';";
		$query=mysqli_query($conn, $sql);
		if($query) {
			$row=mysqli_fetch_array($query);
			$name=$row['Name'];
			if($name!=NULL && $_POST['Name']!= $name) {
				echo '<script>alert("Patient with same id and different name exists.");</script>';
			}
			else {
			$date=date("Y-m-d", strtotime($_POST['DOB']));
			$pid=$_POST['Patient_Id'];
			$name=$_POST['Name'];
			$dep=$_POST['Dependent'];
			$sex=$_POST['Sex'];
			$age=$_POST['Age'];
			$ph=$_POST['Ph_No'];
			$aph=$_POST['AltPh_No'];
			$pad=$_POST['PermanentAddress'];
			$lad=$_POST['LocalAddress'];
			$sql="INSERT INTO patient VALUES ('$pid', '$name', '$dep', '$sex','$age', '$ph', '$aph', '$date', '$pad', '$lad');";
			$query=mysqli_query($conn,$sql);
			if(!$query) {?>
				<script>alert("Patient was not added!!");</script>
				<?php
			}
			else {?>
				<script>alert("Successfully added patient!!");</script>
				<?php
			}
			}
		}
		else {
			echo '<script>alert("Patient could not be added.");</script>';
		}
		}
		}
	}
?>	
	
	
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="add_patient_form">
Add Patient Details :-
<form action="" method="post">
	Patient ID: <input name="Patient_Id" type="text" class ="input_class_med" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" class ="input_class_med" autocomplete="on"><br>
    Dependent: <input name="Dependent" type="text" class ="input_class_med" autocomplete="on">&nbsp;&nbsp;&nbsp;&nbsp;
    Sex:&nbsp;<input name="Sex" type="radio"value="Male" checked>Male &nbsp;
    		  <input name="Sex" type="radio" value="Female">Female &nbsp;&nbsp;
              Age: <input name="Age" type="text" class ="input_class_small"><br>
	Ph. No: <input name="Ph_No" type="text" class ="input_class_med"  autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    DOB: <input name="DOB" type="text" class ="input_class_med" id="Datepicker" autocomplete="on"><br>    
    Alt. Ph. No: <input name="AltPh_No" type="text" class ="input_class_med" autocomplete="on"><br>
    
	Permanent Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    Local Address: <br>
    <textarea id="Permadd" name="PermanentAddress" cols="37" rows="13"></textarea>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" class="button" value="Same" onClick="document.getElementById('locadd').value = document.getElementById('Permadd').value">
    <textarea id="locadd" name="LocalAddress" cols="37" rows="13"></textarea><br>
    <input type="submit" name="submit" value="Confirm" >
</form>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
</body>
</html>
