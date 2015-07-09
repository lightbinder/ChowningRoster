<!-- Using PHP-LOGIN Advanced -->
  <!-- Has an email client built into it for password verification and reset, but still requires an email account (a gmail account for this is great) -->
  <!-- Note that php-login-advanced/config/config.php has been modified with database and email paramaters -->

<?php require_once("includes/header.php"); ?>

<?php
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
		foreach ($login->messages as $message)
		{
			echo $message;
		}
	}
}

if($login->isUserLoggedIn() == true)
{
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
	/* Sign-in form */
		/* Variables defined in php-login-advanced/translations/en.php using define() function */
		/* define() function makes text a variable requiring just-in-time concatenation to prevent variable from being read as a string */
	echo '
    <form method="post" action="index.php" name="loginform">
      <label for="user_name">' . WORDING_USERNAME . '</label>
      <input id="user_name" type="text" name="user_name" required /><br />
      <label for="user_password">' . WORDING_PASSWORD . '</label>
      <input id="user_password" type="password" name="user_password" autocomplete="off" required /><br />
      
      <!-- checkbox: exactly what it says here -->
      <input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
      <label for="user_rememberme">' . WORDING_REMEMBER_ME . '</label><br />
      <input type="submit" name="login" value="' . WORDING_LOGIN. '" />
    </form>
    
    <a href="register.php">' . WORDING_REGISTER_NEW_ACCOUNT . '</a>
    <a href="password_reset.php">' . WORDING_FORGOT_MY_PASSWORD . '</a>
	';
}
?>

<?php require_once("includes/footer.php"); ?>