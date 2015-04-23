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
<title>Isuue Medicine</title>
<link href="../css/issue_med.css" rel="stylesheet" type="text/css">
<link href="../css/record_tables.css" rel="stylesheet" type="text/css"> 



<!-- Datepicker -->
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="../jQueryAssets/datepicker/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../jQueryAssets/datepicker/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$( "input:text[name=1date]" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true, dateFormat:"dd-mm-yy"}); 
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
if(isset($_POST['submit'])) {
	$sql = "SELECT * from patient where Patient_Id='{$_POST['Patient_Id']}' AND Name='{$_POST['Name']}' AND Dependent = '{$_POST['Dependent']}'";
	$result=mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) {
		$row=mysqli_fetch_array($result);  ?>
		<script type="text/javascript">
			$("input:text[name=Patient_Id]").val("<?php echo $_POST['Patient_Id']; ?>");
			$("input:text[name=Name]").val("<?php echo $_POST['Name']; ?>");
			$("input:text[name=Dependent]").val("<?php echo $_POST['Dependent']; ?>");
		</script>
<?php
	} else {
    ?> <script> alert("Patient does not exist"); </script> <?php
	}
}

?>


	<form id="f1" action="" method="post">
    Roll No:<input name="Patient_Id" type="text" class ="input_class_med" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" class ="input_class_med" autocomplete="on"><br>
    Dependent: <input name="Dependent" type="text" class ="input_class_med" autocomplete="on">&nbsp;&nbsp;&nbsp;&nbsp;
    Sex: <input name="Sex" type="text" class ="input_class_small">&nbsp;&nbsp;
    Age:<input name="Age" type="text" class ="input_class_small"> &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" name="submit" value="Get Patient" >
    </form>

<?php   
	if(isset($_POST['confirm'])) {
		$query=mysqli_query($conn, "INSERT INTO consultation SELECT * FROM temp_consultation");
		if($query) {
			mysqli_query($conn, "DELETE FROM temp_consultaion");
			?>
			<script>alert("Medicines issued.")</script>
			<?php
		}
		else {?>
			 <script>alert("Some error in issuing medicine")</script>
			<?php
		}
	}
?>
	
	
<form action="" method="post">
	<input type="submit" name="confirm" value="Confirm" class="button" id="confrm">
</form>
	
<form id='f2' action='' method='post'>
Date: <input type='text' name='1date' class ='input_class_ms'>&nbsp;&nbsp;&nbsp;Cause: <input type='text' name='1cause' class ='input_class_ms'>&nbsp;&nbsp;&nbsp;
Medicine: <input type='text' name='1medicine' class ='input_class_med' ><br>Timings: <input type='text' name='1timings' class ='input_class_ms'>&nbsp;&nbsp;&nbsp;No.of Days<input type='text' name='1no.ofdays' class ='input_class_small'>&nbsp;&nbsp;&nbsp;
<input type='submit' name='Add' value='Issue'>&nbsp;&nbsp;&nbsp;
</form>
</div>
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
				mysqli_query($conn, "DELETE FROM temp_consultation WHERE (`Patient_Id`='{$_POST['pid']})';");
			}
			$result = mysqli_query($conn, 'SELECT * from temp_consultation');
			while($result && $row = mysqli_fetch_array($result)) {
		?>
		<tr>
			<form action='' method='post'>
				<td><center><?php echo $row['Date'];?></center></td>
				<td><center><?php echo $row['Cause'];?></center></td>
				<td><center><input type='hidden' name='pid' value="<?php echo $_POST['Patient_Id']; ?>"><?php echo $row['Medicine'];?></center></td>
				<td><center><?php echo $row['Timings'];?></center></td>
				<td><center><?php echo $row['No.ofDays'];?></center></td>
				<td><center><input type='submit' name='delete' value='delete'></center></td>
			</form>
		</tr>
		<?php } ?>
		
	</tbody>
</div>
</div>
</body>
</html>