<?php
/* Acquires the rid of individual selected in roster_view.php */
$rid = $_GET['rid'];

require_once("includes/db.php");
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

/* Using the acquired HTTP variable rid (through $_GET) to SELECT data from database */
$query = "SELECT * FROM `roster` WHERE rid=?;";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $rid);
$stmt->execute();
$stmt->bind_result($rid, $lname, $fname, $sex, $dob, $level, $proglang);
$stmt->fetch();
$stmt->close();

$con->close();
?>
<html>
  <head>
    <title>ChowningRoster 0.1 - Delete Student</title>
  </head>
  <body>
    <h1>Delete Student</h1>
    <p>Are you sure you'd like to delete the following student?</p>
    <ul>
<?php

/* Printing out selected row's data for confirmation */
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
    
    <!-- Confirmation link -->
      <!-- Assigning $rid to HTTP variable for use in roster_delete_do.php -->
    <p><?php echo "<a href=\"roster_delete_do.php?rid=$rid\">"; ?>Yes, go ahead</a></p>
    
    <!-- Negatory link -->
    <p><a href="roster_view.php">No, go back</a></p>
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add a student</a></li>
      <li><a href="roster_view.php">View roster</a></li>
      <li><a href="index.php">Home</a></li>
    </ul>
  </body>
</html>