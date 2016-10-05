<!DOCTYPE html>
<title>View Cart</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	 <h1>Elder Wood Bookstore </h1>
	 <div class="centered">
		<a href = "BookMain.php">BookStoreHome</a>
		<a href = "Browse.php">Browse The Catalogue</a>
		<!-- change the check orders to view orders--->
		<a href = "search.php">Search The Catalogue</a>
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
	<?php
	session_start();
	if($_SESSION['cSize'] < 1)
	{
		echo'<p style ="color:red;text-align:center">Your Cart Is Empty!</p>';
		echo"<!---";
	}
	
	?>
	<form method="POST" action="getCart.php">
	<table border="1">
	<caption><h3>Category</h3></caption>
	<thead>
		<tr>
		<th>ID</th>
		<th>Title</th>
		<th>Author</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Number Wanted</th>
		</tr>
	</thead>
	<tbody>
<?php
session_start();
//echo "<p>Index in Session ".$_SESSION['cSize']." </p>";
$useSize=$_SESSION['cSize'];
//testing if it is in the SESSION
for ($i=0;$i<$useSize;$i++){
	echo  "<tr>
					<td>" .$_SESSION['cart'][$i]["pID"]. "<input type = 'hidden' name='ID[]' id='pID' value ='".$_SESSION['cart'][$i]['pID']."'></td>
					<td>" . $_SESSION['cart'][$i]["pTitle"] ."<input type = 'hidden' name='title[]'' id='pTitle' value ='".$_SESSION['cart'][$i]['pTitle']."'></td>
					<td>" . $_SESSION['cart'][$i]['pAuthor'] ."<input type = 'hidden' name='author[]' id='pAuthor' value ='".$_SESSION['cart'][$i]['pAuthor']."'></td>
					<td>" . $_SESSION['cart'][$i]['pQuantity'] ."<input type = 'hidden' name='quantity[]' id='pQuantity' value ='".$_SESSION['cart'][$i]['pQuantity']."'></td>
					<td>$" . $_SESSION['cart'][$i]['pPrice'] ."<input type = 'hidden' name='price[]' id='pPrice' value ='".$_SESSION['cart'][$i]['pPrice']."'></td>
					<td><input type = 'text' name='cQuantity[]' id='custQant' size= '2' value ='".$_SESSION['cart'][$i]['custQuantity']."'></td> 
				</tr>";
}  

echo"
</tbody>
</table>
<input type = 'hidden' name='numRow'  value = '".$_SESSION['cSize']."'  />
<input type = 'hidden' name='reset'  value = 'true'  />";
?>
<input type="submit" value="Edit" />
</form>
<?php
session_start();
	if( $_SESSION['logIn'] <> true)
	{
		echo"<!---";
	}
?>
<form method="POST" action="checkOut.php">

<input type="submit" value="Check Out">
</form>
<?php
session_start();
	if($_SESSION['cSize'] < 1 || $_SESSION['logIn'] <> true)
	{
		echo"--->";
	}
?>
</body>
</html>
