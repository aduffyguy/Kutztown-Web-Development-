<?php
/*
 Name:         Alan Duffy-Guy
 Project Phase 1: Designing Web Page
 Purpose:	     Passes the data given from LoginPage.php to the data base to be checked
     URL:          http://unixweb.kutztown.edu/~aduff463/Project/Phase2/LoginPagePass.php
     Course:       CSC 242 - Fall 2015
     Due Date:     Nov. 17th, 2015
		 Errors Checked:1.putting in a password or username  that does not exist
*/
error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');

$connection = db_connect();

$cEmail = $_GET['EmailAd'];
$cPassword= $_GET['Pword'];

//querry to check if these exist
$querry = "SELECT CustomerID, Email, Passwd, FirstName FROM Customers WHERE Email = '$cEmail' AND Passwd = '$cPassword';";

$result =mysql_query($querry) or die("Error reading from Bookstore: " . mysql_error( ) );

//if false ends the connection and sends user to login page
$nRow = mysql_numrows($result);
print $nRow;
if( $nRow < 1)
{
	
	db_close();
	//redirect to the login page
	header("location: LoginPage.php?msg=1");
	exit;
}
$dPassword = mysql_result($result, 0,'Passwd');

$dEmail = mysql_result($result, 0,'Email');



if ($dEmail == $cEmail && $dPassword == $cPassword)
	{
	
	db_close();
	header("location:  BookMain.php?msg=1");
	exit;
	
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