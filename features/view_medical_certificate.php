<?php
	include '../lib/session.php';
	include '../lib/configure.php';
	if($login_type=='doctor') {header("location: ../doctor_home.php");}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Medical Certificate</title>
<!--CSS-->
<link href="../css/med_cft.css" rel="stylesheet" type="text/css"> 

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

<!-- dataTable -->
<link href="../jQueryAssets/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/shCore.css">
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/demo.css">
<style type="text/css" class="init">
</style>
<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/shCore.js"></script>
<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/demo.js"></script>
<script type="text/javascript" language="javascript" class="init">


$(document).ready(function() {
	$('#data').DataTable();	
} );


	</script>

</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<div id="table1">
View Medical Certificate
</div>

<div id="from_to">
	<form action="" method=POST>
		From
		<td><input id="frm" type="text" class='Datepicker' name="from" size="20" maxlength="10" style="background-color:#242426;color:white"></td>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		To
		<td><input type="text" class='Datepicker' name="to" size="20" maxlength="10" style="background-color:#242426;color:white"></td> 
		<input type="submit" name="go" value="Go" class="button" id="go">
	</form>   
</div>


<div id="datatable3">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">	
		<th>Sl No</th>	
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
	
		<?php
			if ((isset($_POST['go'])) AND (isset($_POST['from'])) AND (isset($_POST['to'])))
			{
				$frm=date("Y-m-d", strtotime($_POST['from']));
				$to=date("Y-m-d", strtotime($_POST['to']));
				$result = mysqli_query($conn, "SELECT * from Medical_Certificate WHERE ((IssueDate >= '$frm') AND (IssueDate <= '$to'));");
			}
			else
			{
				$result = mysqli_query($conn, "SELECT * from Medical_Certificate");
			}
				while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
			<form action="" method="post">
				<td><center><?php echo $row['CftNo'];?></center></td>
				<td><center><?php echo $row['IssueDate'];?></center></td>
				<td><center><?php echo $row['Name'];?></center></td>
				<td><center><?php echo $row['PatientType'];?></center></td>
				<td><center><?php echo $row['RollNo'];?></center></td>
				<td><center><?php echo $row['FromDate'];?></center></td>
				<td><center><?php echo $row['NoOfDays'];?></center></td>
				<td><center><?php echo $row['Cause'];?></center></td>
				<td><center><?php echo $row['Doctor'];?></center></td>
			</form>
		</tr>
		<?php } ?>
		
	</tbody>
</div>
</body>
</html>
