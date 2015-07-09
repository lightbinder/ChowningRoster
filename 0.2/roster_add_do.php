<?php require_once("includes/header-require_login.php"); ?>

<?php
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$sex = $_GET['sex'];
$dob = $_GET['dob_year'] . "-" . $_GET['dob_month'] . "-" . $_GET['dob_day'];
$level = $_GET['level'];
$proglang = $_GET['proglang'];

require_once("includes/db.php");
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

$query = "CREATE TABLE IF NOT EXISTS `roster` ( rid BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY, lname VARCHAR(255), fname VARCHAR(255), sex VARCHAR(255), dob DATE, level VARCHAR(255), proglang VARCHAR(255) );";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->close();

/* This if statement is an error check that prevents blank submissions */
if($fname && $lname && $sex && $dob && $level && $proglang)
{
	/* SQL Query: COUNT() */
		/* Counts the number of unique entries in the given column ( * indicates every column) */
		/* WHERE limits COUNT() to which entries it can use */
		/* This query counts the number of entries in the table that have the submitted fname, lname, and dob */
	$query = "SELECT COUNT(*) FROM `roster` WHERE fname = ? and lname = ? and dob = ?";
	$stmt = $con->prepare($query);
	$stmt->bind_param("sss", $fname, $lname, $dob);
	$stmt->execute();
	$stmt->bind_result($count);
	$stmt->fetch();
	$stmt->close();
	
	/* Error check that ensures duplicate individuals don't get added to the roster  */
	if(!$count)
	{
		$query = "INSERT INTO `roster` VALUES ( '', ?, ?, ?, ?, ?, ? );";
		$stmt = $con->prepare($query);
		$stmt->bind_param("ssssss", $lname, $fname, $sex, $dob, $level, $proglang);
		$stmt->execute();
		$stmt->close();

		echo "
    <h1>Add User Complete</h1>
    <p>The following user has been successfully added:</p>
    <ul>
      <li>First Name: $fname</li>
      <li>Last Name: $lname</li>
      <li>Sex: $sex</li>
      <li>Date of Birth: $dob</li>
      <li>Level: $level</li>
      <li>Favorite Programming Language: $proglang</li>
    </ul>";
	}
	else
	{
		/* This is a basic error message, telling the user why their request couldn't be processed */
		echo "
    <h1>Duplicate Entry</h1>
    <p>This person is already on the roster.</p>\n";
	}
}
else
{
	/* Another basic error message */
	echo "
    <h1>Error</h1>
    <p>Please fill all the fields</p>\n";
}
$con->close();
?>
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add another student</a></li>
      <li><a href="roster_view.php">View roster</a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php?logout">Logout</a></li>
    </ul>
  </body>
</html>