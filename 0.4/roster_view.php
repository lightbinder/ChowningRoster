<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php
require_once("includes/db.php");
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

$query = "SELECT * FROM `roster`;";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($rid, $lname, $fname, $sex, $dob, $level, $proglang);
?>
      <h1>View Roster</h1>
      <!-- table (class): sets up the bootstrap table -->
      <!-- table-striped: alternates rows between white and light tan -->
      <table class="table table-striped">
        <tr>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Sex</th>
          <th>Date of Birth</th>
          <th>Level</th>
          <th>Favorite Programming Language</th>
          <th>Actions</th>
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
          <td>
            <a href=\"roster_modify.php?rid=$rid\">Modify</a><br />
            <a href=\"roster_delete.php?rid=$rid\">Delete</a>
          </td>
        </tr>\n";
}

$stmt->close();
$con->close();
?>
      </table>

<?php require_once("includes/footer.php"); ?>