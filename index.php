<?php
include('lib/login.php');
if(isset($_SESSION['login_user'])){
header("location: home.php");
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
    
</div>
</body>
</html>