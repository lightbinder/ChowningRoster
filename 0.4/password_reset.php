<?php require_once("includes/header.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php
// show potential errors / feedback (from login object)
if (isset($login))
{
	if ($login->errors)
	{
		foreach ($login->errors as $error)
		{
			echo "      <p>$error</p>";
		}
	}
	if ($login->messages)
	{
		foreach ($login->messages as $message)
		{
			echo "      <p>$message</p>";
		}
	}
}

if ($login->passwordResetLinkIsValid() == true)
{
	echo "
      <!-- If user has submitted a valid link from email, show password reset form -->
      
      <!-- Note that this form (along with the rest on this page) has the same bootstrap classes added to it as the sign-in form in index.php -->
      <form method=\"post\" action=\"password_reset.php\" name=\"new_password_form\" role=\"form\">
        <input type='hidden' name='user_name' value='" . $_GET['user_name'] . "' />
        <input type='hidden' name='user_password_reset_hash' value='" . $_GET['verification_code'] . "' />
        <div class=\"form-group\">
          <label for=\"user_password_new\">" . WORDING_NEW_PASSWORD . "</label>
          <input id=\"user_password_new\" class=\"form-control\" type=\"password\" name=\"user_password_new\" pattern=\".{6,}\" required autocomplete=\"off\" />
        </div>
        <div class=\"form-group\">
          <label for=\"user_password_repeat\">" . WORDING_NEW_PASSWORD_REPEAT . "</label>
          <input id=\"user_password_repeat\" class=\"form-control\" type=\"password\" name=\"user_password_repeat\" pattern=\".{6,}\" required autocomplete=\"off\" />
        </div>
        <div class=\"form-group\">
          <input type=\"submit\" class=\"btn btn-default\" name=\"submit_new_password\" value=\"" . WORDING_SUBMIT_NEW_PASSWORD . "\" />
        </div>
      </form>
      <a href=\"index.php\">" . WORDING_BACK_TO_LOGIN . "</a>";

}
elseif($login->passwordResetWasSuccessful() == true && $login->passwordResetLinkIsValid() != true)
{
	echo "
        <!-- password reset is successful, show the logged out view (sign-in form) -->
        <h1>Sign In</h1>
        <!-- Sign-in Form -->
        <form method=\"post\" action=\"index.php\" name=\"loginform\" role=\"form\">
          <div class=\"form-group\">
            <label for=\"user_name\">" . WORDING_USERNAME . "</label>
            <input id=\"user_name\" class=\"form-control\" type=\"text\" name=\"user_name\" required />
          </div>
          <div class=\"form-group\">
            <label for=\"user_password\">" . WORDING_PASSWORD . "</label>
            <input id=\"user_password\" class=\"form-control\" type=\"password\" name=\"user_password\" autocomplete=\"off\" required />
          </div>
          <div class=\"checkbox\">
            <!-- checkbox: exactly what it says here -->
            <label for=\"user_rememberme\">
              <input type=\"checkbox\" id=\"user_rememberme\" name=\"user_rememberme\" value=\"1\" />" . WORDING_REMEMBER_ME . "
            </label>
          </div>
          <div class=\"form-group\">
            <input type=\"submit\" class=\"btn btn-default\" name=\"login\" value=\"" . WORDING_LOGIN . "\" />
          </div>
        </form>
        
        <p>
          <a href=\"register.php\">" . WORDING_REGISTER_NEW_ACCOUNT . "</a>
        </p>
        <p>
          <a href=\"password_reset.php\">" . WORDING_FORGOT_MY_PASSWORD . "</a>
        </p>";

}
else
{
	echo "
      <!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
      <form method=\"post\" action=\"password_reset.php\" name=\"password_reset_form\" role=\"form\">
        <div class=\"form-group\">
          <label for=\"user_name\">" . WORDING_REQUEST_PASSWORD_RESET . "</label>
          <input id=\"user_name\" class=\"form-control\" type=\"text\" name=\"user_name\" required />
        </div>
        <div class=\"form-group\">
          <input type=\"submit\" class=\"btn btn-default\" name=\"request_password_reset\" value=\"" . WORDING_RESET_PASSWORD . "\" />
        </div>
      </form>
      <a href=\"index.php\">" . WORDING_BACK_TO_LOGIN . "</a>";
}
?>


<?php require_once("includes/footer.php"); ?>