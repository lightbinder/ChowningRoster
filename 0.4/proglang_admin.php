<!-- The other admin file that allows a user to add more programming languages to the dropdown menu for roster_add.php -->
  <!-- This file is very similar to level_add.php, so detailed comments are included there -->

<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

      <h1>Current Languages</h1>
<?php
/* Checking for the proglang.txt file */
if(file_exists("proglang.txt"))
{
	/* Displaying the current programming languages */
	echo "      <ul>\n";

	$proglang_file = fopen("proglang.txt", "r");
	while($line = fgets($proglang_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "        <li>$line</li>\n";
	}
	fclose($proglang_file);

	echo "      </ul>\n";
}
else
{
	/* Error message for inability to find file */
	echo "      <p>Could not find file to display programming languages.</p>\n";
}
?>      
      <!-- New Programming Language Form -->
      <h1>Add Programming Language</h1>
      <form action="proglang_admin_do.php" method="get">
        <div class="form-group">
          <label for="proglang_add">New Programming Language:</label>
          <input id="proglang_add" class="form-control" type="text" name="proglang_add" pattern="[a-zA-Z0-9\#\+]{2,64}" autocomplete="off" required />
        </div>
        <div class="form-group">
          <input class="btn btn-default" type="submit" name="submit" value="Add Programming Language" />
        </div>
      </form>

<?php require_once("includes/footer.php"); ?>