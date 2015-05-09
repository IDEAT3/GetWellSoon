<?php
include ('../lib/configure.php');
$def_pw = "password";
$def_sha1_pw = "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8";

if (isset($_POST['continue']))
{
	$user = $_POST['username'] ;
	$result = mysqli_query($conn,"SELECT * FROM users WHERE (UserName='$user');");
	$num = mysqli_num_rows($result);
	if ($num == 0) $valid = false;
	else
	{
		$row = mysqli_fetch_array($result);
		$sec1 = $row["SecQn1"];
		$sec2 = $row["SecQn2"];
		$valid = true;
	}
	if (!$valid)
		{	
?>
	<script>
		alert("Invalid username");
		form.username.focus();
		window.scrollByLines(-8);
		form.username.value = "";
	</script>
		<?php
		}
}

if (isset($_POST['reset_pw']))
{
	$myans1 = sha1($_POST['ans1']);
	$myans2 = sha1($_POST['ans2']);
	$user = $_POST['username'] ;
	$result = mysqli_query($conn,"SELECT * FROM users WHERE (UserName='$user');");
	$row = mysqli_fetch_array($result);
	$ans1 = $row["Ans1"];
	$ans2 = $row["Ans2"];
	if (($myans1 == $ans1)&&($myans2 == $ans2))
	{
		$sql="UPDATE users SET Password='$def_sha1_pw' WHERE (UserName='$user')";
		$result=mysqli_query($conn, $sql);
		echo '<script>';
		echo 'alert("Succesful reset to - password .\nPlease change the password once you login. ");';
		echo 'window.location.href = "../index.php";';
		echo '</script>';
	}
	else
	{
		echo '<script>';
		echo 'alert("Wrong answers. Try again");';
		echo '</script>';
	}
	
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reset Password</title>
<link rel="icon" href="../images/cross.png" type="image/gif" sizes="16x16"> 
<link href="../css/reset_password.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
	function validate(form)
	{
		
		if (form.username.value == "")
		{
			alert("Please enter a username");
			form.username.focus();
			window.scrollByLines(-8);
			form.username.value = "";
			return false;
			
		}
		return true;
	}
</script>
<?php
	echo '<script type="text/javascript">';
	echo 'function getfocus(){';
	if (isset($_POST['continue'])) 
		echo 'document.getElementById("ans1").focus();';
	else
		echo 'document.getElementById("usr_name").focus();';		
	echo '}';
	echo '</script>';
?>

</head>

<body onload="getfocus()">
	<input type="button" class="home" value="" onClick="location.href='../index.php'">
<div id="table1">
	Reset Password
	<form action="" method="post" name="fields" onsubmit="return validate(this);">
		<div class="input_area">
			<span>Username : </span><input id="usr_name" name="username" type="text" class ="input_class_med" autocomplete="on" value="<?php echo $_POST['username']; ?>" onfocus="var val=this.value; this.value=''; this.value= val;">
			<input type="submit" name="continue" value="Continue" <?php if (isset($_POST['continue']) and $valid) { ?> style="display:none;" <?php } ?>>
		</div>
	</form>
	
<?php if (isset($_POST['continue']) and $valid)
{	
?>
		<form action="" method="post"> 
		<div id="sec_area">
			<p>Answer these Security Questions</p>
			<div class="qn_area">
				<input name="username" style="display:none" value=<?php echo $_POST['username']; ?>>
				<span>Security Qn1 : </span> <span class="secqns"><?php echo $sec1; ?> </span><br>
				<span>Ans1 :</span><input id="ans1" name="ans1" type="password" class ="input_class_med" value="" autocomplete="off"><br>
				<span>Security Qn2 : </span> <span class="secqns"><?php echo $sec2; ?> </span><br>
				<span>Ans2 :</span><input name="ans2" type="password" class ="input_class_med" value="" autocomplete="off">
				<input type="submit" name="reset_pw" value="Reset Password" id="reset">
			</div>
			<br/>
			<br/>
		</div>
		</form>
<?php
}
?>
</div>	

</body>
</html>

