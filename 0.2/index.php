<!-- PHP-LOGIN-Minimal: a basic php login system with a database containing usernames and passwords -->
  <!-- php-login/config/db.php has been modified with database parameters (this is the only file that needs to modified) -->

<!-- header.php -->
	<!-- Contains code required for PHP-LOGIN to function -->
	<!-- Contains start of html page -->
<?php require_once("includes/header.php"); ?>

<?php
/* Login object */
	/* Manages user logging in and out */
	/* isUseroggedIn() checks if the user is logged in */
if($login->isUserLoggedIn() == true)
{
	/* Content seen if the user logs in */
	echo '
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add Student to Roster</a></li>
      <li><a href="roster_view.php">View Roster</a></li>
      <li><a href="index.php?logout">Logout</a></li>
    </ul>
	';
}   

else
{
	/* Content seen if the user is not logged in */
	
	// show potential errors / feedback (from login object)
	if (isset($login))
	{
		if ($login->errors)
		{
			foreach ($login->errors as $error)
			{
				echo $error;
			}
		}
		if ($login->messages)
		{
			foreach ($login->messages as $message) {
				echo $message;
			}
		}
	}

	/* This is the login form */
	echo '
    <!-- login form box -->
    <form method="post" action="index.php" name="loginform">
        
        <!-- label: this is mainly for human readability -->
        <!-- for: attribute of label that indicates what input the label is for -->
        <!-- id: used to identify element for "for" attribute, css, javascript, etc. -->
        <!-- required: forces user to input data into field -->
        <label for="login_input_username">Username</label>
        <input id="login_input_username" class="login_input" type="text" name="user_name" required />
        
        <label for="login_input_password">Password</label>
        
        <!-- password type: text input that hides characters as password characters (depends on the browser what is shown) -->
        <!-- autocomplete="off": prevents browser from filling field with cache (memory) -->
        <input id="login_input_password" class="login_input" type="password" name="user_password" autocomplete="off" required />
    
        <input type="submit"  name="login" value="Log in" />
    
    </form>
    
    <!-- Link for registering an account -->
    <a href="register.php">Register new account</a>
	';
}
?>

  </body>
</html>