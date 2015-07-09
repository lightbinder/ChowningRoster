<?php require_once("includes/header.php"); ?>

<?php
// Load registration class and create registration object
require_once("php-login/classes/Registration.php");
$registration = new Registration();

// show potential errors / feedback (from registration object)
if (isset($registration))
{
	if ($registration->errors)
	{
		foreach ($registration->errors as $error)
		{
			echo $error;
		}
	}
	if ($registration->messages)
	{
		foreach ($registration->messages as $message)
		{
			echo $message;
		}
	}
}
?>

    <!-- register form -->
    <form method="post" action="register.php" name="registerform">
    
      <!-- the user name input field uses a HTML5 pattern check -->
      <!-- pattern: forces a text input to meet a certain pattern using regex -->
      <label for="login_input_username">Username (only letters and numbers, 2 to 64 characters)</label>
      <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required />
      
      <!-- the email input field uses a HTML5 email type check -->
        <!-- Requires the user to put an email into input based on email pattern matching -->
      <label for="login_input_email">User's email</label>
      <input id="login_input_email" class="login_input" type="email" name="user_email" required />
    
      <label for="login_input_password_new">Password (min. 6 characters)</label>
      <input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />
    
      <label for="login_input_password_repeat">Repeat password</label>
      <input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
      <input type="submit"  name="register" value="Register" />
    </form>

    <!-- backlink -->
    <a href="index.php">Back to Login Page</a>

  </body>
</html>