<?php
	include(configure.php);
	$db = mysql_select_db("health_centre", $conn);
	session_start();
	$user_check=$_SESSION['login_user'];
	$ses_sql=mysql_query("SELECT * FROM member WHERE username='$user_check'", $conn);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session =$row['username'];
	$login_type=$row['type'];
	if(!isset($login_session)) {
		mysql_close($conn); 
		header('Location: ../index.php'); 
	}
?>
