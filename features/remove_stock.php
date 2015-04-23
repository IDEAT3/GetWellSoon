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
<title>Remove Stock</title>
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
<div id="datatable3">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">
			<th>Purchase Date</th>		
			<th>Received From</th>
			<th>Medicine Name</th>
			<th>Batch No</th>
			<th>Expiry</th>
			<th>Qty</th>
			<th>Delete</th>
		</tr>
	</thead>	
	<tbody>
		<?php
			if(isset($_POST['remove']))
			 {
				$result = mysqli_query($conn, "SELECT `Qty` from medicine_stock WHERE (`BatchNo`='{$_POST['BatchNo']}');");       //primary key is med name+ batch no.
				$qty=mysqli_fetch_array($result);
				$qty=$qty['Qty'];
				if($_POST['Qty'] > $qty) 
				{
					?><script> alert("Invalid Quantity");</script><?php
				}
				else if (($_POST['Qty'] >= 0)and($_POST['Qty']<=1000000000)and (is_numeric($_POST['Qty'])))
				{ 
					//populating Transactions table
					$result=mysqli_query($conn, "SELECT * FROM medicine_stock WHERE (BatchNo= '{$_POST['BatchNo']}' AND MedicineName='{$_POST['MedicineName']}' );");
					$cur_date = date("Y-m-d");
					while($row = mysqli_fetch_array($result))
					{
					$dt = $row['Date'];
					$bno = $row['BatchNo'];
					$rcvfrm = $row['RecievedFrom'];
					$md_nm = $row['MedicineName'];
					$btch_no = $row['BatchNo'];
					$exp = $row['Expiry'];
					$qnt = $_POST['Qty'];
					$cst = $row['Cost'];
					$result=mysqli_query($conn, "INSERT INTO Transactions VALUES ('Removal', '{$cur_date}', '{$dt}', '{$bno}', '{$rcvfrm}', '{$md_nm}', '{$btch_no}', '{$exp}', '{$qnt}', '{$cst}');"); 
					}	
					$qty=$qty-$_POST['Qty'];
					if($qty==0) {mysqli_query($conn, "DELETE FROM medicine_stock WHERE (`BatchNo`='{$_POST['BatchNo']}');");}
					else 
					{
						mysqli_query($conn, "UPDATE medicine_stock SET `Qty`='{$qty}' WHERE (`BatchNo`='{$_POST['BatchNo']}');");
					}
				}
				else
				{
					?><script> alert("Invalid Quantity");</script><?php
				}
			}
			if(isset($_GET['q']) && $_GET['q']!=NULL){
				$med_name = $_GET['q'];
				$result = mysqli_query($conn, "SELECT * from medicine_stock where (MedicineName='$med_name');");
			}
			else {
				$result = mysqli_query($conn, "SELECT * from medicine_stock");
			}
			while($row = mysqli_fetch_array($result)) {
		?>
		
		<tr>
			<form action="" method="post">
				<td><center><?php echo date("d/m/Y",strtotime($row['Date']));?></center></td>
				<td><center><?php echo $row['RecievedFrom'];?></center></td>
				<td><center><input type="hidden" name="MedicineName" value="<?php echo $row['MedicineName'];?>"><?php echo $row['MedicineName'];?></center></td>
				<td><center><input type="hidden" name="BatchNo" value="<?php echo $row['BatchNo'];?>"><?php echo $row['BatchNo'];?></center></td>
				<td><center><?php echo date("d/m/Y",strtotime($row['Expiry']));?></center></td>
				<td><center><input type="text" name="Qty" value="<?php echo $row['Qty'];?>" size="5"></center></td>
				<td><center><input type="submit" name="remove" value="remove"></center></td>
			</form>
		</tr>
		<?php } ?>
	</tbody>
</div>
</body>
</html>
