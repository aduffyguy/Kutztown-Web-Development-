<!DOCTYPE html>

<?php  
/*	dispSearchISBN.php
	By: Alan Duffy-Guy
	Last Modified: 18-Nov-2015
	This script shows the user the books that match the ISBN entered in search.php
*/

error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');
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
	print'<Head><title>Browse Categories</title>
		  <meta charset="utf-8">
			<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
		 <h1>Elder Wood Bookstore </h1>
		 <div class="centered">
			<a href = "BookMain.php">BookStoreHome</a>
		<a href = "Browse.php">Browse The Catalogue</a>
		<a href = "orders.php">Check Orders</a>
		<a href = "search.php">Search The Catalogue</a>
		<a href = "SignUp.php">Sign Up</a>
		<a href = "LoginPage.php">Sign In</a>
		<a href = "ContactUs.php">Contact Us</a>
		 </div>
		 <hr></hr>
		</head>
		<body>
		<div class="centered">';

	// Display each row one by one
	if ($numR >0){
		for ($i=0; $i<$numR; $i++)
		{ $Pid = mysql_result($res, $i, "ProductID") ;
			$PTitle = mysql_result($res, $i, "Title") ;
			$PAuthor1 = mysql_result($res, $i, "Author1");
			$PAuthor2 = mysql_result($res, $i, "Author2");
			$PAuthor3 = mysql_result($res, $i, "Author3");
			$PQuantity = mysql_result($res, $i, "Quantity");
			$PPrice = mysql_result($res, $i, "Price");
			$PCategoryID = mysql_result($res, $i,"CategoryID");

		//if ($PAuthor2 == Null && $Author3 ==Null)
	  print "ID: $Pid Title: $PTitle  Author: $PAuthor1  Quantity: $PQuantity Price: $PPrice CategoryID: $PCategoryID <br>" ;
		}
	} 
	else{
		$Pid = mysql_result($res, 0, "ProductID") ;
		$PTitle = mysql_result($res, 0, "Title") ;
		$PAuthor1 = mysql_result($res, 0, "Author1");
		$PAuthor2 = mysql_result($res, 0, "Author2");
		$PAuthor3 = mysql_result($res, 0, "Author3");
		$PQuantity = mysql_result($res, 0, "Quantity");
		$PPrice = mysql_result($res, 0, "Price");
		$PCategoryID = mysql_result($res, 0,"CategoryID");

		//if ($PAuthor2 == Null && $Author3 ==Null)
	  print "ID: $Pid Title: $PTitle  Author: $PAuthor1  Quantity: $PQuantity Price: $PPrice CategoryID: $PCategoryID <br>" ;
	}
	print "</div>
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