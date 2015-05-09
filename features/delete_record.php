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
<link rel="icon" href="../images/cross.png" type="image/gif" sizes="16x16"> 
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
	$('#data').DataTable({
		"aLengthMenu": [
         [10, 50, 100, -1],
         [10, 50, 100, "All"]
		]
	});	
} );
</script>

<script type="text/javascript">
$(function() {
	$("#selectall").change(function () {
		$(".case").prop('checked', $(this).prop("checked"));
	});
	$(".case").change(function() {
		if($(".case").length == $(".case:checked").length) {
			$("#selectall").prop('checked', 'checked');
		}
		else {
			$("#selectall").removeAttr("checked");
		}
	});
});
</script>

<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("#confiirm").click(function(e){
        if(!confirm('Are you sure you want to delete the selected records?')){
            e.preventDefault();
            return false;
        }
        return true;
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

<?php

	if(isset($_POST['confirm']) && isset($_POST['case'])) {
		$count=0;
		if( !isset($_POST['case']) || !is_array($_POST['case']) ) {
		?><script>alert("An error has occurred while processing your request");</script> 
		<?php
		}
		else {
		$delete = $_POST['case'];
		$flag=true;
		foreach ($delete as $val) {
			$patient = explode("!+!", $val);
			$result=mysqli_query($conn, "Delete from patient where Patient_Id = '{$patient[0]}' and Dependent = '{$patient[1]}'");
			if($result) {
				$result=mysqli_query($conn, "Delete from consultation where PatientId = '{$patient[0]}' and Dependent = '{$patient[1]}'");
				if($result) {
					$result=mysqli_query($conn, "Delete from medical_certificate where RollNo = '{$patient[0]}' and Dependent = '{$patient[1]}'");
					if($result) {
						$result=mysqli_query($conn, "Delete from remarks where Pat_Id = '{$patient[0]}' and Dep_Name = '{$patient[1]}'");
					}
					else {$flag=false; break;}
				}
				else {$flag=false; break;}
			}
			else {$flag=false;break;}
			$count++;
		}
		if ($flag) {
			?><script>alert("The <?php echo $count ;?> records have been deleted successfully.");</script> <?php
		} else {
			?><script>alert("An error has occurred while processing your request.");</script> <?php
		}
		}
	}
?>

<form action="" method="post">
	<input type="submit" name="confirm" value="Confirm" class="button" id="confiirm">

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
			$cnt=0;
			while($row = mysqli_fetch_array($result)) {
			$cnt++;
		?>
		<tr>
				<td><center><input type="checkbox" class="case" name="case[]" value="<?php echo $row['Patient_Id'] . "!+!" . $row['Dependent']; ?>" ></center></td>  <!-- Concatenating id + dependent sice only one value is passed.  -->
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
