<?php
include ('../lib/configure.php');
session_start();
if(isset($_SESSION['login_type']))
{
	if ($_SESSION['login_type']=="Doctor")
	{
		header("location: ../doctor_home.php");
   	}
}
else
{
	header("location: ../index.php");
}


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Lab Admin</title>
<link href="../css/update_profile.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	function validate(form)
	{
		if (form.username.value == "")
		{
			alert("You must enter a username to add a lab admin");
			form.username.focus();
			window.scrollByLines(-8);
			form.username.value = "";
			return false;
			
		}
		if (form.new_pw.value == "")
		{
			alert("You must enter a doctor password to add a lab admin");
			form.username.focus();
			window.scrollByLines(-8);
			form.username.value = "";
			return false;
			
		}
		if (form.new_pw.value != form.retype.value)
		{
			alert("Passwords don't match");
			form.new_pw.focus();
			form.new_pw.value = "";
			form.retype.value="";
			window.scrollByLines(-4);
			return false;
		}
		if (form.pw.value == "")
		{
			alert("You must enter your current password to update changes");
			form.pw.focus();
			window.scrollByLines(4);
			return false;
		}
                if (form.sec_qn_1.value == "")
		{
			alert("You must enter 2 security questions and answers to add a lab admin");
			form.pw.focus();
			window.scrollByLines(4);
			return false;
		}
		if (form.sec_qn_2.value == "")
		{
			alert("You must 2 security questions and answers to add a lab admin");
			form.pw.focus();
			window.scrollByLines(4);
			return false;
		}
		if (form.ans1.value == "")
		{
			alert("You must 2 security questions and answers to add a lab admin");
			form.pw.focus();
			window.scrollByLines(4);
			return false;
		}
		if (form.ans2.value == "")
		{
			alert("You must 2 security questions and answers to add a lab admin");
			form.pw.focus();
			window.scrollByLines(4);
			return false;
		}

		return true;
	}
	
	<?php if(isset($_GET['q']))
	{
	?>
		alert("<?php echo $_GET['q'] ?>");
	<?php
		$_GET['q']="";
	}
	?>
</script>

</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<div id="table1">
	Add Lab Admin
	<form action="../lib/validate_lab_admin.php" method="post" name="fields" onsubmit="return validate(this);">
		<div class="input_area">
			<span>Name : </span><input name="name" type="text" class ="input_class_med" autofocus> <br/>
			<span>Qualification : </span><input name="qualification" type="text" class ="input_class_med"> <br/>
			<span>Username<sup style="color:red">*</sup> : </span><input name="username" type="text" class ="input_class_med"><br>
		</div>
		<p>Set Password</p>
		<div class="input_area">
			<span>New : </span><input name="new_pw" type="password" class ="input_class_med" autocomplete='off'><br/>
			<span>Retype :</span><input name="retype" type="password" class ="input_class_med"  autocomplete='off'><br>
		</div>
	
		<p>Security Questions</p>
		<div class="input_area">
			<span>Security Qn1 :</span><textarea name="sec_qn_1" cols="37" rows="13"></textarea><br>
			<span>Ans1 :</span><input name="ans1" type="password" class ="input_class_med"  autocomplete='off'><br>
			<span>Security Qn2 :</span><textarea name="sec_qn_2" cols="37" rows="13"></textarea><br/>
			<span>Ans2 :</span><input name="ans2" type="password" class ="input_class_med"><br/><br/>

			<span style="color:skyblue">Enter your password to add new lab admin<sup style="color:red">*</sup> </span>
			<br/>
			<input name="pw" type="password" class ="input_class_med" autocomplete='off'>
		</div>
		<input type="submit" name="submit" value="Add Lab Admin">
		<br/>
		<br/>
	</form>

</div>	

</body>
</html>

