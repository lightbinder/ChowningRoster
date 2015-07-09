<!-- Submits data from proglan_admin.php -->
  <!-- Similar to level_admin_do.php where detailed comments are provided -->

<?php require_once("includes/header.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php
/* Acquires new programming language from proglang_admin.php */
$proglang_new = $_GET['proglang_add'];

/* Making sure that proglang.txt file exists */
if(file_exists("proglang.txt"))
{
	/* Opening and reading into string in order to search new programming language against those already added */
	$proglang_file = fopen("proglang.txt", "a+");
	$proglang_file_contents = fread($proglang_file, filesize("proglang.txt"));
	
	/* Searching for submitted programming language in file */
	if(stripos($proglang_file_contents, $proglang_new) === false)
	{
		/* Writing to file if not found */
		fwrite($proglang_file, "\r\n" . $proglang_new);
		echo "
      <h1>Added New Programming Languages</h1>
      <ul>
        <li>$proglang_new</li>
      </ul>\n";
	}
	else
	{
		/* Error message if submitted language is a duplicate */
		echo "
      <h1>Error:</h1>
      <p>This language already exists.</p>
      <a href=\"proglang_admin.php\" class=\"btn btn-primary\">Go Back</a>\n";
	}
	fclose($proglang_file);
}
else
{
	echo "
       <h1>Error:</h1>
       <p>Could not find file to add programming language to.</p>
       <a href=\"proglang_admin.php\" class=\"btn btn-primary\">Go Back</a>\n";
}
?>

<?php require_once("includes/footer.php"); ?>
