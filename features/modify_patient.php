<?php
	include '../lib/session.php';
	include ('../lib/configure.php');
	if($login_type=='doctor') {header("location: ../doctor_home.php");}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modify Patient Record</title>
<link href="../css/add_patient.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>

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
<script type="text/javascript">
function get_patient_by_id(){
	var p_id=document.getElementById("Patient_Id").value;
	<?php
		$p_id="<script> document.write(p_id);</script>";
	?>
	alert("<?php echo $p_id ?>");
	<?php
		$query=mysqli_query("SELECT * from patient where Patient_Id ='{$p_id}';");
		$row=mysqli_fetch_array($query);
	?>
	
	document.getElementsByName("Name")[0].setAttribute("value","<?php $row['Name'] ?>");
}
</script>
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="add_patient_form">
Modify Patient Details :-

<?php   
	if (isset($_POST['submit'])) {
		$date=date("Y-m-d", strtotime($_POST['DOB']));
	//	$sql="UPD`health_centre`.`patient` SET (`Patient_Id`, `Name`, `Dependent`, `Sex`, `Age`, `Ph.No`, `Alt.Ph.No`, `DOB`, `PermanentAddress`, `LocalAddress`) VALUES ('{$_POST['Patient_Id']}', '{$_POST['Name']}', '{$_POST['Dependent']}', '{$_POST['Sex']}','{$_POST['Age']}', '{$_POST['Ph_No']}', '{$_POST['Altph_No']}', '{$date}', '{$_POST['Permanent_Address']}', '{$_POST['Local_Address']}');";
		$query=mysqli_query($conn,$sql);
		if(!$query) {?>
			<script>alert("Patient was not added!! <?php echo $sql; ?>");</script>
			<?php
		}
		else {?>
			<script>alert("Successfully added patient!!");</script>
			<?php
		}
	}
?>	



<form action="" method="post">
	Patient ID: <input name="Patient_Id" type="text" id="Patient_Id" class ="input_class_med" onblur="get_patient_by_id()">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" id="Name" class ="input_class_med" autocomplete="on"><br>
    Dependent: <input name="Dependent" type="text" id="Dependent" class ="input_class_med" autocomplete="on">&nbsp;&nbsp;&nbsp;&nbsp;
    Sex:&nbsp;<input name="Sex" type="radio"value="male" checked>Male &nbsp;
    		  <input name="Sex" type="radio" value="female">Female &nbsp;&nbsp;
    Age: <input name="Age" type="text" class ="input_class_small"><br>
	Ph. No: <input name="Ph_No" type="text" class ="input_class_med" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    DOB: <input name="DOB" type="text" class ="input_class_med" autocomplete="on"><br>    
    Alt. Ph. No: <input name="AltPh_No" type="text" class ="input_class_med" autocomplete="on"><br>
    
	Permanent Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    Local Address: <br>
    <textarea id="Permadd" name="Permanent_Address" cols="37" rows="13"></textarea>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" class="button" value="Same" onClick="document.getElementById('locadd').value = document.getElementById('Permadd').value">
    <textarea id="locadd" name="Local_Address" cols="37" rows="13"></textarea><br>
    <input type="submit" name="submit" value="Confirm" >
</form>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
</body>
</html>
