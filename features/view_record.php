<?php
	session_start();
	include ('../lib/configure.php');

if (isset($_POST['view_button']))
{
	$pid = $_POST['pat_id'];
	$pname = $_POST['pat_name'];
	$_SESSION['pid'] = $pid;
}
else
{
	header("location: view_patient_record.php");
}

if (isset($_POST['rem_btn']))
{
	$pid = $_SESSION['pid'];
	$remark = $_POST['doc_rem'];
	$d = date("Y-m-d");
	$dep = "";
	$result = mysqli_query($conn, "INSERT INTO Remarks VALUES ('{$d}', '{$pid}', '{$dep}', '{$remark}');");
/*
 	if ($result)
	{
		?>
		<script> alert("Success")</script>
	<?php
	}
	else
	{
	?>
		<script>alert("Failed to add remark");</script>
	<?php
	}
*/
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Patient Record</title>
<link href="../css/view_patient_record.css" rel="stylesheet" type="text/css">
<script src="../lib/view_pat.js" type="text/javascript"></script>
<script src="../jQueryAssets/datepicker/jquery-1.8.3.min.js"></script>

<script>
	function getfocus()
	{
		document.getElementById("pat_id").focus();
	}
</script>

<!-- dataTable -->
<link href="../jQueryAssets/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/shCore.css">
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/demo.css">
<style type="text/css" class="init"></style>
<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/shCore.js"></script>
<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/demo.js"></script>
<script type="text/javascript" language="javascript" class="init">
$(document).ready(function() {
	$('#data').DataTable({
	        "dom": '<"toolbar1">frtip'
    } );
	$('#cft').DataTable({
	        "dom": '<"toolbar2">frtip'
    } );
 
	$('#remarks').DataTable({
	        "dom": '<"toolbar3">frtip'
    } );
    $("div.toolbar1").html('<h2 style="color:#E9E7E7">Medicines Issued</h2>');
    $("div.toolbar2").html('<h2 style="color:#E9E7E7">Medical Certificates Issued</h2>');
    $("div.toolbar3").html('<h2 style="color:#E9E7E7">Remarks</h2>');
} );
</script>

</head>

<body onLoad="getfocus()">
<input type="button" class="home" value="" onClick="<?php if($_SESSION['login_type']=="Doctor") { ?>location.href='../doctor_home.php' <?php } else { ?> location.href='../home.php'<?php } ?>">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">

<div id="search_bar">
	<form method="post" action="view_record.php">
	<span class="search_by">
		<span>Id &nbsp;&nbsp;&nbsp;<input type="text" id="pat_id" name="pat_id" onchange="get_patient_by_id()" value="<?php echo $pid;?>" autofocus></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>Name &nbsp;&nbsp;&nbsp;<input type="text" name="pat_name" id="pat_name" onchange="get_patient_by_name()" value="<?php echo $pname ?>"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>Dependent&nbsp;&nbsp;&nbsp; <input type="text" id="pat_dep"></span>
	<div class="hidden">
		<input type="submit" value="View Record" name="view_button" id="view_button" style='background-color:white;color:#00A212;font-family: "Times New Roman", Times, serif;'>
	</span>
	<div id="hidden_fields">
			Sex: <span class="hidden_items" id="sex"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Age: <span class="hidden_items" id="age"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			DOB: <span class="hidden_items" id="DOB"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Blood: <span class="hidden_items" id="blood"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Phone: <span class="hidden_items" id="Phone"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Address: <span class="hidden_items" id="addr"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	</div>
	<br/>
	<hr>
	</form>
</div>

<div id="pat_record" class="hidden_records" style="visibility:visible">
<?php
	if ($_SESSION['login_type']=="Doctor") 
	{
?>
		<div id="remark_form" style="position:absolute;left:20%;">
			<form method="post" action="" >
				<textarea rows="3" cols="100" name="doc_rem" id="add_remarks" type="text" size=80px> </textarea>
				<input type="submit" name="rem_btn" id="add_rem_btn" value="Add Remark" onsubmit="getfocus()" style="border:0;border-radius:5px;">
			<form>
		</div>
		<br/>
<?php
	}
?>
<table id="data" class="display">
	<br>
	<thead>
		<tr id="pat_head">		
			<th>Date</th>
			<th>Cause</th>
			<th>Medicine Name</th>
			<th>Timings</th>
			<th>No of Days</th>
		</tr>
	</thead>	
	<tbody>
	
<?php
	$result = mysqli_query($conn, "SELECT * FROM consultation WHERE (PatientId='$pid');");
	while($row = mysqli_fetch_array($result)) 
	{
?>
		<tr>
			<form action="" method="post">
				<td id="date_of_visit"><center><?php echo $row['Date'];?></center></td>
				<td id="cause"><center><?php echo $row['Cause'];?></center></td>
				<td id="med_name"><center><?php echo $row['MedicineName'];?></center></td>
				<td id="timings"><center><?php echo $row['Timings'];?></center></td>
				<td id="no_of_days"><center><?php echo $row['NoOfDays'];?></center></td>
			</form>
		</tr>
		
<?php } ?>
		
	</tbody>
</div>


<div id="med_cfts" class="hidden_records" style="visibility:visible">
<table class="display"	id="cft">
	<thead>
		<tr id="cft_head">
			<th>Cft No</th>		
			<th>Issue Date</th>
			<th>From</th>
			<th>Days</th>
			<th>Cause</th>
			<th>Doctor</th>
		</tr>
	</thead>	
	<tbody>
	
<?php
	$result = mysqli_query($conn, "SELECT * FROM Medical_Certificate WHERE (RollNo='$pid');");
	while($row = mysqli_fetch_array($result)) 
	{
?>
		<tr>
			<form action="" method="post">
				<td id="cft_no"><center><?php echo $row['CftNo'];?></center></td>
				<td id="iss_date"><center><?php echo $row['IssueDate'];?></center></td>
				<td id="from_date"><center><?php echo $row['FromDate'];?></center></td>
				<td id="days"><center><?php echo $row['NoOfDays'];?></center></td>
				<td id="cause"><center><?php echo $row['Cause'];?></center></td>
				<td id="doc_name"><center><?php echo $row['Doctor'];?></center></td>
			</form>
		</tr>
		
<?php } ?>
		
	</tbody>
</div>

<div id="docremarks" class="hidden_records" style="visibility:visible">
<table class="display"	id="remarks">
	<thead>
		<tr id="remarks_head">		
			<th>Date</th>
			<th>Remark</th>
		</tr>
	</thead>	
	<tbody>
	
<?php
	$result = mysqli_query($conn, "SELECT * FROM Remarks WHERE (Pat_Id='$pid');");
	while($row = mysqli_fetch_array($result)) 
	{
?>
		<tr>
			<form action="" method="post">
				<td id="rem_date"><center><?php echo $row['Date'];?></center></td>
				<td id="doc_remark"><center><?php echo $row['Remark'];?></center></td>
			</form>
		</tr>
		
<?php } ?>
		
	</tbody>
</div>


</body>
</html>
