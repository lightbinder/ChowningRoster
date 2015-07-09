<!-- Set up of this file is similar to view_roster.php -->
<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php
/* Grabs submitted student information from header */
$action = $_GET['submit'];
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

/* Checks if the form has been submitted */
	/* This is necessary since the action for the form (PHP script) has been moved to the same file */
if($action == "Submit")
{
	/* This if statement is an error check that prevents blank submissions */
	if($fname && $lname && $sex && $dob && $level && $proglang)
	{
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
	
			/* Displays the add_success modal upon addition of student to roster */
			echo "
        <!-- Modal Script -->
        <script>
          $(document).ready(function() {
            $('#add_success').modal('toggle');
          });
        </script>\n\n";
		}
		
		/* This displays the duplicate modal if the person entered was already present */
		else
		{
			echo "
        <!-- Modal Script -->
        <script>
          $(document).ready(function() {
            $('#add_duplicate').modal('toggle');
          });
        </script>\n\n";
		}
	}
	
	/* Modal that informs user to fill all fields */
	else
	{
		echo "
        <!-- Modal Script -->
        <script>
          $(document).ready(function() {
            $('#add_field_error').modal('toggle');
          });
        </script>\n\n";
	}
	$con->close();
}
?>

    <!-- Modal Section -->

      <!-- Add Success Modal -->
        <!-- Displays user information that was just added -->
      <div class="modal fade" id="add_success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Add Student Complete</h4>
            </div>
            <div class="modal-body">
              <p>The following user has been successfully added:</p>
              <ul>
                <li>First Name: <?php echo $fname; ?></li>
                <li>Last Name: <?php echo $lname; ?></li>
                <li>Sex: <?php echo $sex; ?></li>
                <li>Date of Birth: <?php echo $dob; ?></li>
                <li>Level: <?php echo $level; ?></li>
                <li>Favorite Programming Language: <?php echo $proglang; ?></li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Duplicate Person Modal -->
        <!-- Displays duplicate person entry error -->
      <div class="modal fade" id="add_duplicate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Error:</h4>
            </div>
            <div class="modal-body">
              <p>This person is already on the roster.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Unfilled Fields Error Modal -->
        <!-- Displays error that user has not filled all fields -->
      <div class="modal fade" id="add_field_error" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Error:</h4>
            </div>
            <div class="modal-body">
              <p>Please fill all the fields.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>


      <!-- Add Student to Roster Form -->
      <h1>Add Student to Roster</h1>
      <form action="roster_add.php" method="get" role="form">
        <div class="form-group">
          <label for="fname">First Name:</label>
          <input id="fname" class="form-control"  type="text" name="fname" pattern="[a-zA-Z0-9]{2,64}" required />
        </div>
        <div class="form-group">
          <label for="lname">Last Name:</label>
          <input id="lname" class="form-control" type="text" name="lname" pattern="[a-zA-Z0-9]{2,64}" required />
        </div>
        <div class="form-group">
          
          <!-- Note that labels have been added for bootstrap -->
          <label for="sex">Sex:</label>
          
          <!-- form-control has been added to select and input fields on this page to take advantage of bootstrap -->
          <select id="sex" class="form-control" name="sex">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Alien">Alien</option>
          </select>
        </div>
        <div class="form-group">
          <!-- Rows here added for formatting -->
          <label class="control-label">Date of Birth:</label>
          <div class="row">
            <!-- Use of bootstraps column systems -->
              <!-- Bootstrap creates 12 columns on the screen -->
              <!-- An xs (extra small) column will not respond to the sceen size -->
            <div class="col-xs-4">
              <select class="form-control" name="dob_month">
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
              </select>
            </div>
            <div class="col-xs-4">
              <select class="form-control" name="dob_day">
<?php
for($x = 1; $x < 32; $x++)
{
	echo "              <option value=\"$x\">$x</option>\n";
}
?>
              </select>
            </div>
            <div class="col-xs-4">
              <select class="form-control" name="dob_year">
<?php
$x = date("Y");
$y = $x - 100;
for($x; $x > $y; $x--)
{
	echo "              <option value=\"$x\">$x</option>\n";
}
?>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="level">Level:</label>
          <select id="level" class="form-control" name="level">
<?php

/* Checks to see if the file... exists O.O */
if(file_exists("level.txt"))
{
	/* File is read normally if it exists */
	$level_file = fopen("level.txt", "r");
	while($line = fgets($level_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "            <option value=\"$line\">$line</option>\n";
	}
	fclose($level_file);
}
else
{
	/* Only one option with an error is printed if the file doesn't exist */
	echo "            <option>Error: no file found, can't generate list</option>";
}
?>
          </select>
        </div>
        <div class="form-group">
          <label for="proglang">Favorite Programming Language:</label>
          <select id="proglang" class="form-control" name="proglang">
<?php

/* This is similar to the setup for the level.txt file */
if(file_exists("proglang.txt"))
{
	$proglang_file = fopen("proglang.txt", "r");
	while($line = fgets($proglang_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "            <option value=\"$line\">$line</option>\n";
	}
	fclose($proglang_file);
}
else
{
	echo "            <option>Error: no file found, can't generate list</option>\n";
}
?>
          </select>
        </div>
        <div class="form-group">
          <input class="btn btn-default" type="submit" name="submit" value="Submit" />
        </div>
      </form>
      
<?php require_once("includes/footer.php"); ?>