<!DOCTYPE html>

<!--
     Name:         Alan Duffy-Guy
     Project Phase 1: Designing Web Page
	   Purpose:	     Allows user to enter the data in the form that is required to make an account and checks it.
     URL:          http://unixweb.kutztown.edu/~aduff463/Project/Phase2/SignUp.html
     Course:       CSC 242 - Fall 2015
     Due Date:     Nov. 5, 2015
		 Error's checked:1.Entering an empty string
										 2.Entering a character that is not a number for phone number or zip code
										 3.not putting data in a required field
										 4.All required fields are filled
										 5.Allows non required fields to be ignored
-->

<html>
   <head>
      <title>             </title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	  <script type = "text/javascript">
	  <!--
		//reates an account
			function createAccount(){
				//stops form from ouputing if it is true
				var formStop =false
				//checks if a required input is not entered
				var required = true;
				
				//getting first Name
				var firstName = document.getElementById("Fname").value;
				required = checkRequired(firstName);
				if (!required){
					window.alert("You must enter a Value for First Name.");
					formStop = true;
				}
				//Getting Last Name
				var lastName = document.getElementById("Lname").value;
				required = checkRequired(lastName);
				if (!required){
					window.alert("You must enter a value for Last Name.");
					formStop = true;
				}
				
				//Getting Email
				var email = document.getElementById("EmailAd").value;
				var correctEmail;
				required = checkRequired(email);
				correctEmail = checkEmail(email);
				if (!required){
					window.alert("You must enter a value for your Email.");
					formStop = true;
				}
				else if(correctEmail){
					window.alert("You must enter an Email with am '@' and a '.' in it");
					formStop=true;
				}
				//Getting password
				var password = document.getElementById("Pword").value;
				required = checkRequired(password);
				if (!required){
					window.alert("You must enter a value for your Password.");
					formStop = true;
				}
				
				//Getting first street Address
				var address1 = document.getElementById("SAddress").value;
				required = checkRequired(address1);
				if (!required){
					window.alert("You must enter a value for your Address.");
					formStop = true;
				}
				//Getting Second street address1
				
				//Getting City
				var city = document.getElementById("City").value;
				required = checkRequired(city);
				if (!required){
					window.alert("You must enter a value for your city.");
					formStop = true;
				}
				
				//Getting the State
				var state = document.getElementById("State").value;
				required = checkRequired(state);
				if (!required){
					window.alert("You must enter a value for your state.");
					formStop = true;
				}
				
				//Getting the zip code
				var zipC = document.getElementById("ZCode").value;
				required = checkRequired(zipC);
				if (!required){
					window.alert("You must enter a value for your Zip Code.");
					formStop = true;
				}
				else if(isNaN(zipC)){
					window.alert("You must enter a numerical value for your Zip Code.");
					formStop = true;
				}
				//Optional Values
				//Getting Address2
				var address2 = document.getElementById("SATwo").value;
				var needA2 = checkRequired(address1);
				
				//Getting Phone number
				var phoneNum = document.getElementById("PNum").value;
				var needPNum = checkRequired(phoneNum);
				if(isNaN(phoneNum)){
					window.alert("You must enter a numerical value for your PhoneNumber.");
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
			//string variable entered from form is checked for having "@" and "."
			//returns a boolean 
			function checkEmail(theEmail){
				if(theEmail.indexOf('@') ===-1 || theEmail.indexOf('.')===-1)
				{
				//eithor of these cannot be found
					return true;
				}
				else
				{
				//both have been found
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
	<?php
	 if (isset($_GET["msg"]) && $_GET["msg"] == 1)
	{
		echo '<p style="color:red">The Email already exists!</p>';
		}
	?>
		<p><h2>Create an Account</h2></p>
		<!-- moves data to the php file  --->
		<form action="SignUpPass.php" method="get" onreset="return clearForm()" onsubmit ="return createAccount()">
			<p><label>First Name:
				<input name = "Fname" id = "Fname" type = "text" size = "25" />
				</label>
			</p>
			<p><label>Last Name:
				<input name = "Lname" id = "Lname" type = "text" size = "25" />
				</label>
			</p>
			<p><label>E-mail:
				<input name = "EmailAd" id = "EmailAd" type = "text" size = "25" />
				</label>
			</p>
			<p><label>Password:
				<input name = "Pword" id = "Pword" type = "password" size = "25" />
				</label>
			</p>
			<p><label>Street Address:
				<input name = "SAddress" id = "SAddress" type = "text" size = "25" />
				</label>
			</p>
			<p><label>(optional)Second Street Address:
			<input name = "SATwo" id = "SATwo" type = "text" size = "25" />
			</label>
			</p>
			<p><label>City:
				<input name = "City" id = "City" type = "text" size = "25" />
				</label>
			</p>
			<p><label>State:
				<input name = "State" id = "State" type = "text" size = "2" />
				</label>
			</p>
			<p><label>Zip Code:
				<input name = "ZCode" id = "ZCode" type = "text" size = "25" />
				</label>
			</p>
			<p><label>(optional)Phone Number:
				<input name = "PNum" id = "PNum" type = "text" size = "25" />
				</label>
			</p>
			
			<p><input type = "submit"  value = "Submit"  />
				<input type = "reset"  value = "Clear" />
			</p>
			
		</form>
   </body>
</html>