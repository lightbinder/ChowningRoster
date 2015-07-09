<?php require_once("includes/header-require_login.php"); ?>

<?php require_once("includes/menu.php"); ?>

<?php
/* This variable stores the rid of the individual clicked in the table below  */
$rid = $_GET['rid'];

/* This variable is used to determine which modal to display */
	/* It is acquired from the header after being sent from the Delete or Modify links in the table */
$action = $_GET['action'];

require_once("includes/db.php");
$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

/* This query is used to  */
$query = "SELECT * FROM `roster` WHERE rid=?;";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $rid);
$stmt->execute();
$stmt->bind_result($rid, $lname, $fname, $sex, $dob, $level, $proglang);
$stmt->fetch();
$stmt->close();

list($dob_year, $dob_month, $dob_day) = split('[/.-]', $dob);

/* Modal Conditions */
	/* These conditions use the $action variable to determine which modal to display */

/* Activates the delete modal if the "Delete" link is clicked in the table */
	/* Also checks the status of $rid as this variable is necessary for the modal to work (selecting proper row to delete) */
if($action == "delete" && $rid)
{
	echo "
      <!-- Modal Script -->
        <!-- This is jQuery that is used to toggle the appropriate modal -->
        <!-- Note the #delete_modal is the id of the modal (see Modal section) -->
      <script>
        $(document).ready(function() {
          $('#delete_modal').modal('toggle');
        });
      </script>\n\n";
}

/* Activated if confirmation of the deletion is sent from delete_modal (value of $action is changed) */
else if($action == "delete_success")
{
	/* This query actually does the deleting from the table, modal is then displayed */
	$query = "DELETE FROM `roster` WHERE rid=?;";
	$stmt = $con->prepare($query);
	$stmt->bind_param("s", $rid);
	$stmt->execute();
	$stmt->close();
	
	/* Modal is activated */
	echo "
      <!-- Modal Script -->
      <script>
        $(document).ready(function() {
          $('#delete_success_modal').modal('toggle');
        });
      </script>\n\n";

}

/* Activates modify modal if "Modify" link is clicked in table ($action variable is changed when link is clicked) */
	/* $rid is checked as this is necessary for the modal to work */
else if($action == "modify" && $rid)
{
	
	echo "
      <!-- Modal Script -->
      <script>
        $(document).ready(function() {
          $('#modify_modal').modal('toggle');
        });
      </script>\n\n";
}

/* Modifies the selected student information upon submission of the form and displays confirmation modal */
else if($action == "modify_success" && $rid)
{
	/* Pulls information from HTTP header from form submission in order to make the modification */
	$rid = $_GET['rid'];
	$fname = $_GET['fname'];
	$lname = $_GET['lname'];
	$sex = $_GET['sex'];
	$dob = $_GET['dob_year'] . "-" . $_GET['dob_month'] . "-" . $_GET['dob_day'];
	$level = $_GET['level'];
	$proglang = $_GET['proglang'];


	/* Performs the update */
	$query = "UPDATE `roster` SET lname=?, fname=?, sex=?, dob=?, level=?, proglang=? WHERE rid=?;";
	$stmt = $con->prepare($query);
	$stmt->bind_param("sssssss", $lname, $fname, $sex, $dob, $level, $proglang, $rid);
	$stmt->execute();
	$stmt->close();
	
	/* Displays the confirmation modal */
	echo "
      <!-- Modal Script -->
      <script>
        $(document).ready(function() {
          $('#modify_success_modal').modal('toggle');
        });
      </script>\n\n";
}

?>
    <!-- Modal Section -->
    
      <!-- Delete Modal -->
        <!-- Note that the code in this modal came directly from roster_delete.php in version 0.4 -->
        <!-- The first three divisions and their classes set up the modal and hide it until scripts above are activated -->
        <!-- The ID of the first division allows the jQuery to know which modal to activate (see scripts above) -->
      <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="ModifyModal" aria-hidden="true">
        
        <!-- modal-lg: class makes a large modal -->
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            
            <!-- Establishes the modal-header -->
            <div class="modal-header">
              
              <!-- This is the 'x' button that closes out the modal; &times; is an HTML construct that creates a multiplication sign for the 'x' button -->
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title">Delete Student</h4>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
              <p>Are you sure you'd like to delete the following student?</p>
              <ul>
                <li>First Name: <?php echo $fname; ?></li>
                <li>Last Name: <?php echo $lname; ?></li>
                <li>Sex: <?php echo $sex; ?></li>
                <li>Date of Birth: <?php echo $dob; ?></li>
                <li>Level: <?php echo $level; ?></li>
                <li>Favorite Programming Language: <?php echo $proglang; ?></li>
              </ul>
            </div>
            
            <!-- Modal footer containing action buttons -->
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">No, Go Back</button>
              <?php echo "<a href=\"?rid=$rid&action=delete_success\" class=\"btn btn-danger\">"; ?>Yes, Go Ahead</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Delete Success Modal -->
        <!-- Code from roster_delete_do.php in version 0.4 -->
      <div class="modal fade" id="delete_success_modal" tabindex="-1" role="dialog" aria-labelledby="DeleteSuccessModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title">Delete Student Complete</h4>
            </div>
            <div class="modal-body">
              <p>The student has been deleted!</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Modify Modal -->
        <!-- Code from roster_modify.php in version 0.4 -->
      <div class="modal fade" id="modify_modal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title">Modify Student</h4>
            </div>
            <div class="modal-body">
              <form action="roster_view.php" method="get" role="form">
                <?php echo "<input type=\"text\" name=\"action\" value=\"modify_success\" style=\"display:none;\" />\n"; ?>
                <?php echo "<input type=\"text\" name=\"rid\" value=\"$rid\" style=\"display:none;\" />\n"; ?>
                <div class="form-group">
                  <label for="fname">First Name:</label>
                  <?php echo "<input id=\"fname\" class=\"form-control\" type=\"text\" name=\"fname\" value=\"$fname\" />\n"; ?>
                </div>
                <div class="form-group">
                  <label for="lname">Last Name:</label>
                  <?php echo "<input id=\"lname\" class=\"form-control\" type=\"text\" name=\"lname\" value=\"$lname\" />\n"; ?>
                </div>
                <div class="form-group">
                  <label for="sex">Sex:</label>
                  <select id="sex" class="form-control" name="sex">
<?php
switch($sex)
{
	case "Male":
		echo "
                    <option value=\"Male\" selected>Male</option>
                    <option value=\"Female\">Female</option>
                    <option value=\"Alien\">Alien</option>\n";
		break;
	case "Female":
		echo "
                    <option value=\"Male\">Male</option>
                    <option value=\"Female\" selected>Female</option>
                    <option value=\"Alien\">Alien</option>\n";
		break;
	case "Alien":
		echo "
                    <option value=\"Male\">Male</option>
                    <option value=\"Female\">Female</option>
                    <option value=\"Alien\" selected>Alien</option>\n";
		break;
	default:
		echo "
                    <option value=\"Male\">Male</option>
                    <option value=\"Female\">Female</option>
                    <option value=\"Alien\">Alien</option>\n";
		break;
}
?>
                  </select>
                </div>
                
                <!-- Container and row used for appropriate formatting -->
                <div class="form-group">
                  <div class="container">
                    <div class="row">
                      <label>Date of Birth:</label>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">
                      <select class="form-control" name="dob_month">
<?php
$month_array = array(
	1 => "January", 
	2 => "February", 
	3 => "March", 
	4 => "April", 
	5 => "May", 
	6 => "June", 
	7 => "July", 
	8 => "August", 
	9 => "September", 
	10 => "October", 
	11 => "November", 
	12 => "December"
);

for($month_ctr = 1; $month_ctr < 13; $month_ctr++)
{
	echo "                        <option value=\"$month_ctr\"";
	if($dob_month == $month_ctr) echo " selected";
	echo ">$month_array[$month_ctr]</option>\n";
}
?>
                      </select>
                    </div>
                    <div class="col-xs-4">
                      <select class="form-control" name="dob_day">
<?php
for($day_ctr = 1; $day_ctr < 32; $day_ctr++)
{
	echo "                        <option value=\"$day_ctr\"";
	if($dob_day == $day_ctr) echo " selected";
	echo ">$day_ctr</option>\n";
}
?>
                      </select>
                    </div>
                    <div class="col-xs-4">
                      <select class="form-control" name="dob_year">
<?php
$year_ctr = date("Y");
$year_last = $year_ctr - 100;
for($year_ctr; $year_ctr > $year_last; $year_ctr--)
{
	echo "                        <option value=\"$year_ctr\"";
	if($dob_year == $year_ctr) echo " selected";
	echo ">$year_ctr</option>\n";
}
?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="level">Level:</label>
                  <select id="proglang" class="form-control" name="level">
<?php

/* File error checking */
if(file_exists("level.txt"))
{
	$level_file = fopen("level.txt","r");
	while($line = fgets($level_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "                  <option value=\"$line\"";
		if($level == $line) echo " selected";
		echo ">$line</option>\n";
	}
}
else
{
	echo "                    <option>Error: no file found, can't generate list</option>\n";
}
?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="proglang">Favorite Programming Language:</label>
                  <select id="proglang" class="form-control" name="proglang">
<?php

/* File error checking */
if(file_exists("proglang.txt"))
{
	$proglang_file = fopen("proglang.txt", "r");
	while($line = fgets($proglang_file))
	{
		$line = str_replace("\r\n", "", $line);
		echo "                  <option value=\"$line\"";
		if($proglang == $line) echo " selected";
		echo ">$line</option>\n";
	}
}
else
{
	echo "                    <option>Error: no file found, can't generate list</option>\n";
}
?>
                  </select>
                </div>
                <div class="form-group">
                  <input class="btn btn-primary" type="submit" value="Modify Student" />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modify Success Modal -->
        <!-- Code from roster_modify_do.php in version 0.4 -->
      <div class="modal fade" id="modify_success_modal" tabindex="-1" role="dialog" aria-labelledby="ModifyModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title">Modify Student Complete</h4>
            </div>
            <div class="modal-body">
              <p>The following student has been successfully modified:</p>
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
              <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Roster Table -->
      <h1>View Roster</h1>
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

/* Query that generates the table, placed after everything that new information from deletions or modifications are immediately shown */
$query = "SELECT * FROM `roster`;";
$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($rid, $lname, $fname, $sex, $dob, $level, $proglang);

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
            <a href=\"?rid=$rid&action=modify\">Modify</a><br />
            <a href=\"?rid=$rid&action=delete\">Delete</a>
          </td>
        </tr>\n";
}

$stmt->close();
$con->close();
?>
      </table>

<?php require_once("includes/footer.php"); ?>