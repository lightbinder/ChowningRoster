<!-- Modal: a better way to do a popup -->
  <!-- This is not a pop-up in the traditional sense as it does not open a new browser window -->
  <!-- This is a javascript window that pops up in the website itself -->
  <!-- See roster_view.php for the first example -->

<?php require_once("includes/header.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php
if($login->isUserLoggedIn() == true)
{
	echo "
      <h1>Chowning Roster 0.4</h1>
      <p class=\"lead\">
        Welcome to Bootstrap and jQuery, where all your troubles melt away!
      </p>";
}
else
{
	/* Sign In header before error display */
	echo "
      <h1>Sign In</h1>\n";
      
	// show potential errors / feedback (from login object)
	if (isset($login))
	{
		if ($login->errors)
		{
			foreach ($login->errors as $error)
			{
				/* Errors have now been placed in <p></p> tags to keep them in the normal HTML flow */
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

	echo "
      <!-- Sign-in Form -->
      <!-- role: used by screen readers to determine the parts of a webpage -->
      <form method=\"post\" action=\"index.php\" name=\"loginform\" role=\"form\">
      
        <!-- div:  separates content into a specific area/division and confines is there, also used by CSS to apply formatting -->
        <!-- form-group: divides each label and input in a form for specific formatting -->
        <div class=\"form-group\">
          <label for=\"user_name\">" . WORDING_USERNAME . "</label>
          
          <!-- form-control: makes 'input' and 'select' look pretty -->
          <input id=\"user_name\" class=\"form-control\" type=\"text\" name=\"user_name\" required />
        </div>
        <div class=\"form-group\">
          <label for=\"user_password\">" . WORDING_PASSWORD . "</label>
          <input id=\"user_password\" class=\"form-control\" type=\"password\" name=\"user_password\" autocomplete=\"off\" required />
        </div>
        <div class=\"checkbox\">
        
          <!-- checkbox: exactly what it says here, note the arrangement of the label as this is necessary for bootstrap -->
          <label for=\"user_rememberme\">
            <input type=\"checkbox\" id=\"user_rememberme\" name=\"user_rememberme\" value=\"1\" />" . WORDING_REMEMBER_ME . "
          </label>
        </div>
        
        <!-- form-group for the submit button is not usually demonstrated on getboostrap.com, but this keeps everything looking nice -->
        <div class=\"form-group\">
          <!-- btn: creates a button with bootstrap flare -->
          <!-- btn-default: uses the default coloring for a button -->
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
?>

<?php require_once("includes/footer.php"); ?>