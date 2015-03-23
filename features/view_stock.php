<?php
	include '../lib/configure.php';
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
<title>View Stock</title>
<!--CSS-->
<link href="../css/record_tables.css" rel="stylesheet" type="text/css"> 

<!-- dataTable -->
<link href="../jQueryAssets/datatables/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/shCore.css">
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/demo.css">
<style type="text/css" class="init">
</style>
<script type="text/javascript" language="javascript" src="../jQueryAssets/datatables/js/jquery.js"></script>
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
View Stock:-
</div>
<div id="datatable3">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">		
			<th>Date</th>
			<th>Bill No</th>
			<th>Received From</th>
			<th>Medicine Name</th>
			<th>Batch No</th>
			<th>Expiry</th>
			<th>Qty</th>
			<th>Cost</th>
		</tr>
	</thead>	
	<tbody>
	
		<?php
			if (isset($_GET['q']) && $_GET['q'] != NULL)
			{
				$med_name = $_GET['q'];
				$result = mysqli_query($conn, "SELECT * from medicine_stock where (MedicineName='$med_name')");
			}
		else {
				$result = mysqli_query($conn, "SELECT * from medicine_stock");
			}
			while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
			<form action="" method="post">
				<td><center><?php echo $row['Date'];?></center></td>
				<td><center><?php echo $row['BillNo'];?></center></td>
				<td><center><?php echo $row['RecievedFrom'];?></center></td>
				<td><center><?php echo $row['MedicineName'];?></center></td>
				<td><center><?php echo $row['BatchNo'];?></center></td>
				<td><center><?php echo $row['Expiry'];?></center></td>
				<td><center><?php echo $row['Qty'];?></center></td>
				<td><center><?php echo $row['Cost'];?></center></td>
			</form>
		</tr>
		<?php } ?>
		
	</tbody>
</div>
</body>
</html>
