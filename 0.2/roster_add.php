<!-- header-require_login.php -->
  <!-- Prevents users from accessing pages by typing them directly into the url if they aren't logged in -->

<?php require_once("includes/header-require_login.php"); ?>
    
    <h1>Add Student to Roster</h1>
    <form action="roster_add_do.php" method="get">
      First Name: <input type="text" name="fname" /><br />
      Last Name: <input type="text" name="lname" /><br />
      Sex:
      <select name="sex">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Alien">Alien</option>
      </select><br />
      Date of Birth: 
      <select name="dob_month">
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
      <select name="dob_day">
<?php
for($x = 1; $x < 32; $x++)
{
	echo "        <option value=\"$x\">$x</option>\n";
}
?>
      </select>
      <select name="dob_year">
<?php
$x = date("Y");
$y = $x - 100;
for($x; $x > $y; $x--)
{
	echo "        <option value=\"$x\">$x</option>\n";
}
?>
      </select><br />
      Level:
      <select name="level">
<?php
/* File Handling */
	/* fopen */
		/* Opens the named file for a purpose... */
		/* Reading: r */
		/* Writing: w */
		/* Reading and writing: r+ */

	/* fgets() */
		/* Reads one line from an open file */
		/* If placed in a while loop, will continue to read each line until the end of the file */

$level_file = fopen("level.txt", "r");

/* The file being read contains the levels that were previously saved in an array */
	/* The use of a file will allow components to be built in later versions for users to add new levels */
	/* A more elegant solution for user input will be created in a later version */
while($line = fgets($level_file))
{
	/* str_replace: replaces the first string with the string in the larger provided string (third argument) */
		/* This is done here to keep the source code displayed through the browser clean */
	$line = str_replace("\r\n", "", $line);
	echo "        <option value=\"$line\">$line</option>\n";
}
	/* fclose() */
		/* Closes a file */
		/* Must be done to every open file to prevent file corruption */
fclose($level_file);
?>
      </select><br />
      Favorite Programming Language:
      <select name="proglang">
<?php
$proglang_file = fopen("proglang.txt", "r");

/* The file being read here contains the programming languages that were previously in an array, similar format to above */
while($line = fgets($proglang_file))
{
	$line = str_replace("\r\n", "", $line);
	echo "        <option value=\"$line\">$line</option>\n";
}
fclose($proglang_file);
?>
     </select><br />
      <input type="submit" value="Submit" />
    </form>

    <h1>Actions</h1>
    <ul>
      <li><a href="roster_view.php">View roster</a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php?logout">Logout</a></li>
    </ul>

  </body>
</html>