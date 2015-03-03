<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modify Patient Record</title>
<link href="../css/add_patient.css" rel="stylesheet" type="text/css">
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="add_patient_form">
Modify Patient Details :-
<form action="" method="post">
	Roll No: <input name="Roll_No" type="text" class ="input_class_med" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" class ="input_class_med" autocomplete="on"><br>
    Dependent: <input name="Dependent" type="text" class ="input_class_med" autocomplete="on">&nbsp;&nbsp;&nbsp;&nbsp;
    Sex:&nbsp;<input name="Sex" type="radio"value="male" checked>Male &nbsp;
    		  <input name="Sex" type="radio" value="female">Female &nbsp;&nbsp;
              Age: <input name="Age" type="text" class ="input_class_small"><br>
	Ph. No: <input name="Ph_No" type="text" class ="input_class_med" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    DOB: <input name="DOB" type="text" class ="input_class_med" autocomplete="on"><br>    
    Alt. Ph. No: <input name="AltPh_No" type="text" class ="input_class_med" autocomplete="on"><br>
    
	Permanent Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    Local Address: <br>
    <textarea id="Permadd" name="Permanent_Address" cols="37" rows="13"></textarea>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="button" class="button" value="Same" onClick="document.getElementById('locadd').value = document.getElementById('Permadd').value">
    <textarea id="locadd" name="Local_Address" cols="37" rows="13"></textarea><br>
    <input type="submit" name="submit" value="Confirm" >
</form>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
</body>
</html>