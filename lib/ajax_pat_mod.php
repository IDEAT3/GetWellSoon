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
//	echo $q;
	$sql="SELECT * from patient where Patient_Id = '{$q}'";
	$query=mysqli_query($conn,$sql);
	$text="";
	if(mysqli_num_rows($query)==1) {
		$row = mysqli_fetch_array($query);
		$text="1!+!" . $row['Name'] . "!+!" . $row['Dependent'] . "!+!" . $row['Sex'] . "!+!" . $row['Age'] . "!+!" . $row['Ph.No'] . "!+!" . $row['Alt.Ph.No'] . "!+!" . $row['DOB'] . "!+!" . $row['PermanentAddress'] . "!+!" . $row['LocalAddress'];
	}
	else {
		$row = mysqli_fetch_array($query);
		$Name = $row['Name'];
		$text="2!+!" . $Name . "!+!" . $row['Dependent'];
		while($row = mysqli_fetch_array($query)) {
			$text = $text . "!+!" . $row['Dependent'];
			if($row['Name']!=$Name) {
				$Name="";
				break;
			}
		}
		if($Name=="") {
			$text="";
		}
	}
	echo $text;
?>

