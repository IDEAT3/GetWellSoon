<?php
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
	
	if(isset($_GET['id'])) 
	{
		$id=$_GET['id'];
		$sql="SELECT * from consultation where PatientId = '$id'";
		$query=mysqli_query($conn,$sql);
		$text="";
		while($row = mysqli_fetch_array($query)) 
		{
			$text = $text.$row['Date']."!+!".$row['Cause']."!+!".$row['MedicineName']."!+!".$row['Timings']."!+!".$row['NoOfDays']."!+!";
		}
		echo $text;
	}
?>

