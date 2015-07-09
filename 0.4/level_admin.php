<!-- This page is one of the admin pages that will be locked in future versions -->
  <!-- This page allows an admin to add more levels for the dropdown menu when adding a student (roster_add.php) -->
  <!-- Using the current method of allowing the user to submit new options makes it difficult to allow the user to delete fields -->
  <!-- This problem will be corrected in the next version through using a SQL tables (right tool for the job) -->

<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

      <h1>Current Levels</h1>
<?php

/* Checking to make sure the level.txt file exists before manipulating it */
if(file_exists("level.txt"))
{
	/* Printing an unordered list of current levels available */
	echo "      <ul>\n";

	/* Using file handling introduced in version 0.2 */
	$level_file = fopen("level.txt", "r");
	while($line = fgets($level_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "        <li>$line</li>\n";
	}
	fclose($level_file);

	echo "      </ul>\n";
}
else
{
	/* Error message if file can't be found */
	echo "      <p>Could not find file to display levels.</p>\n";
}
?>
      
      <!-- Form allowing submission of a new level -->
      <h1>Add Level</h1>
      <form action="level_admin_do.php" method="get">
        <div class="form-group">
          <label for="level_add">New Level:</label>
          <input id="level_add" class="form-control" type="text" name="level_add" pattern="[a-zA-Z0-9\#\-]{2,64}" autocomplete="off" required />
        </div>
        <div class="form-group">
          <input class="btn btn-default" type="submit" name="submit" value="Add Level" />
        </div>
      </form>

<?php require_once("includes/footer.php"); ?>