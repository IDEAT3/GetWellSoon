<?php

/* Check the password entered on 'Add doctor page' and update the database accordingly. */

include ('../lib/configure.php');
session_start();
if(isset($_SESSION['login_user']))
{
	if ($_SESSION['login_user']=="doctor") 
	{
		header("location: ../doctor_home.php");
	}
}
else 
{
	header("location: ../index.php");
}

$sec_1 = "Your qualification ?";
$sec_2 = "Your nationality ?";
$ans_1 = "c263a358bc57ca76c15d8db610970ce7b88959f5"; //defaults to MBBS
$ans_2 = "a151302157444aa3f3ef5ac23116ea226d29c972"; //defaults to indian
$doc_pw = "1f0160076c9f42a157f0a8f0dcc68e02ff69045b";//doctor
$qual = "MBBS";
$name = "Doctor";

$user = $_SESSION['login_user'];
$pw = $_POST['pw'];
$pw = stripslashes($pw);
$pw = mysqli_real_escape_string($conn,$pw);
$pw = sha1($pw);
$myusername = $_POST['username'];
$myname = $_POST['name'];
$myqual = $_POST['qualification'];
$mynewpw = sha1($_POST['new_pw']);
$mysec1 = $_POST['sec_qn_1'];
$myans1 = sha1($_POST['ans1']);
$mysec2 = $_POST['sec_qn_2'];
$myans2 = sha1($_POST['ans2']);


$sql="SELECT * FROM users WHERE (UserName='$user' and Password='$pw');";
$result=mysqli_query($conn, $sql);


// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1)
{
	if ($myname == "")
	{
		$myname = $name;
	}
	if ($myqual == "")
	{
		$myqual = $qual;
	}
	if ($mynewpw == "")
	{
		$mynewpw = $doc_pw;
	}
	if ($mysec1 == "")
	{
		$mysec1 = $sec_1;
	}
	if ($mysec2 == "")
	{
		$mysec2 = $sec_2;
	}
	if ($myans1== "")
	{
		$myans1 = $ans_1;
	}
	if ($myans2 == "")
	{
		$myans2= $ans_2;
	}
	$sql="SELECT * FROM users WHERE UserName='$myusername'";
	$result=mysqli_query($conn, $sql);
	$count=mysqli_num_rows($result);
	if ($count < 1)
	{
		$sql="INSERT INTO users VALUES ('$myname', '$myusername', '$mynewpw', '$mysec1', '$myans1', '$mysec2', '$myans2', 'Doctor');"  ;
		$result=mysqli_query($conn, $sql);
		$msg = "Success";
	}
	else 
	{
		$msg = "Doctor already exists";
	}
}
else	
{
	$msg = "Incorrect Password";
}
header("location: add_doctor.php?q='$msg'");
?>
