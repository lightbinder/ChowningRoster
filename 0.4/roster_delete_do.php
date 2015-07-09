<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

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
    <p><a href="roster_view.php" class="btn btn-primary">View Roster</a></p>

<?php require_once("includes/footer.php"); ?>