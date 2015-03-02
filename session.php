<?php
	$connection = mysql_connect("localhost", "admin", "password");
	$db = mysql_select_db("health_centre", $connection);
	session_start();
	$user_check=$_SESSION['login_user'];
	$ses_sql=mysql_query("SELECT * FROM member WHERE username='$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session =$row['username'];
	$login_type=$row['type'];
	if(!isset($login_session)) {
		mysql_close($connection); 
		header('Location: index.php'); 
	}
?>
