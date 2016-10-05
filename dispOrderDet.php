<!DOCTYPE html>

<?php
/*
	dispOrderDet.php
	By: Alan Duffy-Guy
	Last Modified: 18-Nov-2015
	This script shows the user the details of a specific order
	Erros Checked:1.Not getting a value from the database
*/
/*
error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');
*/
// Initialize connection parameters and connect with the database
$connection = db_connect();
$oID = $_GET["oNum"];

$query = "SELECT * FROM OrderDetails WHERE OrderID = '$oID';" ;				// define query

$res = mysql_query($query) ;				// run query and receive its results in $res
//if false ends the connection and sends user to OrderPage
$nRow = mysql_numrows($res);
if( $nRow < 1)
{
	
	db_close();
	//redirect to the login page
	header("location: orders.php?msg=1");
	exit;
}
$numR = mysql_numrows($res) ;				// $numR has the number that shows how many rows are returned in $res

print "<html>" ;
print'<head><title>Browse Categories</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	</head>
	<body>
	 <h1>Elder Wood Bookstore </h1>
	 <div class="centered">
		<a href = "BookMain.php">BookStoreHome</a>
		<a href = "Browse.php">Browse The Catalogue</a>
		<!-- change the check orders to view orders--->
		<a href = "search.php">Search The Catalogue</a>
		<a href = "cartView.php">View YourCart</a>';
		session_start();
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
	 <hr></hr>
	 </div>
	<div class="centered">
	<table border="1">
	<thead>
		<caption><h3>OrderDetails</h3></caption>
		<tr>
		<th>Order ID</th>
		<th>Product ID</th>
		<th>Quantity</th>
		<th>Line Total</th>
		</tr>
	</thead>
	<tbody>';
	
// Display each row one by one as a hyperlink
for ($i=0; $i<$numR; $i++)
{ $oID = mysql_result($res, $i, "OrderID") ;
  $oPID = mysql_result($res, $i, "ProductID") ;
  $oQuantity = mysql_result($res, $i, "Quantity");
  $oLineTotal = mysql_result($res, $i, "LineTotal");
  $oLineTotal = number_format((float)$oLineTotal, 2, '.', '');
  print "<tr>
  <td>$oID</td>
  <td> $oPID</td>
  <td> $oQuantity</td>
  <td> $".$oLineTotal."</td>
  </tr>" ;
}  

print "</tbody>
</table>
</div>
</body>
</html>" ;


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