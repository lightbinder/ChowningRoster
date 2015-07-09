<?php require_once("includes/header.php"); ?>

<?php
// Load registration class and create registration object
require_once("php-login-advanced/classes/Registration.php");
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


<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful && !$registration->verification_successful)
{
	echo "
    <!-- Information in form sent to registration object where it is processed into the login database to store the information -->
    <form method=\"post\" action=\"register.php\" name=\"registerform\">
      <label for=\"user_name\">" .  WORDING_REGISTRATION_USERNAME . "</label><br />
      <input id=\"user_name\" type=\"text\" pattern=\"[a-zA-Z0-9]{2,64}\" name=\"user_name\" required /><br />
    
      <!-- email: forces user to input email pattern into text box -->
      <label for=\"user_email\">" .  WORDING_REGISTRATION_EMAIL . "</label><br />
      <input id=\"user_email\" type=\"email\" name=\"user_email\" required /><br />
    
      <label for=\"user_password_new\">" .  WORDING_REGISTRATION_PASSWORD . "</label><br />
      <input id=\"user_password_new\" type=\"password\" name=\"user_password_new\" pattern=\".{6,}\" required autocomplete=\"off\" /><br />
    
      <label for=\"user_password_repeat\">" .  WORDING_REGISTRATION_PASSWORD_REPEAT . "</label><br />
      <input id=\"user_password_repeat\" type=\"password\" name=\"user_password_repeat\" pattern=\".{6,}\" required autocomplete=\"off\" /><br />
    
      <!-- This is a captcha image that prevents bots from signing up -->
      <img src=\"php-login-advanced/tools/showCaptcha.php\" alt=\"captcha\" /><br />
    
      <label>" .  WORDING_REGISTRATION_CAPTCHA . "</label><br />
      <input type=\"text\" name=\"captcha\" required /><br />
    
      <input type=\"submit\" name=\"register\" value=\"" .  WORDING_REGISTER . "\" /><br />
       <!-- Submission causes message and error output from header.php -->
    </form>";
}
?>

    <br /><a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php require_once("includes/footer.php"); ?>