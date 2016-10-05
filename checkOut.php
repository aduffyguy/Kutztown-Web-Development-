<!DOCTYPE html>
<title>Check Out</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	 <h1>Elder Wood Bookstore </h1>
	 <div class="centered">
		<a href = "BookMain.php">BookStoreHome</a>
		<a href = "Browse.php">Browse The Catalogue</a>
		<!-- change the check orders to view orders--->
		<a href = "search.php">Search The Catalogue</a>
		<a href = "cartView.php">View YourCart</a>
		<?php
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
		?>
		<a href = "ContactUs.php">Contact Us</a>
	 <hr></hr>
	 </div>
	  <script type = "text/javascript">
	  
	  </script>

	</head>
	<body>
	<form method="POST" action="submitCart.php">
	<table border="1">
	<caption><h3>Check Out</h3></caption>
	<thead>
		<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Price</th>
		<th>Number Wanted</th>
		</tr>
	</thead>
	<tbody>
<?php
session_start();
echo "<p>Index in Session ".$_SESSION['cSize']." </p>";
$useSize=$_SESSION['cSize'];
//testing if it is in the SESSION
$numSum =0;
for ($i=0;$i<$useSize;$i++){
	echo  "<tr>
					<td>" .$_SESSION['cart'][$i]["pID"]. "</td>
					<td>" . $_SESSION['cart'][$i]["pTitle"] ."</td>
					<td>$" . $_SESSION['cart'][$i]['pPrice'] ."</td>
					<td>".$_SESSION['cart'][$i]['custQuantity']."</td> 
				</tr>";
	$numSum = $numSum + $_SESSION['cart'][$i]['pPrice'];
}  
$salesTax = $numSum*0.06;
	if($numSum < 25)
	{
		$shipHandlePrice = 4.50;
	}
	else if($numSum < 50)
	{
		$shipHandlePrice = 7.00;
	}
	else{
		$shipHandlePrice = 10.25;
	}
	
$totalPrice = $shipHandlePrice + $salesTax + $numSum;
	
echo"<tfoot>
		<tr>
			<td>Inital Cost</td>
			<td>$".$numSum."<input type = 'hidden' name='numSum'  value = '$numSum'/></td>
			<td>Tax:</td>
			<td>$".$salesTax."<input type = 'hidden' name='salesTax'  value = '$salesTax'/></td>
		</tr>
		<tr>
			<td>Shipping Cost:</td>
			<td>$".$shipHandlePrice."<input type = 'hidden' name='shipHandlePrice'  value = '$shipHandlePrice'/></td>
			<td>Final Price:</td>
			<td>$".$totalPrice."<input type = 'hidden' name='totalPrice'  value = '$totalPrice'/></td>
		</tr>
		</tfoot>";

?>
</tbody>
</table>
	<?php
	session_start();
	if($_SESSION["logedIn"] <> true)
	{
		echo'<p style ="color:red;text-align:center">You must log in to place the Order!</p>';
		echo"<!---";
	}
	
	?>
<input type="submit" value="Complete Order" />
<?php
session_start();
	if($_SESSION["logedIn"] <> true)
	{
		echo"--->";
	}
?>
</form>
</body>
</html>