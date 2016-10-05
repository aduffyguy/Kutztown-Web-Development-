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

error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');

// Initialize connection parameters and connect with the database
$connection = db_connect();
$cID = 4;

$query = "SELECT OrderID, OrderDate, ShippingCost, Tax, Total FROM Orders;" ;				// define query

$res = mysql_query($query) ;				// run query and receive its results in $res

$numR = mysql_numrows($res) ;				// $numR has the number that shows how many rows are returned in $res

print '<html>
	<head><title>Browse Orders</title>
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
	 <hr>
	<div class="centered">
	<table>
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
  $dTax = mysql_result($res, $i, "Tax");
  $dTotal = mysql_result($res,$i, "Total");
  $dODate = mysql_result($res,$i, "OrderDate");
  
  print "<tr>
  <td><a href='dispOrderDet.php?oNum=$dID'> $dID </a></td>
  <td> $dShipCost</td>
  <td> $dTax</td>
  <td> $dTotal</td>
  <td> $dODate</td>" ;
}  

print '</tbody>
</table>
<form action="dispOrderDet.php" method="get"  onsubmit ="return checkNum()">
			
			<p><label>Serch:
				<input name = "oNum" id = "oNum" type = "text" size = "25" />
				</label>
			<input type = "submit"  value = "Submit"  />
				
			
		</form> </td>
</div>
</body>
 <script type = "text/javascript">
	  <!--
		//reates an account
			function checkNum(){
				//stops form from ouputing if it is true
				var formStop =false
				//checks if a required input is not entered
				var required = true;
	
				//Getting the zip code
				var orderNum = document.getElementById("oNum").value;
				required = checkRequired(orderNum);
				if (!required){
					window.alert("You must enter a value for your Order Number.");
					formStop = true;
				}
				else if(isNaN(orderNum)){
					window.alert("You must enter a numerical value for your Order Number.");
					formStop = true;
				}
				
				//everything is correct 
				if(!formStop){
				return true;
				
				}
				else
				{
				return false;
				}
				
			}
			
			
			//must not be converted to a numeric value before doing this test
			//takes in a sting and returns a boolean determining if it is empty or null
			function checkRequired(theString){
				//an empty string evaluates to false in a boolean context
				
				if (!theString || theString === null){
					return false;
				}
				else {
				return true;
				}
			}
			
			
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