<?php require_once("includes/header-require_login.php"); ?>

<?php
$rid = $_GET['rid'];

require_once("includes/db.php");
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

$query = "SELECT * FROM `roster` WHERE rid=?;";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $rid);
$stmt->execute();
$stmt->bind_result($rid, $lname, $fname, $sex, $dob, $level, $proglang);
$stmt->fetch();
$stmt->close();

$con->close();
?>

    <h1>Delete Student</h1>
    <p>Are you sure you'd like to delete the following student?</p>
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
	<p><?php echo "<a href=\"roster_delete_do.php?rid=$rid\">"; ?>Yes, go ahead</a></p>
    <p><a href="roster_view.php">No, go back</a></p>
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add a student</a></li>
      <li><a href="roster_view.php">View roster</a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php?logout">Logout</a></li>
    </ul>
  </body>
</html>