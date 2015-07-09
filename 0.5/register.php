<?php require_once("includes/header.php"); ?>

<?php require_once("includes/menu.php"); ?>

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
			echo "      <p>$error</p>";
		}
	}
	if ($registration->messages)
	{
		foreach ($registration->messages as $message)
		{
			echo "      <p>$message</p>";
		}
	}
}
?>

<!-- show registration form, but only if we didn't submit already -->
<?php
if (!$registration->registration_successful && !$registration->verification_successful)
{
	echo "
      <!-- Information in form sent to registration object where it is processed into the login database to store the information -->
      
      <!-- Same form as in 0.3, but with bootstrap -->
      <form method=\"post\" action=\"register.php\" name=\"registerform\" role=\"form\">
        <!-- pattern: using regex to limit the pattern of the input -->
        <div class=\"form-group\">
          <label for=\"user_name\">" .  WORDING_REGISTRATION_USERNAME. "</label><br />
          <input id=\"user_name\" class=\"form-control\" type=\"text\" pattern=\"[a-zA-Z0-9]{2,64}\" name=\"user_name\" required /><br />
        </div>
        <div class=\"form-group\">
          <!-- email: forces user to input email pattern into text box -->
          <label for=\"user_email\">" .  WORDING_REGISTRATION_EMAIL. "</label><br />
          <input id=\"user_email\" class=\"form-control\" type=\"email\" name=\"user_email\" required /><br />
        </div>
        <div class=\"form-group\">
          <label for=\"user_password_new\">" .  WORDING_REGISTRATION_PASSWORD. "</label><br />
          <input id=\"user_password_new\" class=\"form-control\" type=\"password\" name=\"user_password_new\" pattern=\".{6,}\" required autocomplete=\"off\" /><br />
        </div>
        <div class=\"form-group\">
          <label for=\"user_password_repeat\">" .  WORDING_REGISTRATION_PASSWORD_REPEAT. "</label><br />
          <input id=\"user_password_repeat\" class=\"form-control\" type=\"password\" name=\"user_password_repeat\" pattern=\".{6,}\" required autocomplete=\"off\" /><br />
        </div>
        <div class=\"form-group\">
          <!-- This is a captcha image that prevents bots from signing up -->
          <img class=\"img-rounded\" src=\"php-login-advanced/tools/showCaptcha.php\" alt=\"captcha\" /><br />
          
          <label>" .  WORDING_REGISTRATION_CAPTCHA. "</label><br />
          <input class=\"form-control\" type=\"text\" name=\"captcha\" required /><br />
        </div>
        <div class=\"form-group\">
          <input type=\"submit\" class=\"btn btn-default\" name=\"register\" value=\"" .  WORDING_REGISTER. "\" /><br />
          <!-- Submission causes message and error output from header.php -->
        </div>
      </form>\n";
}
?>

      <p>
        <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
      </p>

<?php require_once("includes/footer.php"); ?>