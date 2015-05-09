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
include('lib/configure.php');
if(isset($_SESSION['login_type'])){
	if ($_SESSION['login_type']!="admin")
	 {
		header("location: ../doctor_home.php");
	}
}
else {
	header("location: ../index.php");
}
$min_qty = 10;
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="images/cross.png" type="image/gif" sizes="16x16"> 
<title><?php echo $_SESSION['login_type']; ?> Home Page</title>
<link href="css/admin_home.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="button_table">
<table width="250" border="0" cellspacing="4" cellpadding="0">
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
<input type="button" class="issue_med" value="Issue Medicine" onClick="location.href='features/issue_med.php'">

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
      <td><input type="button" class="button" value="Add Doctor" onClick="location.href='features/add_doctor.php'"></td>
    </tr>
    <tr>
      <td><input type="button" class="button" value="Add Lab Admin" onClick="location.href='features/add_lab_admin.php'"></td>
    </tr>
  </tbody>
</table>
</div>
<input type="button" class="logout" value="logout" onClick="location.href='lib/logout.php'">

<div class="marquee">  

<?php
	$pcount=0;
	$scroll_text = "";
// Alert code. Expiry Alert
	
	$curr_date = date("Y/m/d");
	$check_date = date("Y/m/d", strtotime("+30 days"));
	$result = mysqli_query($conn, "SELECT * from medicine_stock WHERE (Expiry < '$check_date')");
	while($row = mysqli_fetch_array($result))
	{
		$med_name= $row['MedicineName'];
		$exp = date("Y/m/d",strtotime($row['Expiry']));
		$pcount=$pcount+1;
		$scroll_text = $scroll_text."<a href='features/remove_stock.php?q=$med_name' style='text-decoration: none;color:red;'>Expiry alert : ".$row['MedicineName']." ".$row['BatchNo']." ".date("d/m/Y",strtotime($row['Expiry']))."</a>&nbsp; | &nbsp; ";
	}
	
// Out of Stock Alert
	$rslt = mysqli_query($conn, "SELECT DISTINCT MedicineName FROM medicine_stock;");
	while($med = mysqli_fetch_array($rslt))
	{
		$med_name = $med['MedicineName'];
		$quantity_rslt = mysqli_query($conn, "SELECT SUM(Qty) AS quantity FROM medicine_stock WHERE (MedicineName = '$med_name');");
		$qty_row = mysqli_fetch_array($quantity_rslt);
		$qty = $qty_row['quantity'];
		if ($qty < $min_qty)
		{
			$scroll_text = $scroll_text."<a href='features/view_stock.php?q=$med_name' style='text-decoration: none;color:red;'>Out of Stock : ".$med_name." - ".$qty." left </a>&nbsp; |&nbsp; ";
			$pcount=$pcount+1;
		}
	}
	$pcount=$pcount*6;
	//echo "<p style=\"animation: left-one ".$pcount."s linear infinite;\">".$scroll_text."</p>";
?>
	<marquee onmouseover="this.setAttribute('scrollamount', 0, 0);this.stop();" onmouseout="this.setAttribute('scrollamount', 6, 0);this.start();"><a href="features/view_stock" style="text-decoration: none"><font color="#850303" face="times"><?php echo $scroll_text; ?></font></a></marquee>
</div>
</body>
</html>	
