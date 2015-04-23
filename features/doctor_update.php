<?php

/* Check the password entered on 'update profile page' and update the database accordingly. */

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

$user = $_SESSION['login_user'];
$pw = $_POST['pw'];
$pw = stripslashes($pw);
$pw = mysqli_real_escape_string($conn,$pw);
$pw = sha1($pw);
$myusername = $_POST['username'];
$myname = $_POST['name'];
$mynewpw = $_POST['new_pw'];
$mysec1 = $_POST['sec_qn_1'];
$myans1 = $_POST['ans1'];
$mysec2 = $_POST['sec_qn_2'];
$myans2 = $_POST['ans2'];


$sql="SELECT * FROM users WHERE (UserName='$user' and Password='$pw');";
$result=mysqli_query($conn, $sql);


// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1)
{
	if ($mynewpw == "")
	{
		$mynewpw = $pw;
	}
	$sql="UPDATE users SET Name='$myname', UserName='$myusername', Password='$mynewpw', SecQn1='$mysec1', Ans1='$myans1', SecQn2='$mysec2', Ans2='$myans2', Type='admin' WHERE (UserName='$user' AND Password='$pw')";
	$result=mysqli_query($conn, $sql);
	header("location: update_profile_admin.php?q=Success");
}
else	header("location: update_profile_admin.php?q=Incorrect Password");
?>
