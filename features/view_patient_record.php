<?php
	session_start();
	include ('../lib/configure.php');
	if(isset($_SESSION['login_type']))
	{
		if (!(($_SESSION['login_type']=="Doctor")or($_SESSION['login_type']=='admin')or($_SESSION['login_type']=='labadmin'))) 
		{
			header("location: ../index.php");
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
<script src="../jQueryAssets/js/jquery.min.js"></script>        
<link rel="stylesheet" href="../jQueryAssets/js_css/jquery-ui.css" /> 
<script src="../jQueryAssets/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../jQueryAssets/js/view_pat.js"></script>

</head>

<body>
<input type="button" class="home" value="" onClick="<?php if($_SESSION['login_type']=="Doctor") { ?>location.href='../doctor_home.php' <?php } else if($_SESSION['login_type']=="labadmin") { ?>location.href='../lab_admin_home.php' <?php } else { ?> location.href='../home.php'<?php } ?>">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">

<div id="search_bar">
	<form method="post" action="view_record.php">
	<span class="search_by">
		<span>Id &nbsp;&nbsp;&nbsp;<input type="text" id="pat_id" name="pat_id" onchange="get_patient_by_id()" autofocus onfocus="var val=this.value; this.value=''; this.value= val;"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>Name &nbsp;&nbsp;&nbsp;<input type="text" name="pat_name" oninput="get_patient_by_name()" id="pat_name"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<span>Dependent&nbsp;&nbsp;&nbsp; <input type="text" name="pat_dep" id="pat_dep" onblur="get_patient_by_dependent()"></span>
	<div class="hidden">
				<input type="submit" value="View Record" name="view_button" id="view_button" style='background-color:#4AAA00;'>
	</span>
	<div id="hidden_fields">
			Sex: <span class="hidden_items" id="sex"></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Age: <span class="hidden_items" id="age"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			DOB: <span class="hidden_items" id="DOB"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
