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
<title>Delete Records</title>
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

<script type="text/javascript">
$(function() {
	$("#selectall").click(function() {
		$('.case').attr('checked',this.checked);
	});
	$(".case").click(function() {
		if($(".case").length==$(".case:checked").length) {
			$("#selectall").attr("checked","checked");
		}
		else {
			$("#selectall").removeAttr("checked");
		}
	});
});
</script>


</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">

<div id="table1">
Delete Record:-
</div>

<div id="datatable3">
<table id="data" class="display">
	<thead>
		<tr id="datatable2">		
			<th><input id="selectall" type="checkbox"></th>
			<th>Patient ID</th>
			<th>Name</th>
			<th>Dependent</th>
		</tr>
	</thead>	
	<tbody>
	
		<?php
			$result = mysqli_query($conn, "SELECT * from patient");
			while($row = mysqli_fetch_array($result)) {
		?>
		<tr>
			<form action="" method="post">
				<td><center><input class="case" name="case" value="1" type="checkbox"></center></td>
				<td><center><?php echo $row['Patient_Id'];?></center></td>
				<td><center><?php echo $row['Name'];?></center></td>
				<td><center><?php echo $row['Dependent'];?></center></td>
			</form>
		</tr>
		<?php } ?>
		
	</tbody>
</div>
</body>

</html>