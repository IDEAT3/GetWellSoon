<?php
include('lib/session.php');
if($login_type=='admin') {
	header("location:home.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $login_session; ?> Home Page</title>
<link href="css/doctor_home.css" rel="stylesheet" type="text/css">
</head>

<body>

<div id="doctor_detail">
<?php echo $login_session;?><br><br>
<input type="button" class="view_patient_record" value="View Patient Record" onClick=						"location.href='features/view_patient_record.php'">
</div>

<input type="button" class="update_prof" value="Update Profile" onClick="location.href='#'">
<input type="button" class="logout" value="logout" onClick="location.href='lib/logout.php'">
</body>
</html>