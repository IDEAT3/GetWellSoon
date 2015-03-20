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
<title>Modify Patient Record</title>
<link href="../css/add_patient.css" rel="stylesheet" type="text/css">
</head>
<body>
	
	
</body>
</html>

