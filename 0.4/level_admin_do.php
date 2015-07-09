<!-- File that submits data from level_admin.php -->

<?php require_once("includes/header.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php

/* Acquiring the new level sent from level_admin.php */
$level_new = $_GET['level_add'];

/* Making sure the file exists */
if(file_exists("level.txt"))
{
	/* Using 'a+' here for reading */
		/* Opens a file for appending (adds to the end of the file rather than overwriting it) and reading */
	$level_file = fopen("level.txt", "a+");
	
	/* fread() */
		/* Reads the contents of an opened file into a string */
		/* Second argument is the size (in bytes) to read from the file and is not optional */
		/* Therefore, filesize() is used to calculate the size of the file so that the whole file can be read */
		/* The file contents are put into a string to check the submitted level against what is already in the file */
	$level_file_contents = fread($level_file, filesize("level.txt"));
	
	/* stripos($string, $substring) */
		/* Returns the first position of a substring in a string (case insensitive); returns false if the substring can't be found */
		/* Here, if the stripos() returns false then the new level submitted by user is not a duplicate and can be added */
		/* Using '===' instead of '==' as stripos requires this (more intensive check) */
	if(stripos($level_file_contents, $level_new) === false)
	{
		/* fwrite() */
			/* Write to a file opened for writing a specified value */
			/* As this is writing to the end of the file (has no line return [\r\n] at the end), adding one at the beginning through just-in-time concatenation */
		fwrite($level_file, "\r\n" . $level_new);
		echo "
      <h1>Added New Level</h1>
      <ul>
        <li>$level_new</li>
      </ul>
      <a href=\"level_admin.php\" class=\"btn btn-primary\">Add Another?</a>\n";
	}
	else
	{
		echo "
      <h1>Error:</h1>
      <p>This level already exists.</p>
      <a href=\"level_admin.php\" class=\"btn btn-primary\">Go Back</a>\n";
	}
	fclose($level_file);
}
else
{
	echo "
       <h1>Error:</h1>
       <p>Could not find file to add level to.</p>
       <p><a href=\"level_admin.php\" class=\"btn btn-primary\">Go Back</a></p>\n";
}
?>

<?php require_once("includes/footer.php"); ?>
