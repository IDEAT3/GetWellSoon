<?php
	include '../lib/session.php';
	include ('../lib/configure.php');
	if($login_type=='doctor') {header("location: ../doctor_home.php");}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Remve Stock</title>
<!--CSS-->
<link href="../css/record_tables.css" rel="stylesheet" type="text/css"> 

<!-- dataTable -->
<link rel="stylesheet" type="text/css" href="../jQueryAssets/datatables/css/jquery.dataTables1.css">
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
Remove Stock:-
</div>
<div id="datatable4">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">		
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
			if(isset($_POST['remove'])) {
				$result = mysqli_query($conn, "SELECT `Qty` from medicine_stock WHERE (`BatchNo`='{$_POST['BatchNo']}');");       //primary key is med name+ batch no.
				$qty=mysqli_fetch_array($result);
				$qty=$qty['Qty'];
				if($_POST['Qty'] > $qty) {
					?><script> alert("Quantity to remove is more than the remaining quantity");</script><?php
				}
				else { 
					$qty=$qty-$_POST['Qty'];
					if($qty==0) {mysqli_query($conn, "DELETE FROM medicine_stock WHERE (`BatchNo`='{$_POST['BatchNo']}');");}
					else {
						mysqli_query($conn, "UPDATE medicine_stock SET `Qty`='{$qty}' WHERE (`BatchNo`='{$_POST['BatchNo']}');");
					}
				}
			}
			$result = mysqli_query($conn, "SELECT * from medicine_stock");
			while($row = mysqli_fetch_array($result)) {
		?>
		
		<tr>
			<form action="" method="post">
				<td><center><?php echo $row['RecievedFrom'];?></center></td>
				<td><center><?php echo $row['MedicineName'];?></center></td>
				<td><center><input type="hidden" name="BatchNo" value="<?php echo $row['BatchNo'];?>"><?php echo $row['BatchNo'];?></center></td>
				<td><center><?php echo $row['Expiry'];?></center></td>
				<td><center><input type="text" name="Qty" value="<?php echo $row['Qty'];?>" size="5"></center></td>
				<td><center><?php echo $row['Cost'];?></center></td>
				<td><center><input type="submit" name="remove" value="remove"></center></td>
			</form>
		</tr>
		<?php } ?>
	</tbody>
</div>
</body>
</html>
