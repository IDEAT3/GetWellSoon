<?php
	include '../lib/session.php';
	if($login_type=='doctor') {header("location: ../doctor_home.php");}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Stock</title>
<link href="../css/record_tables.css" rel="stylesheet" type="text/css">
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="table_form">
View Stock:-
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
</body>
</html>