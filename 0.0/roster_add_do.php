<?php
/* Vocab */
	/* argument: any input into a function, Example: $query is the argument of the function prepare($query) */
	/* character: a letter, special character (-,;_ $  etc.), or number (the number cannot be binary based i.e. 2 =/= '2' [string]) */
	/* string: a sequence of characters */

/* PHP $_GET variable */
	/* Pulls a specified variable and its value from the HTTP header (url) */
	/* Name in brackets and quotes [''] specifies HTTP variable to pull */
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$sex = $_GET['sex'];

/* Just-in-time Concatenation */
	/* A dot joins strings together in PHP */
	/* Used here to satisfy SQL's date format of YYYY-MM-DD */
$dob = $_GET['dob_year'] . "-" . $_GET['dob_month'] . "-" . $_GET['dob_day'];
$level = $_GET['level'];
$proglang = $_GET['proglang'];

/* SQL and Databases */
	/* Assigning database parameters to variables */

$db_host = "localhost";
$db_user = "chowningrosterdb";
$db_pass = "lAsw3KeLATKnZ4ZTBOxQLHvpXm99wezS";
$db_db = "chowningrosterdb";

/* Connection variable that allows connection to database */
	/* Uses variables above in the given order */
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

/* SQL Query: CREATE TABLE*/
	/* CREATE TABLE IF NOT EXISTS `table_name`: creates a table of the name table_name if it doesn't already exist */
	/* Parentheses start the column names to be created in the table */
	/* Column name format: name PARAMETERS */
		/* BIGINT: allows 8 bytes for number storage */
		/* UNSIGNED: prevents an integer from being negative, doubling is max positive value */
		/* AUTO_INCREMENT: adds 1 to previous row value, even if previous row was deleted */
		/* PRIMARY KEY: indicates column that makes each row distinct (required for good database design) */
		/* VARCHAR(#): indicates a string (letters/characters put together), # indicates max characters allowed in string */
		/* DATE: indicates date in format YYYY-MM-DD */

/* This query is creating the table for the roster */
$query = "CREATE TABLE IF NOT EXISTS `roster` ( rid BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, lname VARCHAR(255), fname VARCHAR(255), sex VARCHAR(255), dob DATE, level VARCHAR(255), proglang VARCHAR(255) );";

/* SQL Prepared statements */

/* Prepares the statement so that it can be reused if needed */
$stmt = $con->prepare($query);
/* Executes the prepared query */
$stmt->execute();
/* Closes the statment object */
$stmt->close();

/* SQL Query: INSERT INTO */
	/* INSERT INTO `table_name: inserts values into the specified table */
	/* VALUES (): specifies the values to be inserted starting at the first column */

/* This query is inserting the values submitted from roster_add.php into the database */
/* Note the use of '' to skip the first auto incrementing column and ? for binding parameters later on */
$query = "INSERT INTO `roster` VALUES ( '', ?, ?, ?, ?, ?, ? );";
$stmt = $con->prepare($query);

/* bind_param: specifies the variables to be used in place of the ? in the query */
	/* "ssssss": indicates variable type, one letter per variable */
		/* s = string */
		/* i = integer */
	/* Variables follow in order of the ? in the query statement */
$stmt->bind_param("ssssss", $lname, $fname, $sex, $dob, $level, $proglang);
$stmt->execute();
$stmt->close();

$con->close();
?>
<html>
  <head>
    <title>ChowningRoster 0.1 - Add User Complete</title>
  </head>
  <body>
    <h1>Add User Complete</h1>
    <p>The following user has been successfully added:</p>
    <ul>
<?php
echo "
      <li>First Name: $fname</li>
      <li>Last Name: $lname</li>
      <li>Sex: $sex</li>
      <li>Date of Birth: $dob</li>
      <li>Level: $level</li>
      <li>Favorite Programming Language: $proglang</li>
";
?>
    </ul>
    <!-- Common section to add to webpages, allows navigation around rest of site -->
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add another student</a></li>
      <li><a href="roster_view.php">View roster</a></li>
      <li><a href="index.php">Home</a></li>
    </ul>
  </body>
</html>