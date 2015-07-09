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
?>

<?php
if ($login->passwordResetLinkIsValid() == true)
{
	echo "
    <!-- If user has submitted a valid link from email, show password reset form -->
    <form method=\"post\" action=\"password_reset.php\" name=\"new_password_form\">
      <input type=\"hidden\" name=\"user_name\" value=\"" . $_GET['user_name'] . "\" />
      <input type=\"hidden\" name=\"user_password_reset_hash\" value=\"" . $_GET['verification_code'] . "\" />
      
      <label for=\"user_password_new\">" . WORDING_NEW_PASSWORD . "</label><br />
      <input id=\"user_password_new\" type=\"password\" name=\"user_password_new\" pattern=\".{6,}\" required autocomplete=\"off\" /><br />
      
      <label for=\"user_password_repeat\">" . WORDING_NEW_PASSWORD_REPEAT . "</label><br />
      <input id=\"user_password_repeat\" type=\"password\" name=\"user_password_repeat\" pattern=\".{6,}\" required autocomplete=\"off\" /><br />
      <input type=\"submit\" name=\"submit_new_password\" value=\"" . WORDING_SUBMIT_NEW_PASSWORD . "\" /><br />
    </form>
    <a href=\"index.php\">" . WORDING_BACK_TO_LOGIN . "</a>";
}
elseif($login->passwordResetWasSuccessful() == true && $login->passwordResetLinkIsValid() != true)
{
    echo "
    <!-- password reset is successful, show the logged out view (sign-in form) -->
    <form method=\"post\" action=\"index.php\" name=\"loginform\">
      <label for=\"user_name\">" . WORDING_USERNAME . "</label>
      <input id=\"user_name\" type=\"text\" name=\"user_name\" required /><br />
      <label for=\"user_password\">" . WORDING_PASSWORD . "</label>
      <input id=\"user_password\" type=\"password\" name=\"user_password\" autocomplete=\"off\" required /><br />
      <input type=\"checkbox\" id=\"user_rememberme\" name=\"user_rememberme\" value=\"1\" />
      <label for=\"user_rememberme\">" . WORDING_REMEMBER_ME . "</label><br />
      <input type=\"submit\" name=\"login\" value=\"" . WORDING_LOGIN . "\" /><br />
    </form>
    
    <a href=\"register.php\">" . WORDING_REGISTER_NEW_ACCOUNT . "</a>
    <a href=\"password_reset.php\">" . WORDING_FORGOT_MY_PASSWORD . "</a>";
}
else
{
	echo "
    <!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
    <form method=\"post\" action=\"password_reset.php\" name=\"password_reset_form\">
      <label for=\"user_name\">" . WORDING_REQUEST_PASSWORD_RESET . "</label><br />
      <input id=\"user_name\" type=\"text\" name=\"user_name\" required /><br />
      <input type=\"submit\" name=\"request_password_reset\" value=\"" . WORDING_RESET_PASSWORD . "\" /><br />
    </form>
    <a href=\"index.php\">" . WORDING_BACK_TO_LOGIN . "</a>";
}
?>

<?php require_once("includes/footer.php"); ?>