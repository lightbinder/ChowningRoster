<?php
$rid = $_GET['rid'];
$fname = $_GET['fname'];
$lname = $_GET['lname'];
$sex = $_GET['sex'];
$dob = $_GET['dob_year'] . "-" . $_GET['dob_month'] . "-" . $_GET['dob_day'];
$level = $_GET['level'];
$proglang = $_GET['proglang'];

require_once("includes/db.php");
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

$query = "UPDATE `roster` SET lname=?, fname=?, sex=?, dob=?, level=?, proglang=? WHERE rid=?;";
$stmt = $con->prepare($query);
$stmt->bind_param("sssssss", $lname, $fname, $sex, $dob, $level, $proglang, $rid);
$stmt->execute();
$stmt->close();

$con->close();
?>
<html>
  <head>
    <title>ChowningRoster 0.1 - Modify Student Complete</title>
  </head>
  <body>
    <h1>Modify User Complete</h1>
    <p>The following user has been successfully modified:</p>
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
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add a student</a></li>
      <li><a href="roster_view.php">View roster</a></li>
      <li><a href="index.php">Home</a></li>
    </ul>
  </body>
</html>