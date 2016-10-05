<!DOCTYPE html>

<?php
/*	
	orders.php
	By: Alan Duffy-Guy
	Last Modified: 18-Nov-2015
	This script shows the user the orders 
	Errors Checked:1.not entering a value for the Serch Box
					2.entering a non numerical value for the Order Number
*/
/*
error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');
*/
// Initialize connection parameters and connect with the database
$connection = db_connect();
session_start();
$customerID = $_SESSION["customerID"];

$query = "SELECT OrderID, OrderDate, ShippingCost, Tax, Total FROM Orders WHERE CustomerID = $customerID;" ;				// define query

$res = mysql_query($query) ;				// run query and receive its results in $res

$numR = mysql_numrows($res) ;				// $numR has the number that shows how many rows are returned in $res

print '<html>
	<head><title>Browse Orders</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	 <h1>Elder Wood Bookstore </h1>
	 <div class="centered">
		<a href = "BookMain.php">BookStoreHome</a>
		<a href = "Browse.php">Browse The Catalogue</a>
		<!-- change the check orders to view orders--->
		<a href = "search.php">Search The Catalogue</a>
		<a href = "cartView.php">View YourCart</a>';
		//checks if logged in to give user ability to logout or create a new account and log in
		if ($_SESSION["logedIn"] == true){
			echo'<a href = "orders.php"> View Orders</a>
					<a href = "logOutPage.php">Logout</a>';
		}
		else{
			echo '<a href = "SignUp.php">Sign Up</a>
				<a href = "LoginPage.php">Log In</a>';
		}
		echo'
		<a href = "ContactUs.php">Contact Us</a>
	 </div>
	 <hr></hr>
	<div class="centered">
	<table border="1">
	<thead>';
//if not found output this 
	if (isset($_GET["msg"]) && $_GET["msg"] == 1)
	{
		echo '<p style="color:red"> Order Number Not Found.</p>';
	}
	
print '
		<caption><h3>Orders</h3></caption>
		<tr>
		<th>OrderID</th>
		<th>ShippingCost</th>
		<th>Tax</th>
		<th>Total</th>
		<th>OrderDate</th>
		</tr>
	</thead>
	<tbody>';
	
// Display each row one by one as a hyperlink
for ($i=0; $i<$numR; $i++)
{ $dID = mysql_result($res, $i, "OrderID") ;
  $dShipCost = mysql_result($res, $i, "ShippingCost");
	$dShipCost = number_format((float)$dShipCost, 2, '.', '');
  $dTax = mysql_result($res, $i, "Tax");
	$dTax = number_format((float)$dTax, 2, '.', '');
  $dTotal = mysql_result($res,$i, "Total");
	$dTotal = number_format((float)$dTotal, 2, '.', '');
  $dODate = mysql_result($res,$i, "OrderDate");
  
  print "<tr>
  <td><a href='dispOrderDet.php?oNum=$dID'> $dID </a></td>
  <td>$". $dShipCost."</td>
  <td>$". $dTax."</td>
  <td>$". $dTotal."</td>
  <td> $dODate</td>" ;
}  

print '</tbody>
</div>
</body>
 <script type = "text/javascript">
	  <!--
		-->
	  </script>
</html>' ;


db_close($connection);

		function db_connect()
{
	$DB_NAME = "aduff463_bookstore";
	$DB_HOST = "localhost";
	$DB_USER = "aduff463";
	$DB_PASS = "sp5dRUCr";
	global $connection;
	$connection = mysql_connect($DB_HOST, $DB_USER, $DB_PASS)or die("Cannot connect to $DB_HOST as $DB_USER:" . mysql_error());
	mysql_select_db($DB_NAME) or die ("Cannot open $DB_NAME:" . mysql_error());
	return $connection;
	
}

function db_close()
{
	global $connection;
	mysql_close($connection);
}

?>