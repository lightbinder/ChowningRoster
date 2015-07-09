<?php require_once("includes/header-require_login.php"); ?>

<?php
$rid = $_GET['rid'];

require_once("includes/db.php");
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

$query = "DELETE FROM `roster` WHERE rid=?;";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $rid);
$stmt->execute();
$stmt->close();

$con->close();
?>

    <h1>Delete Student Complete</h1>
    <p>The student has been deleted!</p>
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add a student</a></li>
      <li><a href="roster_view.php">View roster</a></li>
      <li><a href="index.php">Home</a></li>
      <li><a href="index.php?logout">Logout</a></li>
    </ul>

<?php require_once("includes/footer.php"); ?>