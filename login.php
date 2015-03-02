<?php
session_start(); 
$error=''; 
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
	echo "Hello error";
		$error = "Username or Password is invalid";
	}
	else {
		$username=$_POST['username'];
		$password=$_POST['password'];
//	echo $username;
//	echo $password;
		$connection = mysql_connect("localhost", "admin", "password") or die("Failed to connect to MySQL: " . mysql_error());
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
////		$password = AES_ENCRYPT($password,$password);  need a new function
		$db = mysql_select_db("health_centre", $connection) or die("Failed to connect to db: " . mysql_error());
		if(!$db) {echo "lost";};
		$query = mysql_query("SELECT * FROM member WHERE password='$password' AND username='$username'", $connection) or die("Failed to connect to table: " . mysql_error());
		$rows = mysql_num_rows($query);
		if ($rows == 1) {
			$_SESSION['login_user']=$username; 
			header("location: home.php"); 
		} else {
			$error = "*Username or Password is invalid";
			mysql_close($connection);
		} 
	
	}
}
?>
