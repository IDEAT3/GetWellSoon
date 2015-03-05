<?php
	include ('../lib/session.php');
	include ('../lib/configure.php');
	if($login_type=='doctor') {header("location: ../doctor_home.php");}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Stock</title>

<!--CSS-->
<link href="../css/record_tables.css" rel="stylesheet" type="text/css"> 

<!-- Datepicker -->
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="../jQueryAssets/datepicker/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../jQueryAssets/datepicker/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$( ".Datepicker" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true}); 
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


$(document).ready(function() {
	$('#data').DataTable();	
} );


	</script>
</head>

</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<div id="table1">
Add Stock:-

<?php
if(isset($_POST['insert'])) {
	$sql = "INSERT INTO temp_medicine_stock VALUES ('{$_POST['Date']}','{$_POST['BillNo']}','{$_POST['ReceivedFrom']}','{$_POST['Medicine']}','{$_POST['BatchNo']}','{$_POST['Expiry']}','{$_POST['Qty']}','{$_POST['Cost']}');";
	if ($conn->query($sql) === TRUE) {
 //   echo "New records created successfully";
} else {
 //   echo "Error: " . $sql . "<br>" . $conn->error;
}

}

?>

<form action="" method="post">
    <table cellspacing=7>
	<thead>
		<tr>
		<th>Date</th>
		<th>Bill No</th>
		<th>Received From</th>
		<th>Medicine</th>
		<th>Batch No</th>
		<th>Expiry</th>
		<th>Qty</th>
		<th>Cost</th>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><input type="text" class='Datepicker' name="Date" size="9" maxlength="10"></td>
		<td><input type="text" name="BillNo" size="12"></td>
		<td><input type="text" name="ReceivedFrom" size="30"></td>
		<td><input type="text" name="Medicine" size="30"></td>
		<td><input type="text" name="BatchNo" size="12"></td>
		<td><input type="text" class='Datepicker' name="Expiry"  size="9" maxlength="10"></td>
		<td><input type="text" name="Qty" size="6"></td>
		<td><input type="text" name="Cost" size="6"></td>
		<th><input type="submit" name="insert" value="Insert" ></th>
	</tr>
	</tbody>
	</table>

</form>
</div>
<div id="datatable1">
<table id="data" class="display">
	<thead>
		<tr id=datatable2">
			
			<th>Date</th>
			<th>Bill No</th>
			<th>Received From</th>
			<th>Medicine</th>
			<th>Batch No</th>
			<th>Expiry</th>
			<th>Qty</th>
			<th>Cost</th>
			<th>Delete</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			if(isset($_POST['delete'])) {
				mysqli_query($conn, "DELETE FROM temp_medicine_stock WHERE (`BatchNo`='{$_POST['BatchNo']}');");
			}
			$result = mysqli_query($conn, "SELECT * from temp_medicine_stock");
			while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
			<form action="" method="post">
				<td><center><?php echo $row['Date'];?></center></td>
				<td><center><?php echo $row['BillNo'];?></center></td>
				<td><center><?php echo $row['RecievedFrom'];?></center></td>
				<td><center><?php echo $row['MedicineName'];?></center></td>
				<td><center><input type="hidden" name="BatchNo" value="<?php echo $row['BatchNo'];?>"><?php echo $row['BatchNo'];?></center></td>
				<td><center><?php echo $row['Expiry'];?></center></td>
				<td><center><?php echo $row['Qty'];?></center></td>
				<td><center><?php echo $row['Cost'];?></center></td>
				<td><center><input type="submit" name="delete" value="delete"></center></td>
			</form>
		</tr>
		<?php } ?>
		<input type="submit" name="confirm" value="Confirm" class="confirm">
	</tbody>
</div>

</body>
</html>