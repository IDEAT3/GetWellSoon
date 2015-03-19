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
	if (date("M")>=4)
	{
		$curr_year = date("Y");
	}
	else 
	{
		$curr_year = date("Y")-1;
	}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Yearly Report</title>

<!--CSS-->
<link href="../css/yearly_report.css" rel="stylesheet" type="text/css"> 

<!--JavaScript-->
<script>
	function validate()
	{
		element = document.getElementById("input_year");
		if ((element.value < '2011') || (element.value >= <?php echo date("Y") ;?>))
		{
				window.alert("Invalid Year !!!");
				element.value="<?php echo $curr_year; ?>";
		}
	}
</script>

</head>

</head>

<body>
	<input type="button" class="home" value="" onClick="location.href='../home.php'">
	<input type="button" class="logout" value="logout" onClick="location.href='../lib/logout.php'">
	<div id="table1">
	Yearly Report :-
	<form action="" method="post" id="year">
		<input id="input_year" type=text name="year" value=<?php if (!isset($_POST['year'])) echo $curr_year; else echo $_POST['year']; ?> size="4"/>
		<input type=submit value="Go" style="color:white;background-color:#4AaA00;" size="5" onclick="validate()">
	</form>
	<a id="pdf_link" href="generate_pdf.php" target="_blank">Print</a>
	</div>

<?php
	$result = mysqli_query($conn, "SELECT * From Yearly_Report");
	while (	$row = mysqli_fetch_array($result) ) 
	{
		$prev_year = $row['Year'];
		if ($row['Year'] == $_POST['year'])
		{
			$opbal = $row['OpeningBal'];
			$pur = $row['Purchase'];
			$consumption = $row['Consumption'];
			$clbal = $row['ClosingBal'];
			$found = true;
			break;
		}
	}
	
	if (! $found) //If the values are not in the database, calculate till date and store in the database
	{

			$yr = $prev_year + 1;
			while ($yr <= $curr_year)
			{
				
				$p_yr = $yr-1;
				$result = mysqli_query($conn, "SELECT * From Yearly_Report WHERE (Year = '$p_yr');");
				$row = mysqli_fetch_array($result);
				$opbal = $row['ClosingBal'];
				$from = $p_yr."/04/01";
				$to = $yr."/03/31";
				$result = mysqli_query($conn, "SELECT SUM(Cost) AS Total from Transactions WHERE ((Transaction_Date >= '$from') AND (Transaction_Date <= '$to') AND (Type='Addition'));");
				$row = mysqli_fetch_array($result);
				$pur = $row['Total'];
				$result = mysqli_query($conn, "SELECT SUM(Cost) AS Total from Transactions WHERE ((Transaction_Date >= '$from') AND (Transaction_Date <= '$to') AND (Type='Removal'));");
				$row = mysqli_fetch_array($result);
				$consumption = $row['Total'];
				$clbal = $op+$pur-$consumption;

				$result = mysqli_query($conn, "INSERT INTO Yearly_Report VALUES ('{$yr}','{$opbal}','{$pur}','{$consumption}','{$clbal}');");		
				
				$yr = $yr + 1;
			}
			$result = mysqli_query($conn, "SELECT * From Yearly_Report");
			while (	$row = mysqli_fetch_array($result) ) 
			{
				if ($row['Year'] == $_POST['year'])
				{
					$opbal = $row['OpeningBal'];
					$pur = $row['Purchase'];
					$consumption = $row['Consumption'];
					$clbal = $row['ClosingBal'];
					break;
				}
			}
	}

?>	
	
	
	
	<div id="stmt">
		<h1>Statement as on <span id="close_date" style="color:white">31-03-<?php if(!isset($_POST['year'])) echo $curr_year; else echo $_POST['year']; ?></span></h1> 
		<table id="report_table">
			<tr>
				<td>Opening Balance </td>
				<td>Rs. <?php echo $opbal; ?> </td>
			</tr>
			<tr> 
				<td>Total Purchase </td>
				<td>Rs. <?php echo $pur; ?> </td>
			</tr>
			<tr>
				<td>Consumption </td>
				<td>Rs. <?php echo $consumption; ?></td>
			</tr>
			<tr>
				<td>Closing Balance </td>
				<td>Rs. <?php echo $clbal; ?> </td>
			</tr>
		</table>
	</div>
	<?php
		$_SESSION['year']=$_POST['year'];
		$_SESSION['opbal']=$opbal;
		$_SESSION['pur']=$pur;
		$_SESSION['consumption']=$consumption;
		$_SESSION['clbal']=$clbal;		
	?>
</body>
</html>
