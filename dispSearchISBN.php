<!DOCTYPE html>

<?php  
/*	dispSearchISBN.php
	By: Alan Duffy-Guy
	Last Modified: 18-Nov-2015
	This script shows the user the books that match the ISBN entered in search.php
*/
/*
error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');
*/
// Initialize connection parameters and connect with the database

$connection = db_connect();


$dISBN = $_GET["ISBN"];
$query = "SELECT * FROM Products WHERE ProductID = '$dISBN';";				// define query;
$res = mysql_query($query) ;				// run query and receive its results in $res

$numR = mysql_numrows($res) ;				// $numR has the number that shows how many rows are returned in $res
if ($numR < 1)
{
	
	header("location:  search.php?msg=1");
	exit;
}
else
{
	print "<html>" ;
print'<head><title>Browse Categories</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
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
	</head>
	<body>
	<form method="POST" action="getCart.php">
	<table border="1">
	<caption><h3>Results for '.$dISBN.' </h3></caption>
	<thead>
		<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Author</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>CategoryID</th>
		<th>Number Wanted</th>
		</tr>
	</thead>
	<tbody>';


// Display each row one by one
$numR = mysql_numrows($res) ;				// $numR has the number that shows how many rows are returned in $res
if ($numR < 1)
{
	
	header("location:  search.php?msg=2");
	exit;
}
for ($i=0; $i<$numR; $i++)
{ $Pid = mysql_result($res, $i, "ProductID") ;
  $PTitle = mysql_result($res, $i, "Title") ;
  $PAuthor1 = mysql_result($res, $i, "Author1");
  $PAuthor2 = mysql_result($res, $i, "Author2");
	$PAuthor3 = mysql_result($res, $i, "Author3");
	$PQuantity = mysql_result($res, $i, "Quantity");
	$PPrice = mysql_result($res, $i, "Price");
	$PCategoryID = mysql_result($res, $i,"CategoryID");
	$PPrice = number_format((float)$PPrice, 2, '.', '');

	//if ($PAuthor2 == Null && $Author3 ==Null)
  print "<tr>
					<td>$Pid<input type = 'hidden' name='ID[]'  value = '$Pid'/></td>
					<td>$PTitle<input type = 'hidden' name='title[]'  value = '$PTitle'/></td>
					<td>$PAuthor1<input type = 'hidden' name='author[]'  value = '$PAuthor1'/></td>
					<td>$PQuantity<input type = 'hidden' name='quantity[]'  value = '$PQuantity'/></td>
					<td>$".$PPrice."<input type = 'hidden' name='price[]'  value = '$PPrice'/></td>
					<td>$PCategoryID</td>
					<td><input type = 'text' name='cQuantity[]' id='custQant' size= '2' /></td> 
				</tr>";
}  
 print "</tbody>
</table>
<input type = 'hidden' name='numRow'  value = '$numR'  />
<input type = 'submit'  value = 'Submit'  />
</form>
</body>
</html>" ;

}

db_close();

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