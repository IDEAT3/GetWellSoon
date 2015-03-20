<!-- 
 * File name: home.php
 * This page is the home page of the admin.
 * Provides many features like
 *    i. Stock.
 *		 1. Adding medicine to stock.
 *		 2. Removing medicine to stock.
 *		 3. Viewing current stock.
 *		 4. Generating report on the transactions made during a period of time.
 *       5. Generating yearly report as a document that gives the total expenditure of the last business year.
 *    ii. Patient.
 *		 1. Adding a patient to the record on his first visit to the health centre.
 * 		 2. Modifying a patient's details if necessary who is already present in the database.
 *		 3. Viewing the record of a patient who is already present in the database.
 *		 4. Delete the record of patient(s) who are not eligible to visit the health centre anymore.
 *		 5. Issuing medical certificate to those who apply for it.
 *		 6. Issuing medicine to patients.
 *	  iii. Profile of admin
 *		 1. Update admin's profile.
 *		 2. Update the doctors and create accounts for doctors who joins the health centre.	 
-->

<?php
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

<!DOCTYPE html>
<html>
<head>
<title><?php echo $_SESSION['login_user']; ?> Home Page</title>
<link href="css/admin_home.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="button_table">
<table width="250" height "800" border="0" cellspacing="4" cellpadding="0">
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
      <td><input type="button" class="button" value="View Record" onClick="location.href='features/view_patient_record.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Report" onClick="location.href='features/report.php'"></td>
      <td><input type="button" class="button" value="Delete Record" onClick="location.href='features/delete_record.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Yearly Report" onClick="location.href='features/yearly_report.php'"></td>
	  <td><input type="button" class="button" value="Issue Med. Cft" onClick="location.href='features/issue_medical_certificate.php'"></td>
    </tr>
	<tr>
      <td></td>
	  <td><input type="button" class="button" value="View Med. Cft" onClick="location.href='features/view_medical_certificate.php'"></td>
    </tr>
  </tbody>
</table>
</div>
<input type="button" class="issue_med" value="Issue Medicine" onClick="location.href='features/issue_medicine.php'">

<div id="profile_settings">
<table width="150" height "500" border="0" cellpadding="0" cellspacing="6">
  <tbody>
	<tr>
		<td>Edit Details</td>
	</tr>
    <tr>
      <td><input type="button" class="button" value="Update Profile" onClick="location.href='features/update_profile_admin.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Doctor Profiles" onClick="location.href=#"></td>
    </tr>
  </tbody>
</table>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='lib/logout.php'">
<!---<div id="error_log" >
<textarea cols="1110" rows="10"></textarea></div>-->
</body>
</html>