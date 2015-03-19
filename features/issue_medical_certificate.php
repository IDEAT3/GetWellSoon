
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
<title>Issue Medical Certificate</title>

<!--CSS-->
<link href="../css/medical_certificate.css" rel="stylesheet" type="text/css"> 

<!-- Datepicker -->
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="../jQueryAssets/datepicker/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../jQueryAssets/datepicker/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$( ".Datepicker" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true, dateFormat:"dd-mm-yy"}); 
});
</script>

</head>

</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<div id="table1">
<br/>
<span style="position:relative;left:400px">Medical Certificate</span>

<?php
if(isset($_POST['insert'])) 
{
	$iss_date = date("Y-m-d", strtotime($_POST['IssueDate']));
	$name = $_POST['Name'];
	$type = $_POST['Type'];
	$rollno = $_POST['RollNo'];
	$from = date("Y-m-d", strtotime($_POST['From']));
	$days = $_POST['Days'];
	$cause = $_POST['Cause'];
	$doctor = $_POST['Doctor'];
	$result = mysqli_query($conn,"SELECT * FROM Medical_Certificate WHERE CftNo=(select max(CftNo) from Medical_Certificate);");
	$row = mysqli_fetch_array($result);
	$slno = $row['CftNo']+1;
	//$result = mysqli_query($conn, "INSERT INTO Medical_Certificate VALUES ('2','2015-08-12','Vishnu','Student','B120806cs','2014-04-03','5','Cold','VishalPeter');");
	$result = mysqli_query($conn, "INSERT INTO Medical_Certificate VALUES ('{$slno}','{$iss_date}','{$name}','{$type}','{$rollno}','{$from}','{$days}','{$cause}','{$doctor}');");
	if (!$result)
	{
?>
	<script>
		window.alert("Values not Inserted");
	</script>
<?php
	}
	else 
	{
?>
	<script>
		window.alert("Success");
	</script>
<?php
	}
}
?>

<div id="insert_table">
<form action="" method="post">
    <table cellspacing=7>
	<thead>
		<tr>
		<th>Date</th>
		<th>Name</th>
		<th>Type</th>
		<th>Patient ID</th>
		<th>From</th>
		<th>Days</th>
		<th>Cause</th>
		<th>Doctor</th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><input type="text" class='Datepicker' name="IssueDate" size="8" maxlength="10"></td>
		<td><input type="text" name="Name" size="18"></td>
		<td><input type="text" name="Type" size="10"></td>
		<td><input type="text" name="RollNo" size="12"></td>
		<td><input type="text" class='Datepicker' name="From"  size="9" maxlength="10"></td>
		<td><input type="text" name="Days" size="6"></td>
		<td><input type="text" name="Cause" size="18"></td>
		<td><input type="text" name="Doctor" size="18"></td>
	</tr>
	</tbody>
	</table>
	<th><input type="submit" name="insert" value="Insert" class="button" style="position:relative;left:550px;top:60px" ></th>
</form>
</div>
</div>
</body>
</html>
