<!--
 * File name: index.php
 * The first page in the website. The login page.
-->

<?php

include("lib/configure.php");
if(isset($_SESSION['login_type'])){
	if($_SESSION['login_type']=="admin") 
	{
		header("location: home.php");
	}
	else if($_SESSION['login_type']=="Doctor")
	{
		header("location: doctor_home.php");
	}
}

$error="";

if(isset($_POST['submit'])) {
	session_start();
	
	// Define $myusername and $mypassword
	$myusername=$_POST['username'];
	$mypassword=$_POST['password'];


	$myusername = stripslashes($myusername);
	$mypassword = stripslashes($mypassword);
	$myusername = mysqli_real_escape_string($conn,$myusername);
	$mypassword = sha1(mysqli_real_escape_string($conn,$mypassword));

	$sql="SELECT * FROM users WHERE UserName='$myusername' and Password='$mypassword'";
	$result=mysqli_query($conn, $sql);

// Mysql_num_row is counting table row
	$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

	if($count==1)
	{
		$row = mysqli_fetch_array($result);
		$_SESSION['login_user']=$myusername;
		$_SESSION['login_type']=$row['Type'];
		if($_SESSION['login_type']=="admin")
		{
			header("location: home.php");
		}
		else 
		{
			header("location: doctor_home.php");
		}		
	}
	else {
		$error.= "<br>Invalid username or password.";
	}
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NITC Health Centre</title>
<link href="css/login.css" type="text/css" rel="stylesheet"/>
<style type="text/css">
body,td,th {
	font-family: "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", Verdana, sans-serif;
}
</style>
</head>

<body bgcolor="1b1b1b">
<div class=logo></div>
<div class="login-form">
	<h1>Login </h1>
	<form action="" method="post">
		<li>
			<input type="text" name='username' class="text" autocomplete="on" onfocus="if(this.value == 'User Name') {this.value='';};" onblur="if (this.value == '') {this.value = 'User Name';}" value="User Name" ><p class=" icon user"></p>
		</li>
		<li>
			<input name = 'password' onfocus="if(this.value == 'Password') {this.type='password' ; this.value='';};" onblur="if (this.value == '') {this.type='text'; this.value = 'Password';}" value="Password" type="text"><p class=" icon lock"></p>
		</li>
        <div>
			<input type="submit" name="submit" value="Sign In" >
		</div>
        <span class="form_error"><?php echo $error; ?></span>
	</form>
	<a href="features/forgot_password.php" id="forgot_pw">forgot password</a>
</div>
</body>
</html>
