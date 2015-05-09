<!doctype html>
<html>
<head>

<?php

/* Check the password entered on 'Add doctor page' and update the database accordingly. */

include ('../lib/configure.php');
session_start();
if(isset($_SESSION['login_type']))
{
	if ($_SESSION['login_type']=="Doctor") 
	{
		header("location: ../features/doctor_home.php");
	}
}
else 
{
	header("location: ../index.php");
}

if (isset($_POST['submit']))
{
	$sec_1 = "India's first moon mission in small letters?";
	$sec_2 = "NITC expansion of 'N' in small letters?";
	$ans_1 = "chandrayaan"; 
	$ans_2 = "national"; 
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
	$mynewpw =$_POST['new_pw'];
	$mysec1 = $_POST['sec_qn_1'];
	$myans1 = $_POST['ans1'];
	$mysec2 = $_POST['sec_qn_2'];
	$myans2 = $_POST['ans2'];


	$sql="SELECT * FROM users WHERE (UserName='$user' and Password='$pw');";
	$result=mysqli_query($conn, $sql);

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
		$mynewpw = sha1($mynewpw);
		$myans1 = sha1($myans1);
		$myans2 = sha1($myans2);
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
}
else $msg= "Please go to Add Doctor to add a new doctor";
	header("location: ../features/add_doctor.php?q='$msg'");
?>
