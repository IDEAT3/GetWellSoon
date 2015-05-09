<!--
Error if same medicine name and batch no is added which is currently present in the database.

-->
<?php
include ('../lib/configure.php');
session_start();
if(isset($_SESSION['login_user']))
{
	if ($_SESSION['login_user']=="doctor") 
	{
		header("location: ../doctor_home.php");
	}
}
else 
{
	header("location: ../index.php");
}

if (!$_SESSION['temp_stat']==1) $_SESSION['item']=0;
	
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Stock</title>
<link rel="icon" href="../images/cross.png" type="image/gif" sizes="16x16"> 
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
if(isset($_POST['insert']))
{
	if (($_POST['Medicine'] != "") and ($_POST['BatchNo'] != "") and ($_POST['Date'] != "") and ($_POST['Qty']!="") and (is_numeric($_POST['Qty'])) and ($_POST['Qty'])>0)
	{
		$date=date("Y-m-d", strtotime($_POST['Date']));
		if ($_POST['Expiry'] != "")
			$expiry=date("Y-m-d", strtotime($_POST['Expiry']));
		else 
			$expiry=date("Y-m-d", strtotime("+8 years"));
		
		$sql = "INSERT INTO temp_medicine_stock VALUES ('{$date}','{$_POST['BillNo']}','{$_POST['ReceivedFrom']}','{$_POST['Medicine']}','{$_POST['BatchNo']}','{$expiry}','{$_POST['Qty']}','{$_POST['Cost']}');";
		if ($conn->query($sql) == TRUE)
		{
			$_SESSION['item']++;
			$_SESSION['temp_stat']=1;
		}
		else {?>
			 <script>alert("Medicine with same name and batch no exists")</script>
			<?php
		}
	}
	else
	{
		echo "<script>alert('Batch No, Medicine Name, Purchase Date and Quantity fields are required. Quantity should be a positive number')</script>";
	}
} 

?>

<?php   
	if(isset($_POST['confirm'])) 
	{
		$query=mysqli_query($conn, "INSERT INTO medicine_stock SELECT * FROM temp_medicine_stock ORDER BY MedicineName");
		if($query)
		{
			//populating Transactions table
			$result=mysqli_query($conn, "SELECT * FROM temp_medicine_stock");
			$cur_date = date("Y-m-d");
			while($row = mysqli_fetch_array($result))
			{
				$dt = $row['Date'];
				$bno = $row['BatchNo'];
				$rcvfrm = $row['RecievedFrom'];
				$md_nm = $row['MedicineName'];
				$btch_no = $row['BatchNo'];
				$exp = $row['Expiry'];
				$qnt = $row['Qty'];
				$cst = $row['Cost'];
				$Q=mysqli_query($conn, "INSERT INTO Transactions VALUES ('Addition', '{$cur_date}', '{$dt}', '{$bno}', '{$rcvfrm}', '{$md_nm}', '{$btch_no}', '{$exp}', '{$qnt}', '{$cst}');"); 
			}	
			//removing temporary stock
			mysqli_query($conn, "DELETE FROM temp_medicine_stock");
			?>
			<script>alert("<?php echo $_SESSION['item']; ?> item(s) added to stock.")</script>
			<?php
		}
		else {?>
			 <script>alert("Medicine with same name and batch no exists")</script>
			<?php
		}
		$_SESSION['item']=0;
		$_SESSION['temp_stat']=0;
	}
?>
<form action="" method="post">
	<input type="submit" name="confirm" value="Confirm" class="button" id="confrm">
</form>
	


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
		<th><input type="submit" name="insert" value="Insert" class="button" ></th>
	</tr>
	</tbody>
	</table>

</form>
</div>
<div id="datatable1">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">		
			<th>Purchase Date</th>
			<th>Bill No</th>
			<th>Received From</th>
			<th>Medicine Name</th>
			<th>Batch No</th>
			<th>Expiry</th>
			<th>Qty</th>
			<th>Cost</th>
			<th>Delete</th>
		</tr>
	</thead>	
	<tbody>	
		<?php
			if(isset($_POST['delete'])) 
			{
				mysqli_query($conn, "DELETE FROM temp_medicine_stock WHERE (`BatchNo`='{$_POST['BatchNo']}' AND `MedicineName`='{$_POST['MedicineName']}');");
				$_SESSION['item']--;
			}
			$result = mysqli_query($conn, "SELECT * from temp_medicine_stock");
			while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
			<form action="" method="post">
				<td><center><?php echo date("d/m/y",strtotime($row['Date']));?></center></td>
				<td><center><?php echo $row['BillNo'];?></center></td>
				<td><center><?php echo $row['RecievedFrom'];?></center></td>
				<td><center><input type="hidden" name="MedicineName" value="<?php echo $row['MedicineName'];?>"><?php echo $row['MedicineName'];?></center></td>
				<td><center><input type="hidden" name="BatchNo" value="<?php echo $row['BatchNo'];?>"><?php echo $row['BatchNo'];?></center></td>
				<td><center><?php echo date("d/m/y",strtotime($row['Expiry']));?></center></td>
				<td><center><?php echo $row['Qty'];?></center></td>
				<td><center><?php echo $row['Cost'];?></center></td>
				<td><center><input type="submit" name="delete" value="delete"></center></td>
			</form>
		</tr>
		<?php } ?>
		
	</tbody>
</div>

</body>
</html>
