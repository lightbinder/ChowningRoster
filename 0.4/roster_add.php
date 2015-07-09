<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>
    
      <h1>Add Student to Roster</h1>
      <form action="roster_add_do.php" method="get" role="form">
        <div class="form-group">
          <label for="fname">First Name:</label>
          <input id="fname" class="form-control"  type="text" name="fname" pattern="[a-zA-Z0-9]{2,64}" required />
        </div>
        <div class="form-group">
          <label for="lname">Last Name:</label>
          <input id="lname" class="form-control" type="text" name="lname" pattern="[a-zA-Z0-9]{2,64}" required />
        </div>
        <div class="form-group">
          
          <!-- Note that labels have been added for bootstrap -->
          <label for="sex">Sex:</label>
          
          <!-- form-control has been added to select and input fields on this page to take advantage of bootstrap -->
          <select id="sex" class="form-control" name="sex">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Alien">Alien</option>
          </select>
        </div>
        <div class="form-group">
          <label>Date of Birth:</label>
          <select class="form-control" name="dob_month">
            <option value="1">January</option>
            <option value="2">February</option>
            <option value="3">March</option>
            <option value="4">April</option>
            <option value="5">May</option>
            <option value="6">June</option>
            <option value="7">July</option>
            <option value="8">August</option>
            <option value="9">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
          <select class="form-control" name="dob_day">
<?php
for($x = 1; $x < 32; $x++)
{
	echo "            <option value=\"$x\">$x</option>\n";
}
?>
          </select>
          <select class="form-control" name="dob_year">
<?php
$x = date("Y");
$y = $x - 100;
for($x; $x > $y; $x--)
{
	echo "            <option value=\"$x\">$x</option>\n";
}
?>
          </select>
        </div>
        <div class="form-group">
          <label for="level">Level:</label>
          <select id="level" class="form-control" name="level">
<?php

/* file_exists */
	/* Checks to see if the file... exists O.O */
	/* Error checking to insure that program is not trying to read a file that doesn't exist */
if(file_exists("level.txt"))
{
	/* File is read normally if it exists */
	$level_file = fopen("level.txt", "r");
	while($line = fgets($level_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "            <option value=\"$line\">$line</option>\n";
	}
	fclose($level_file);
}
else
{
	/* Only one option with an error is printed if the file doesn't exist */
		/* The option doesn't have a value so that nothing will be submitted if user clicks "submit" button */
		/* An empty value will trigger the PHP error check in roster_add_do.php as well preventing anything from being put in the database */
	echo "            <option>Error: no file found, can't generate list</option>";
}
?>
          </select>
        </div>
        <div class="form-group">
          <label for="proglang">Favorite Programming Language:</label>
          <select id="proglang" class="form-control" name="proglang">
<?php

/* This is similar to the setup for the level.txt file */
if(file_exists("proglang.txt"))
{
	$proglang_file = fopen("proglang.txt", "r");
	while($line = fgets($proglang_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "            <option value=\"$line\">$line</option>\n";
	}
	fclose($proglang_file);
}
else
{
	echo "            <option>Error: no file found, can't generate list</option>\n";
}
?>
          </select>
        </div>
        <div class="form-group">
          <input class="btn btn-default" type="submit" value="Submit" />
        </div>
      </form>
      
<?php require_once("includes/footer.php"); ?>