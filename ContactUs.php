<!DOCTYPE html>

<!--
     Name:         Alan Duffy-Guy
     Project Phase 2: Implementing interactions with the Database
	Purpose:	   	Displays a list of contacts and allows the user to send feedback
     URL:          http://unixweb.kutztown.edu/~aduff463/Project/Phase2/ContactUs.php
     Course:       CSC 242 - Fall 2015
     Due Date:     Nov. 17, 2015
		Errors Checked:1.Entering an empty string
									2.Checking if Email has an @ or a .
									3.not putting data in a required field
									
-->

<html>
   <head>
      <title>             </title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	  <script type = "text/javascript">
		
	  function submitForm(){
		//stops form from ouputing if it is true
				var formStop =false
		//checks if a required input is not entered
				var required = true;
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
				//getting the Name
				var Name = document.getElementById("Uname").value;
				required = checkRequired(Name);
				if (!required){
					window.alert("You must enter a Value for First Name.");
					formStop = true;
				}
				//getting the text from textarea
				var comments = document.getElementById("userForm").value;
				required = checkRequired(comments);
				if (!required){
					window.alert("You must enter a Value in the comments.");
					formStop = true;
				}
				//everything is correct 
				if(!formStop){
					document.writeln("<p>" + email + "</p>" +
													 "<P>" + Name + "</p>" +
													 "<p>" + comments + "</p>");
				}
			}
			//string variable entered from form is checked for having "@" and "."
			//returns a boolean 
			function checkEmail(theEmail){
				if(theEmail.indexOf('@') ===-1 || theEmail.indexOf('.')===-1)
				{
				//either of these cannot be found
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
				//an empty string evaluates to false in a boolen context
				
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
    
    
   <p><h2>Contact Us</h2></p>
	 <p><h3>Our Information</h3></p>
	 <p>Email: thatbookstore@msn.com <p>
	 <p>Phone Number: 555-878-1346</p>
	 <p>Address: 123 Fake St. Springfield,Michigan</p>
	 <br>
	 <p><h3>Send Us A Message Directly</h3></p>
		<form onreset="return clearForm()" onsubmit ="submitForm()">
			<p><label>E-mail:
				<input name = "EmailAd" id = "EmailAd" type = "text" size = "25" />
				</label>
			</p>
			<p>
				<label>Name: <input type="text" name="usrname" id="Uname" size = "25"/></label>
			</p>
		<textarea rows = "4" cols="50" name="comment" id="userForm">Enter text here...</textarea>

			<p><input type = "submit"  value = "Submit"  />
				<input type = "reset"  value = "Clear" />
			</p>
			
		</form>
   </body>
</html>

