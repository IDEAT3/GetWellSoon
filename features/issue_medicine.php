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


if(isset($_POST['submit'])) {
	$_SESSION['pid']=$_POST['Patient_Id'];
	$_SESSION['dep']=$_POST['Dependent'];
	$_SESSION['cause']=$_POST['Cause'];
	$_SESSION['name']=$_POST['Name'];
	$_SESSION['sex']=$_POST['Sex'];
	$_SESSION['age']=$_POST['Age'];
}

function unsett() {
	unset($_SESSION['pid']);
	unset($_SESSION['dep']);
	unset($_SESSION['cause']);
	unset($_SESSION['name']);
	unset($_SESSION['sex']);
	unset($_SESSION['age']);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Issue Medicine</title>
<link rel="icon" href="../images/cross.png" type="image/gif" sizes="16x16"> 
<link href="../css/issue_med.css" rel="stylesheet" type="text/css">
<!-- <link href="../css/record_tables.css" rel="stylesheet" type="text/css"> -->
<script src="../jQueryAssets/js/issuemed.js" ></script>


<!-- Datepicker -->
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="../jQueryAssets/datepicker/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../jQueryAssets/datepicker/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$( "input:text[name=1date]" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true, dateFormat:"yy-mm-dd"}); 
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
});


	</script>
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<div>
<div id="issue_med_form">
Issue Medicine:-

<?php
if(isset($_POST['Add'])) {
	$date=date("Y-m-d");
	$sql = "INSERT INTO temp_consultation VALUES ('{$_SESSION['pid']}','{$_SESSION['dep']}','{$date}','{$_SESSION['cause']}','{$_POST['MedicineName']}','{$_POST['Timings']}','{$_POST['NoOfDays']}');";	
	if(mysqli_query($conn,$sql)==false) {
		?> <script> alert("Could not issue the medicine"); </script> <?php
	}
}
?>

	<form id="f1" action="" method="post">
    Patient ID:<input name="Patient_Id" id="Patient_Id" type="text" class ="input_class_id" readonly value="<?php echo $_SESSION['pid']; ?>">&nbsp;
    Name: <input name="Name" type="text" id="Name" class ="input_class_name" readonly value="<?php echo $_SESSION['name']; ?>">&nbsp;
    Dependent: <input name="Dependent" type="text" id="Dependent" class ="input_class_name" readonly value="<?php echo $_SESSION['dep']; ?>">&nbsp;
    Sex: <input name="Sex" type="text" id="Sex" class ="input_class_small" readonly value="<?php $_SESSION['sex']; ?>">&nbsp;
    Age:<input name="Age" type="text" id="Age" class ="input_class_small" readonly value="<?php echo $_SESSION['age']; ?>"> &nbsp;
	Cause: <input type='text' name='cause' class ='input_class_id' readonly value="<?php echo $_SESSION['cause']; ?>">&nbsp;
    </form>

<?php   
	if(isset($_POST['confirm'])) {
		$query=mysqli_query($conn, "INSERT INTO consultation SELECT * FROM temp_consultation");
		if($query) {
			$query=mysqli_query($conn, "DELETE FROM temp_consultation WHERE 1");
			unsett();
			?>
			<script>alert("Medicines issued.");
			window.location.assign("../features/issue_med.php");
			</script>
			<?php
		}
		else {?>
			 <script>alert("Some error in issuing medicine")</script>
			<?php
		}
	}
?>
		
<form id='f2' action='' method='post'>
Medicine: <input type='text' name='MedicineName' class ='input_class_name' >&nbsp;&nbsp;Timings: <input type='text' name='Timings' class ='input_class_ms'>&nbsp;&nbsp;No.of Days<input type='text' name='NoOfDays' class ='input_class_small'>&nbsp;
<input type='submit' name='Add' value='Issue'>
</form>
<form action="" method="post">
	<input type="submit" name="confirm" value="Confirm" class="button" id="confrm">
</form>

<div id='datatable4'>
<table id='data' class='display'>
	<thead>
		<tr id='datatable2'>
			<th>Date</th>
			<th>Cause</th>
			<th>Medicine</th>
			<th>Timings</th>
			<th>No.of Days</th>
			<th>Remove</th>
		</tr>
	</thead>	
	<tbody>
	<?php
			if(isset($_POST['delete'])) {
				$query = mysqli_query($conn, "DELETE FROM temp_consultation WHERE (`MedicineName`='{$_POST['mn']}');");
				if(!$query) echo "niio";
			}
			$result = mysqli_query($conn, 'SELECT * from temp_consultation');
			while($result && $row = mysqli_fetch_array($result)) {
		?>
		<tr>
			<form action='' method='post'>
				<td><center><?php echo $row['Date'];?></center></td>
				<td><center><?php echo $row['Cause'];?></center></td>
				<td><center><input type='hidden' name='mn' value="<?php echo $row['MedicineName']; ?>"><?php echo $row['MedicineName'];?></center></td>
				<td><center><?php echo $row['Timings'];?></center></td>
				<td><center><?php echo $row['NoOfDays'];?></center></td>
				<td><center><input type='submit' name='delete' value='delete'></center></td>
			</form>
		</tr>
		<?php } ?>
		
	</tbody>
	</div>
</div>
</div>
</body>
</html>
