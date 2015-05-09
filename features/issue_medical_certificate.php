
<?php
include ('../lib/configure.php');
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

if (isset($_POST['Confirm']))
{
	$query=mysqli_query($conn, "INSERT INTO Medical_Certificate SELECT * FROM Temp_Medical_Certificate;");
	if ($query)
	{
	?>
	
		<script>alert("Success")</script>
	<?php
	}
	else {
	?>
		<script>alert("Insert to database failed")</script>
	<?php
		}
}
	

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Issue Medical Certificate</title>

<!--CSS-->
<link href="../css/medical_certificate.css" rel="stylesheet" type="text/css"> 
<script src="../jQueryAssets/js/jquery.min.js"></script>
<link rel="stylesheet" href="../jQueryAssets/js_css/jquery-ui.css"/>
<script src="../jQueryAssets/js/jquery-ui.min.js"></script>
<script src="../jQueryAssets/js/issuemedcert.js" type="text/javascript"></script>


<!-- Datepicker -->
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="../jQueryAssets/datepicker/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$( ".Datepicker" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true, dateFormat:"dd-mm-yy"}); 
});
</script>

<!-- dataTable -->
<link href="../jQueryAssets/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/shCore.css">
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/demo.css">
<style type="text/css" class="init">
</style>
<!--	<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/jquery.js"></script> -->
	<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">


$(document).ready(function()
{
	$('#data').DataTable();	
} );


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
	if (($_POST['Name'] != NULL) and ($_POST['RollNo'] != NULL) and ($_POST['From'] != NULL) and ($_POST['Days']!=NULL))
	{
		$iss_date = date("Y-m-d", strtotime($_POST['IssueDate']));
		$name = $_POST['Name'];
		$type = $_POST['Type'];
		$rollno = $_POST['RollNo'];
		$dep = $_POST['Dependent'];
		$from = date("Y-m-d", strtotime($_POST['From']));
		$days = $_POST['Days'];
		$cause = $_POST['Cause'];
		$doctor = $_POST['Doctor'];
		$result = mysqli_query($conn,"SELECT * FROM Temp_Medical_Certificate WHERE CftNo=(select max(CftNo) from Temp_Medical_Certificate);");
		$row = mysqli_fetch_array($result);
		$slno = $row['CftNo']+1;
		//$result = mysqli_query($conn, "INSERT INTO Medical_Certificate VALUES ('2','2015-08-12','Vishnu','Student','B120806cs','2014-04-03','5','Cold','VishalPeter');");
		$result = mysqli_query($conn, "INSERT INTO Temp_Medical_Certificate VALUES ('{$slno}','{$iss_date}','{$name}','{$type}','{$rollno}','{$dep}','{$from}','{$days}','{$cause}','{$doctor}');");
		if (!$result)
		{
		?>
			<script>
			window.alert("Values not Inserted. Name, Patient Id, From Date and No of Days are required");
			</script>
<?php
		}
	}
	else
	{
?>
		<script>
			window.alert("Please fill in Name, Roll No, From Date and No of Days to insert");
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
		<th>Patient ID</th>
		<th>Name</th>
		<th>Dependent</th>
		<th>Date</th>
		<th>Type</th>
		<th>From</th>
		<th>Days</th>
		<th>Cause</th>
		<th>Doctor</th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><input type="text" name="RollNo" size="12" onchange="get_patient_by_id()"></td>
		<td><input type="text" name="Name" size="18"></td>
		<td><input type="text" name="Dependent" size="18" onchange="get_patient_by_dependent()"></td>
		<td><input type="text" class='Datepicker' name="IssueDate" size="8" maxlength="10"></td>
		<td><input type="text" name="Type" size="10"></td>
		<td><input type="text" class='Datepicker' name="From"  size="9" maxlength="10"></td>
		<td><input type="text" name="Days" size="6"></td>
		<td><input type="text" name="Cause" size="18"></td>
		<td><input type="text" name="Doctor" size="18"></td>
	</tr>
	</tbody>
	</table>
	<th><input type="submit" name="insert" value="Insert" class="button" style="position:relative;left:40%;top:50px" ></th>
</form>
</div>
</div>
<a id="pdf_link" href="med_cft_pdf.php" target="_blank">Print Certificate</a>
<div id="datatable1">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">
			<th>Sl</th>
			<th>Pat. ID</th>
			<th>Name</th>
			<th>Dep</th>
			<th>Date</th>
			<th>Type</th>
			<th>From</th>
			<th>Days</th>
			<th>Cause</th>
			<th>Doctor</th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>	
	<tbody>	
		<?php
			if(isset($_POST['delete'])) 
			{
				$slno = $_POST['SlNo'];
				mysqli_query($conn, "DELETE  FROM Temp_Medical_Certificate WHERE (CftNo='{$slno}');");
			}
			if(isset($_POST['confirm'])) 
			{
				$result = mysqli_query($conn,"SELECT * FROM Medical_Certificate WHERE CftNo=(select max(CftNo) from Medical_Certificate);");
				$row = mysqli_fetch_array($result);
				$slno = $row['CftNo']+1;				
				$tslno = $_POST['SlNo'];
				$neg1 = -1;
				mysqli_query($conn, "UPDATE Temp_Medical_Certificate SET CftNo='{$neg1}' WHERE (CftNo='{$tslno}');");
				mysqli_query($conn, "INSERT INTO Medical_Certificate (SELECT * FROM Temp_Medical_Certificate WHERE (CftNo='{$neg1}'));");
				mysqli_query($conn, "UPDATE Medical_Certificate SET CftNo='{$slno}' WHERE (CftNo='{$neg1}');");
				mysqli_query($conn, "DELETE  FROM Temp_Medical_Certificate WHERE (CftNo='{$neg1}');");
			}
			
			$result = mysqli_query($conn, "SELECT * from Temp_Medical_Certificate");
			while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
			<form action="med_cft_pdf.php" method="post" target="_blank">
				<td><center><input type="hidden" name="SlNo" value="<?php echo $row['CftNo'];?>"><?php echo $row['CftNo'];?></center></td>
				<td><center><input type="hidden" name="RollNo" value="<?php echo $row['RollNo'];?>"><?php echo $row['RollNo'];?></center></td>
				<td><center><input type="hidden" name="Name" value="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></center></td>
				<td><center><input type="hidden" name="Dependent" value="<?php echo $row['Dependent'];?>"><?php echo $row['Dependent'];?></center></td>
				<td><center><input type="hidden" name="IssueDate" value="<?php echo date("d-m-Y",strtotime($row['IssueDate']));?>"><?php echo date("d-m-Y",strtotime($row['IssueDate']));?></center></td>
				<td><center><input type="hidden" name="PatientType" value="<?php echo $row['PatientType'];?>"><?php echo $row['PatientType'];?></center></td>
				<td><center><input type="hidden" name="FromDate" value="<?php echo date("d-m-Y",strtotime($row['FromDate']));?>"><?php echo date("d-m-Y",strtotime($row['FromDate']));?></center></td>
				<td><center><input type="hidden" name="NoOfDays" value="<?php echo $row['NoOfDays'];?>"><?php echo $row['NoOfDays'];?></center></td>
				<td><center><input type="hidden" name="Cause" value="<?php echo $row['Cause'];?>"><?php echo $row['Cause'];?></center></td>
				<td><center><input type="hidden" name="Doctor" value="<?php echo $row['Doctor'];?>"><?php echo $row['Doctor'];?></center></td>
				<td><center><input type="submit" name="delete" value="delete" onclick='this.form.target="";this.form.action="";'></center></td>
				<td><center><input type="submit" name="confirm" value="confirm" onclick='this.form.target="";this.form.action=""'></center></td>
				<td><center><input type="submit" name="print" value="print" id="print_btn"></center></td>
			</form>

		</tr>
		<?php } ?>
		
	</tbody>
</div>
</body>
</html>
