<?php 
/*
SignUpPass.php
	By alan Duffy-Guy
	Last Modified: 18-Nov-2015
	This script passes the data from the signup page and sends it to the customers table in the database
*/
	error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');

// Initialize connection parameters and connect with the database
$connection = db_connect();
//get the data from the form
$afName = $_GET['Fname'];
$alName = $_GET['Lname']; 
$aEmail = $_GET['EmailAd'];
$aPword = $_GET['Pword'];
$aSAddress = $_GET['SAddress'];
$aSATwo = $_GET['SATwo'];
$aCity = $_GET['City'];
$aState = $_GET['State'];
$aZCode = $_GET['ZCode'];
$aPNum = $_GET['PNum'];



$query="INSERT INTO Customers VALUES ('','$aEmail', '$aPword', '$afName', '$alName','$aSAddress', '$aSATwo','$aZCode', '$aState', '$aPNum', '$aCity');";
//showsc output
print $query;
//
mysql_query($query) or die("Error reading from EMP: " . mysql_error( ) );
//@mysql_close($connection);




	
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