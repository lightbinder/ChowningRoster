<?php
$db_host = "localhost";
$db_user = "chowningrosterdb";
$db_pass = "lAsw3KeLATKnZ4ZTBOxQLHvpXm99wezS";
$db_db = "chowningrosterdb";

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

$query = "SELECT * FROM `roster`;";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($rid, $lname, $fname, $sex, $dob, $level, $proglang);
?>

<html>
  <head>
    <title>ChowningRoster 0.0 - View Roster</title>
  </head>
  <body>
    <h1>View Roster</h1>
    <table border=1">
      <tr>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Sex</th>
        <th>Date of Birth</th>
        <th>Level</th>
        <th>Favorite Programming Language</th>
      </tr>
<?php
while($stmt->fetch())
{
	echo "
      <tr>
        <td>$lname</td>
        <td>$fname</td>
        <td>$sex</td>
        <td>$dob</td>
        <td>$level</td>
        <td>$proglang</td>
      </tr>
	";
}

$stmt->close();
$con->close();
?>
    </table>
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add a student</a></li>
      <li><a href="index.php">Home</a></li>
    </ul>
  </body>
</html>