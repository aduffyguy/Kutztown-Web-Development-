<!DOCTYPE html>


<!--
     Name:         Alan Duffy-Guy
     Project Phase2: Designing Web Page
	 Purpose:	   Displays my profile
     URL:          http://unixweb.kutztown.edu/~aduff463/Project/Phase2/BookMain.html
     Course:       CSC 242 - Fall 2015
     Due Date:     Nov. 17, 201
		 Formatting:for h1 font is helvetica. Text is aligned to the center. The font size is 22. Font color is set to #2f140d
								for h2 font is arial. Text is aligned to the center. The font size is 18. Font color is set to #2f140d
								for h3 font is arial, font size is 15, color is #2f140d
								for p font size is 12pt,font is arial, color is set to #340000
								for body thebackground color is set to #ABCCA3
                for label color is set to #340000
								for the class centered text is aligned to the center, font size is 15pt,font is arial
		 
-->

<html>
   <head>
      <title>Book Store</title>
	  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="SiteStyle.css" >
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
	  <script type = "text/javascript">
	  
	  </script>
   </head>
   <body>
   <?php
	if (isset($_GET["msg"]) && $_GET["msg"] == 1)
	{
		echo '<p style="text-align:center"> You are now logged in.</p>';
	}
	?>
    <p style ="color:red;text-align:center">THIS IS A PROJECT AND NOT AN ACTUAL STORE</p>
		<p style="text-align:center"><img src="library-tree.jpg" alt ="The Elder Wood Bookstore"style=" width:640px height:360px;"></p>
   </body>
</html>