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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modify Patient Record</title>
<link href="../css/add_patient.css" rel="stylesheet" type="text/css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>        
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" /> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>‌​

<!-- Datepicker 
<link href="../jQueryAssets/datepicker/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/datepicker/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="../jQueryAssets/datepicker/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../jQueryAssets/datepicker/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
-->
<script type="text/javascript">
$(function() {
	$( "#datepicker" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true, dateFormat:"dd-mm-yy",yearRange: '1920:2050'}); 
});
</script>
<script type="text/javascript">




var xmlhttp;

function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
	xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function get_patient_by_id() {
	document.getElementsByName('Name')[0].setAttribute("value","");
	document.getElementsByName('Dependent')[0].setAttribute("value","");
	//if(arr[3]=="Female") {document.getElementById('F').checked=true;} else {document.getElementById('M').checked=true;}
	document.getElementsByName('Age')[0].setAttribute("value","");
	document.getElementsByName('Ph_No')[0].setAttribute("value","");
	document.getElementsByName('AltPh_No')[0].setAttribute("value","");
	document.getElementsByName('DOB')[0].setAttribute("value","");
	document.getElementsByName('Permanent_Address')[0].innerHTML="";
	document.getElementsByName('Local_Address')[0].innerHTML="";
	var p_id=document.getElementById("Patient_Id").value;
	if(p_id=="") {return;}
//	alert("ajax_pat_mod.php?q="+p_id);
	loadXMLDoc("../lib/ajax_pat_mod.php?q="+p_id,function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			var x=xmlhttp.responseText;
			//alert(x);
			var arr = x.split("!+!");
			if( arr[0] == "1") {
				document.getElementsByName('Name')[0].setAttribute("value",arr[1]);
				document.getElementsByName('Dependent')[0].setAttribute("value",arr[2]);
				if(arr[3]=="Female") {document.getElementById('F').checked=true;} else {document.getElementById('M').checked=true;}
				document.getElementsByName('Age')[0].setAttribute("value",arr[4]);
				document.getElementsByName('Ph_No')[0].setAttribute("value",arr[5]);
				document.getElementsByName('AltPh_No')[0].setAttribute("value",arr[6]);
				alert(document.getElementsByName('Name')[0].value);
				alert(arr[1]);
				document.getElementsByName('DOB')[0].setAttribute("value",arr[7]);
				document.getElementsByName('Permanent_Address')[0].innerHTML=arr[8];
				document.getElementsByName('Local_Address')[0].innerHTML=arr[9];
			}
			else if( arr[0] == "2"){
				document.getElementsByName('Name')[0].setAttribute("value",arr[1]);
				var dependents = arr.slice(2);
				//alert(dependents);
				$('#Dependent').autocomplete({
					source:dependents,
					minLength: 0,
					scroll:true
				}).focus(function() {
					$(this).autocomplete("search","");
				});
			}
			else {
				alert("This patient id doesn't exist!! To add a new user goto Add Patient!!");
			}
		}
	});
}
</script>
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="add_patient_form">
Modify Patient Details :-

<?php   
	if (isset($_POST['submit'])) {
		$date=date("Y-m-d", strtotime($_POST['DOB']));
		//$sql="UPDATE `health_centre`.`patient` SET `Patient_Id`= '{$_POST['Patient_Id']}' , `Name`= '{$_POST['Name']}' , `Dependent`= '{$_POST['Dependent']}', `Sex`= '{$_POST['Sex']}', `Age`= '{$_POST['Age']}', `Ph.No`= '{$_POST['Ph_No']}', `Alt.Ph.No`= '{$_POST['Altph_No']}', `DOB`= '{$date}', `PermanentAddress`= '{$_POST['Permanent_Address']}' , `LocalAddress`= '{$_POST['Local_Address']}') WHERE
		$query=mysqli_query($conn,$sql);
		if(!$query) {?>
			<script>alert("Patient was not added!! <?php echo $sql; ?>");</script>
			<?php
		}
		else {?>
			<script>alert("Successfully added patient!!");</script>
			<?php
		}
	}
?>	



<form action="" method="post">
	Patient ID: <input name="Patient_Id" type="text" id="Patient_Id" class ="input_class_med" onchange="get_patient_by_id()">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Name: <input name="Name" type="text" id="Name" class ="input_class_med" autocomplete="on"><br>
    Dependent: <input name="Dependent" type="text" id="Dependent" class ="input_class_med" autocomplete="on">&nbsp;&nbsp;&nbsp;&nbsp;
    Sex:&nbsp;<input name="Sex" type="radio" id="M" value="male" checked>Male &nbsp;
    		  <input name="Sex" type="radio" id="F" value="female">Female &nbsp;&nbsp;
    Age: <input name="Age" type="text" class ="input_class_small"><br>
	Ph. No: <input name="Ph_No" type="text" class ="input_class_med" autocomplete="on">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    DOB: <input name="DOB" id="datepicker" type="text" class ="input_class_med" autocomplete="on"><br>    
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
