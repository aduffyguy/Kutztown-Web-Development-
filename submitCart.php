<?php
echo"works?!";
error_reporting(E_ERROR | E_PARSE | E_NOTICE);
ini_set('display_errors', '1');

$connection = db_connect();

session_start();
$date = date('Y-m-d H:i:s');
$customerID = $_SESSION["customerID"];
$numSum = $_POST['numSum'];
$salesTax = $_POST['salesTax']; 
$shipHandlePrice = $_POST['shipHandlePrice'];
$totalPrice = $_POST['totalPrice'];

echo"$date &nbsp $customerID &nbsp $numSum &nbsp $salesTax &nbsp $shipHandlePrice &nbsp $totalPrice";
//making a new order
$query="INSERT INTO Orders (CustomerID) VALUES ($customerID);";
$result =mysql_query($query) or die("Error reading from Bookstore: " . mysql_error( ) );

//getting the order id
$cQuery="SELECT OrderID FROM Orders WHERE CustomerID = $customerID AND OrderDate IS NULL;";
$cResult =mysql_query($cQuery) or die("Error reading from Bookstore: " . mysql_error( ) );
$pOrderId = mysql_result($cResult, 0,'OrderID');
echo"The Order Id = $pOrderId";

//putting the order information in
$pQuery = "UPDATE Orders SET ShippingCost=$shipHandlePrice, Tax=$salesTax, Total=$totalPrice, OrderDate='$date' WHERE OrderID=$pOrderId AND CustomerID = $customerID;";
$pResult =mysql_query($pQuery) or die("Error reading from Bookstore: " . mysql_error( ) );

//putting the ordre details information in
$useSize=$_SESSION['cSize'];

//if($useSize > 1){
	/*
	$i=0;
	
	$pID = $_SESSION['cart'][$i]["pID"];
	$pQuantity = $_SESSION['cart'][$i]['pQuantity'];
	$pPrice = $_SESSION['cart'][$i]['pPrice'];
	$eQuery ="INSERT INTO OrderDetails (OrderID, ProductID, Quantity, LineTotal)VALUES ($pOrderId, ,'$pID', $pQuantity, $pPrice,)";	
	*/
	
	for ($i=0;$i<$useSize;$i++){
		$pID = $_SESSION['cart'][$i]["pID"];
		$pQuantity = $_SESSION['cart'][$i]['custQuantity'];
		$pPrice = $_SESSION['cart'][$i]['pPrice'];
		
		
		echo "<p>Index in cart: ".$i."</p>
				<p>ID: " .$_SESSION['cart'][$i]["pID"]. "</p>
				<p>Title: " . $_SESSION['cart'][$i]["pTitle"] ."</p>
				<p>author:" . $_SESSION['cart'][$i]['pAuthor'] ."</p>
				<p>Quantity:" . $_SESSION['cart'][$i]['pQuantity'] ."</p>
				<p>Price: " . $_SESSION['cart'][$i]['pPrice'] ."</p>
				<p>custumer requested quantity:" . $_SESSION['cart'][$i]['custQuantity'] ."</p>";
	//make a new variable to put the query into
	${"eQuery$i"} ="INSERT INTO OrderDetails (OrderID, ProductID, Quantity, LineTotal) VALUES ($pOrderId,'$pID', $pQuantity, $pPrice)";
	$eResult =mysql_query(${"eQuery$i"}) or die("Error reading from Bookstore: " . mysql_error( ) );
	echo"".${"eQuery$i"}."";
	}
//}
/*else{
	$pID = $_SESSION['cart'][0]["pID"];
	$pQuantity = $_SESSION['cart'][0]['pQuantity'];
	$pPrice = $_SESSION['cart'][0]['pPrice'];
	$eQuery ="INSERT INTO OrderDetails (OrderID, ProductID, Quantity, LineTotal)VALUES ($pOrderId, ,'$pID', $pQuantity, $pPrice,);";	
}
*/

//$eResult =mysql_query($eQuery) or die("Error reading from Bookstore: " . mysql_error( ) );

	
db_close();
session_unset();
session_destroy();
session_start();
$_SESSION["logedIn"] = true;
$_SESSION["customerID"]= $customerID;

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