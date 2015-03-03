<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Isuue Medicine</title>
<link href="../css/issue_med.css" rel="stylesheet" type="text/css">
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="issue_med_form">
Issue Medicine:-
	<form action="" method="post">
    	Roll No:<input name="Roll_No" type="text" class ="input_class_med" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" class ="input_class_med" autocomplete="on"><br>
    Dependent: <input name="Dependent" type="text" class ="input_class_med" autocomplete="on">&nbsp;&nbsp;&nbsp;&nbsp;
    Sex: <input name="Sex" type="text" class ="input_class_small">&nbsp;&nbsp;
    Age:<input name="Age" type="text" class ="input_class_small"> <br>
    
    
    
    
    //////////* Enter a table which increases dynamically with javascript*//////////////
    
    <input type="submit" name="submit" value="Confirm" >
    </form>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
</body>
</html>