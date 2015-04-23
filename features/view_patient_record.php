<?php
	session_start();
	include ('../lib/configure.php');
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
	
if (isset($_POST['pid']))
{	
	$pid = $_POST['pid'];
	$dep_name = $_POST['dep_name'];	
	$result=mysqli_query($conn, "SELECT * FROM consultation WHERE (pid='$pid' AND dep_name='$dep_name'));");
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Patient Record</title>
<link href="../css/view_patient_record.css" rel="stylesheet" type="text/css">
<script src="../lib/view_pat.js" type="text/javascript"></script>
<script src="../jQueryAssets/datepicker/jquery-1.8.3.min.js"></script>

<script>
	function getfocus()
	{
		document.getElementById("pat_id").focus();
	}
</script>

</head>

<body onLoad="getfocus()">
<input type="button" class="home" value="" onClick="<?php if($_SESSION['login_type']=="Doctor") { ?>location.href='../doctor_home.php' <?php } else { ?> location.href='../home.php'<?php } ?>">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">

<div id="search_bar">
	<form method="post" action="view_record.php">
	<span class="search_by">
		<span>Id &nbsp;&nbsp;&nbsp;<input type="text" id="pat_id" name="pat_id" onchange="get_patient_by_id()"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>Name &nbsp;&nbsp;&nbsp;<input type="text" name="pat_name" onchange="get_patient_by_name()" id="pat_name"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>Dependent&nbsp;&nbsp;&nbsp; <input type="text" id="pat_dep"></span>
	<div class="hidden">
				<input type="submit" value="View Record" name="view_button" id="view_button" style='background-color:#00A212;font-family:times'>
	</span>
	<div id="hidden_fields">
			Sex: <span class="hidden_items" id="sex"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Age: <span class="hidden_items" id="age"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			DOB: <span class="hidden_items" id="DOB"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Blood: <span class="hidden_items" id="blood"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Phone: <span class="hidden_items" id="Phone"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Address: <span class="hidden_items" id="addr"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
	</div>
	<br/>
	<hr>
	</form>
</div>

</body>
</html>
