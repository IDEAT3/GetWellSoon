<?php
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
	
	
	$q=$_GET['q'];
	echo $q;
	$sql="SELECT * from patient where Patient_Id = '{$q}'";
	$query=mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)==1) {
		$row = mysqli_fetch_array($query);
		echo "yes akshay";
		$_SESSION['Name'] = $row['Name'] ;
		$_SESSION['Dependent'] = $row['Dependent'];
		$_SESSION['Sex'] = $row['Sex'];
		$_SESSION['Age'] = $row['Age'];
		$_SESSION['Ph.No'] = $row['Ph.No'];
		$_SESSION['Alt.Ph.No'] = $row['Alt.Ph.No'];
		$_SESSION['DOB'] = $row['DOB'];
		$_SESSION['PermanentAddress'] = $row['PermanentAddress'];
		$_SESSION['LocalAddress'] = $row['LocalAddress'];
	}
	else {
		while($row = mysqli_fetch_array($query)) {
			
		}
	}
	echo "";
?>

