
<!DOCTYPE html>

<!--
     Name:         Alan Duffy-Guy
     Project Phase 1: Designing Web Page
	   Purpose:	     Displays my profile
     URL:          http://unixweb.kutztown.edu/~aduff463/Project/Phase2/LoginPage.php
     Course:       CSC 242 - Fall 2015
     Due Date:     Nov. 17th, 2015
		 Errors Checked:1.Entering an empty string
						2.Email contains "@" and "."
										
-->

<html>
   <head>
      <title>Login Page</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
	  <script type = "text/javascript">
	  <!--
			function login(){
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
				//Getting password
				var password = document.getElementById("Pword").value;
				required = checkRequired(password);
				if (!required){
					window.alert("You must enter a value for your Password.");
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
		<a href = "orders.php">Check Orders</a>
		<a href = "search.php">Search The Catalogue</a>
		<a href = "SignUp.php">Sign Up</a>
		<a href = "LoginPage.php">Sign In</a>
		<a href = "ContactUs.php">Contact Us</a>
	 </div>
	 <hr></hr>
		</p><h2>Login to your account</p></h2>
    <?php
	if (isset($_GET["msg"]) && $_GET["msg"] == 1)
	{
		echo '<p style="color:red"> User Name and/Or Password Not Found.</p>';
	}
	?>
		<form action="LoginPagePass.php" method="get" onreset="return clearForm()" onsubmit ="return login()">
			<p><label>E-mail:
				<input name = "EmailAd" id = "EmailAd" type = "text" size = "25" />
				</label>
			</p>
			<p><label>Password:
				<input name = "Pword" id = "Pword" type = "password" size = "25" />
				</label>
			</p>
			<p><input type = "submit"  value = "Submit"  />
				<input type = "reset"  value = "Clear" />
			</p>
			
		</form>
   </body>
</html>