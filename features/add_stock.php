<?php
	$_SESSION['count']=1;
	$row_count=1;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Stock</title>
<link href="../css/record_tables.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<script src="../jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="../jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
</head>

<body>
<input type="button" class="home" value="" onClick="location.href='../home.php'">
<div id="table_form">
<form action="insert_to_stock.php" method="post">
Add Stock:-
<table width="1462" border="0" cellspacing="0" cellpadding="20">
	<thead>
    <tr>
      <td width="94">Date</td>
      <td width="95">Bill No</td>
      <td width="184">Recieved From</td>
      <td width="195">Medicine</td>
      <td width="115">Batch No</td>
      <td width="74">Expiry</td>
      <td width="70">Qty</td>
      <td width="73">Cost</td>
    </tr>
    </thead>
    <tbody>
    <tr class="table">
      <td><input type="text" id= 'Datepicker' name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" id= 'Datepicker' name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
    </tr>
   <tr class="table_odd">
      <td><input type="text" id='Datepicker' name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" id= 'Datepicker' name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
      <td><input type="text" name="<?php echo $_SESSION['count'] . '_' . $row_count; $row_count++;?>"></td>
    </tr>
    </tbody>
</table>
<table width="1462" border="0" cellspacing="0" cellpadding="20">
  <tbody>
  </tbody>
</table>

<input type="submit" name="submit" value="Confirm" >
</form>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
<script type="text/javascript">
$(function() {
	$( "#Datepicker" ).datepicker({ changeMonth: true, changeYear: true, showOtherMonths: true, selectOtherMonths: true}); 
});


</script>
</body>
</html>