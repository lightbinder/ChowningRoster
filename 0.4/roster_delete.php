<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

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
    <p><?php echo "<a href=\"roster_delete_do.php?rid=$rid\" class=\"btn btn-danger\">"; ?>Yes, go ahead</a></p>
    <p><a href="roster_view.php" class="btn btn-success">No, go back</a></p>

<?php require_once("includes/footer.php"); ?>