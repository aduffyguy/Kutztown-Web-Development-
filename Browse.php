<!DOCTYPE html>

<?php
	/*
	Browse.php
	By: Alan Duffy-Guy
	Last Modified: 18-Nov-2015
	This script allows the user to click any category in the database and serch for all
	products that share that data type.
	*/
error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');

// Initialize connection parameters and connect with the database
$connection = db_connect();

$query = "SELECT CategoryID, CategoryName FROM Categories;" ;				// define query
$res = mysql_query($query) ;				// run query and receive its results in $res
$numR = mysql_numrows($res) ;				// $numR has the number that shows how many rows are returned in $res

print "<html>" ;
print'<head><title>Browse Categories</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	 <h1>Elder Wood Bookstore </h1>
	</head>
	<body>
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
	<div class="centered">';
// Display each row one by one as a hyperlink
for ($i=0; $i<$numR; $i++)
{ $cno = mysql_result($res, $i, "CategoryID") ;
  $cname = mysql_result($res, $i, "CategoryName") ;
  print "<a href='dispBrowse.php?x=$cno'> $cname </a><br />" ;
}  

print "</div>
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