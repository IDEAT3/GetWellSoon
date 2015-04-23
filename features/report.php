<?php
	/* Assumes that add_stock.php and remove_stock.php populates the transactions table. Two additional fields - Type (Addition or Removal - Set to 'Addition' by default) and Transaction_Date (name="transaction_date")
	 * The table shows all fields in add_stock (with 'Date being renamed to Purchase_Date') plus Type field and Date field ( which will be the Transaction_Date in the database).
	*/
	include ('../lib/configure.php');
	session_start();
	if(isset($_SESSION['login_type']))
	{
	if ($_SESSION['login_type']=="Doctor") 
	{
		header("location: ../doctor_home.php");
	}
}
else {
	header("location: ../index.php");
}
	$count=0;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Report</title>
<!--CSS-->
<link href="../css/report.css" rel="stylesheet" type="text/css"> 

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

<script>
	function reset()
	{
		<?php $count = 0; ?>;
	}
</script>

</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<div id="table1">
Report :- 
</div>

<div id="from_to">
	<form action="" method=POST>
		From
		<td><input type="text" class='Datepicker' name="from" size="20" maxlength="10" style="background-color:#242426;color:white" value=<?php echo $_POST['from'];?>></td>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		To
		<td><input type="text" class='Datepicker' name="to" size="20" maxlength="10" style="background-color:#242426;color:white" value=<?php echo $_POST['to'];?>></td> 
		<input type="submit" name="go" value="Go" class="button" id="go">
	</form>   
</div>

<div id="Stock_Values">
	<span id="total_transactions">Total Transactions = 0></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span id="total_value">Total Value = 0</span>
</div>

<div id="datatable3">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">
			<th>Type</th>
			<th>Date</th>		
			<th>Purchase Date</th>
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
			$frm=date("Y-m-d", strtotime($_POST['from']));
			$to=date("Y-m-d", strtotime($_POST['to']));
			$result = mysqli_query($conn, "SELECT * from Transactions WHERE ((Transaction_Date >= '$frm') AND (Transaction_Date <= '$to'));");
			while($row = mysqli_fetch_array($result)) {
				$count = $count+1;
		?>
		<tr>
			<form action="" method="post">
				<td><center><?php echo $row['Type'];?></center></td>
				<td><center><?php echo date("d/m/Y",strtotime($row['Transaction_Date']));?></center></td>
				<td><center><?php echo date("d/m/Y",strtotime($row['Date']));?></center></td>
				<td><center><?php echo $row['BillNo'];?></center></td>
				<td><center><?php echo $row['RecievedFrom'];?></center></td>
				<td><center><?php echo $row['MedicineName'];?></center></td>
				<td><center><?php echo $row['BatchNo'];?></center></td>
				<td><center><?php echo date("d/m/Y",strtotime($row['Expiry']));?></center></td>
				<td><center><?php echo $row['Qty'];?></center></td>
				<td><center><?php echo $row['Cost'];?></center></td>
			</form>
		</tr>
		<?php }
			$result = mysqli_query($conn, "SELECT SUM(Cost) AS Total from Transactions WHERE ((Transaction_Date >= '$frm') AND (Transaction_Date <= '$to') AND (Type='Addition'));");
			$row = mysqli_fetch_array($result);
			if ($row['Total']==NULL) $add = 0; else $add = $row['Total'];
			//$result = mysqli_query($conn, "SELECT SUM(Cost) AS Total from Transactions WHERE ((Transaction_Date >= '$frm') AND (Transaction_Date <= '$to') AND (Type='Removal'));");
			//$row = mysqli_fetch_array($result);
			//if ($row['Total']==NULL) $rem = 0; else $rem = $row['Total'];
	    ?>
	<script>
		document.getElementById("total_value").innerHTML = "Value Added : <?php echo $add ?>";
		document.getElementById("total_transactions").innerHTML = "No of Transactions : <?php echo $count ?>";
	</script>
	
	</tbody>
</div>
</body>
</html>
