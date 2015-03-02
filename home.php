<?php
include('session.php');
if($login_type=='doctor') {
	header("location:doctor_home.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $login_session; ?> Home Page</title>
<link href="css/admin_home.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="button_table">
<table width="250" height "800" border="0" cellspacing="6" cellpadding="0">
  <tbody>
    <tr>
      <td>Medicine</td>
      <td>Patient</td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Add to Stock" onClick="location.href='features/add_stock.php'"></td>
      <td><input type="button" class="button" value="Add Record" onClick="location.href='features/add_patient.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Remove from Stock" onClick="location.href='features/remove_stock.php'"></td>
      <td><input type="button" class="button" value="Modify Record" onClick="location.href='features/modify_patient.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="View Stock" onClick="location.href='features/view_stock.php'"></td>
      <td><input type="button" class="button" value="View Record" onClick="location.href='features/view_record.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Report" onClick="location.href='features/report.php'"></td>
      <td><input type="button" class="button" value="Delete Record" onClick="location.href='features/delete_record'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Yearly Report" onClick="location.href='features/yearly_report.php'"></td>
    </tr>
  </tbody>
</table>
</div>
<input type="button" class="issue_med" value="Issue Medicine" onClick="location.href='features/issue_medicine.php'">

<div id="profile_settings">
<table width="150" height "500" border="0" cellpadding="0">
  <tbody>
    <tr>
      <td><input type="button" class="update_prof" value="Update Profile" onClick="location.href='#'"></td>
    </tr>
    <tr>
      <td>Edit Details</td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Timings" onClick="location.href=#"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Contacts" onClick="location.href=#"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Doctors" onClick="location.href=#"></td>
    </tr>
  </tbody>
</table>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='logout.php'">
<!---<div id="error_log" >
<textarea cols="1110" rows="10"></textarea></div>-->
</body>
</html>