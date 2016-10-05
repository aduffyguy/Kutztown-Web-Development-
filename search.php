
<?php
?>
<!DOCTYPE html>

<!--
     Name:         Alan Duffy-Guy
     Project Phase 1: Designing Web Page
	   Purpose:	     Displays my profile
     URL:          http://unixweb.kutztown.edu/~aduff463/Project/Phase2/LoginPage.html
     Course:       CSC 242 - Fall 2015
     Due Date:     Nov. 5, 2015
		 Errors Checked:1.Entering an empty string
										
										
-->

<html>
   <head>
      <title>Search Products</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	  <script type = "text/javascript">
	  <!--
			function checkISBN(){
				//stops form from ouputing if it is true
				var formStop =false
				//checks if a required input is not entered
				var required = true;
				//Getting ISBN
				var isbn = document.getElementById("ISBN").value;
				var correctISBN;
				required = checkRequired(isbn);
				if (!required){
					window.alert("You must enter a value for ISBN.");
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
			
			function checkKeyword(){
				//stops form from ouputing if it is true
				var formStop =false
				//checks if a required input is not entered
				var required = true;
				//Getting Keyword
				var key = document.getElementById("Kword").value;
				var correctISBN;
				required = checkRequired(key);
				if (!required){
					window.alert("You must enter a value for the Keyword.");
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
			
			
			//clears the form
			function clearForm(){
				var emptyBox ="";
				var yClear = confirm("Are you sure you want to clear all values?");
				if (yClear== true){
				window.alert("The values have been reset");
				return true;
				
				}
				else{
				window.alert("The values were not reset");
				return false;
				}
			}
		-->
	  </script>
   </head>
   <body>
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
    <div class="centered">
	<?php
	if (isset($_GET["msg"]) && $_GET["msg"] == 1)
	{
		echo '<p style="color:red">No Book Found.</p>';
	}
	else if (isset($_GET["msg"]) && $_GET["msg"] == 2)
	{
		echo '<p style="color:red">No Books Found.</p>';
	}
	?>
		</p><h2>Search Products by ISBN </p></h2>
		<form action="dispSearchISBN.php" method="get" onreset="return clearForm()" onsubmit ="return checkISBN()">
			<p><label>ISBN:
				<input name = "ISBN" id = "ISBN" type = "text" size = "25" />
				</label>
			</p>
			<p><input type = "submit"  value = "Submit"  />
				<input type = "reset"  value = "Clear" />
			</p>
		</form>
		
		</p><h2>Search Products by Keyword </p></h2>
		<form action="SearchKeyPass.php" method="get" onreset="return clearForm()" onsubmit ="return checkKeyword()">
			<p><label>Keyword:
				<input name = "Kword" id = "Kword" type = "text" size = "25" />
				</label>
			</p>
			<p><input type = "submit"  value = "Submit"  />
				<input type = "reset"  value = "Clear" />
			</p>
		</form>
		</div>
   </body>
</html>




