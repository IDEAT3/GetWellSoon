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
$row = mysqli_fetch_array($result);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1)
{
	if ($mynewpw == "")$mynewpw = $pw;
	else $mynewpw=sha1($mynewpw);
	if ($myans1 == "")
	{
	 $myans1 = $row['Ans1'];
	 $mysec1 = $row['SecQn1'];
	}
	else $myans1 = sha1($myans1);
	if ($myans2 == "")
	{
	 $myans2 = $row['Ans2'];
	 $mysec2 = $row['SecQn2'];
	}
	else $myans2 = sha1($myans2);
	$sql="UPDATE users SET Name='$myname', UserName='$myusername', Password='$mynewpw', SecQn1='$mysec1', Ans1='$myans1', SecQn2='$mysec2', Ans2='$myans2', Type='Doctor' WHERE (UserName='$user' AND Password='$pw')";
	$result=mysqli_query($conn, $sql);
	header("location: doctor_update_profile.php?q=Success");
}
else	header("location: doctor_update_profile.php?q=Incorrect Password");
?>
