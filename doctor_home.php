<!--
 * File name: doctor_home.php
 * makes sure that on doctors are able to access this page.
 * provides features to view patient's record and update the doctor's profile.
-->

<?php
session_start();
if(isset($_SESSION['login_user'])){
	if ($_SESSION['login_user']=="admin") {
		header("location: home.php");
	}
}
else {
	header("location: index.php");
}

include("lib/configure.php");
$user = $_SESSION['login_user'];

$result = mysqli_query($conn,"SELECT * FROM users WHERE (UserName='$user');");
$row = mysqli_fetch_array($result);
$name = "Dr. ".$row["Name"]

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
<?php echo $name;?><br><br>
<input type="button" class="view_patient_record" value="View Patient Record" onClick="location.href='features/view_patient_record.php'">
</div>

<input type="button" class="update_prof" value="Update Profile" onClick="location.href='features/doctor_update_profile.php'">
<input type="button" class="logout" value="logout" onClick="location.href='lib/logout.php'">
</body>
</html>
