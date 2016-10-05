<?php
//number of products from list
$cartReset= $_POST['reset'];
//echo"this is cart reset $cartReset";
if($cartReset == true)
{
	//echo"IT IS GETTING HERE";
	$customerID = $_SESSION["customerID"];
	session_unset();
	session_destroy();
	session_start();
	$_SESSION["logedIn"] = true;
	$_SESSION["customerID"]= $customerID;
	$_SESSION["cart"]=null;
	$_SESSION["cSize"]=0;
}
$numR = $_POST['numRow'];
//gets values in arrays from the list
$pID = $_POST['ID'];
$pTitle = $_POST['title'];
$pAuthor = $_POST['author'];
$pQuantity = $_POST['quantity'];
$pPrice = $_POST['price'];
$cQuantity= $_POST['cQuantity'];
print "this is the number of rows $numR";
session_start();
if ($_SESSION['cSize'] < 1)
{
	$_SESSION['cSize']=0;
}
//echo "<p>Size of cart: ".$_SESSION['cSize']."</p>";
// size of the cart
//this -1 is the highest index
$customerSize = $_SESSION['cSize'];
for ($i =0; $i<$numR;$i++){
	if ($cQuantity[$i] > 0 ){
		//if the customer array size is less than one it means the cart is empty
		if($customerSize < 1){
			
		//used for testing
			print"<p>THIS IS THE FIRST ITEM IN THE ARRAY</p>
			<p>$pID[$i] &nbsp
			$pTitle[$i] &nbsp
			$pAuthor[$i] &nbsp
			$pQuantity[$i] &nbsp
			$pPrice[$i] &nbsp
			$cQuantity[$i]</p>
			<p>Index for the row ". $customerSize . " </p> ";
		//puts an array of assocuative arrays into session
			$_SESSION['cart'][$customerSize] = array("pID"=>$pID[$i],"pTitle" =>$pTitle[$i],"pAuthor"=>$pAuthor[$i],"pQuantity"=>$pQuantity[$i],"pPrice"=>$pPrice[$i],"custQuantity"=>$cQuantity[$i]);
			$customerSize=$customerSize+1;
			//echo"<p>Index after increment".$customerSize."";
		}
		//if the cart array is not empty
		else{
		//check if the entry is already in the array
			//echo"<p>This is the row number: ".$i."</p>
						//<p>This is the id of the item: $pID[$i]</p>";
			$searchRes = searchCart($pID[$i]);
			//if it is not then add this entry to the cart array
			if($searchRes === -1){
				/*echo"<p>not in the array</p>
				<p>searhRes value: ".$searchRes."</p>
				<p>This is Product id: $pID[$i] </p>";
				//used for testing
				print"<p>THIS IS THE FIRST ITEM IN THE ARRAY</p>
				<p>$pID[$i] &nbsp
				$pTitle[$i] &nbsp
				$pAuthor[$i] &nbsp
				$pQuantity[$i] &nbsp
				$pPrice[$i] &nbsp
				$cQuantity[$i]</p>
				<p>Index for the row ". $customerSize . " </p> ";*/
				//puts an array of assocuative arrays into session
				$_SESSION['cart'][$customerSize] = array("pID"=>$pID[$i],"pTitle" =>$pTitle[$i],"pAuthor"=>$pAuthor[$i],"pQuantity"=>$pQuantity[$i],"pPrice"=>$pPrice[$i],"custQuantity"=>$cQuantity[$i]);
				$customerSize=$customerSize+1;
				//echo"<p>Index after increment".$customerSize."";
			}
			//if there is an error in the processs lest the customer know
			else if($searchRes === null ){
				echo"<p>there is an error</p>
				<p>searhRes value: ".$searchRes."</p>
				<p>This is Product id: $pID[$i] </p>";
			}
			//if there is a duplicate order just add the quantity the customer wants to the array
			else{
				echo"<p>It is a duplaciate in the array!</p>
						<p>SEarch Res value: ".$searchRes."
						<p>This is Product id: $pID[$i] </p></p>";
				//changes the value to the value customer wanted
				$_SESSION['cart'][$i]["custQuantity"] = $cQuantity[$i];
			}
			
		}
		
	}
}
$_SESSION['cSize']=$customerSize;

header("location: cartView.php?");
	exit;
/*echo "<p>Index in Session ".$_SESSION['cSize']." </p>";
$useSize=$_SESSION['cSize'];
//testing if it is in the SESSION
for ($i=0;$i<$useSize;$i++){
	echo "<p>Index in cart: ".$i."</p>
			<p>ID: " .$_SESSION['cart'][$i]["pID"]. "</p>
			<p>Title: " . $_SESSION['cart'][$i]["pTitle"] ."</p>
			<p>author:" . $_SESSION['cart'][$i]['pAuthor'] ."</p>
			<p>Quantity:" . $_SESSION['cart'][$i]['pQuantity'] ."</p>
			<p>Price: " . $_SESSION['cart'][$i]['pPrice'] ."</p>
			<p>custumer requested quantity:" . $_SESSION['cart'][$i]['custQuantity'] ."</p>";
}
//resets this so that I can test it with new data
/*
session_unset();
session_destroy();
*/
function searchCart ($productID)
{
	echo "the product id given to function:$productID";
	session_start();
	foreach ($_SESSION['cart'] as $key => $value) {
    if ($value['pID'] === $productID){
			echo "Key: $key; Value: $value<br />\n";
			echo "value found".$value['pID']."<br>";
			return $key;
		}
	}
			return -1;
}

?>