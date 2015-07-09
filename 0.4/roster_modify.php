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

list($dob_year, $dob_month, $dob_day) = split('[/.-]', $dob);
?>

      <h1>Modify Student</h1>
      <form action="roster_modify_do.php" method="get" role="form">
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
        <div class="form-group">
          <label>Date of Birth:</label> 
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
	echo "            <option value=\"$month_ctr\"";
	if($dob_month == $month_ctr) echo " selected";
	echo ">$month_array[$month_ctr]</option>\n";
}
?>
          </select>
          <select class="form-control" name="dob_day">
<?php
for($day_ctr = 1; $day_ctr < 32; $day_ctr++)
{
	echo "            <option value=\"$day_ctr\"";
	if($dob_day == $day_ctr) echo " selected";
	echo ">$day_ctr</option>\n";
}
?>
          </select>
          <select class="form-control" name="dob_year">
<?php
$year_ctr = date("Y");
$year_last = $year_ctr - 100;
for($year_ctr; $year_ctr > $year_last; $year_ctr--)
{
	echo "            <option value=\"$year_ctr\"";
	if($dob_year == $year_ctr) echo " selected";
	echo ">$year_ctr</option>\n";
}
?>
          </select>
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
		echo "          <option value=\"$line\"";
		if($level == $line) echo " selected";
		echo ">$line</option>\n";
	}
}
else
{
	echo "            <option>Error: no file found, can't generate list</option>\n";
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
		echo "          <option value=\"$line\"";
		if($proglang == $line) echo " selected";
		echo ">$line</option>\n";
	}
}
else
{
	echo "            <option>Error: no file found, can't generate list</option>\n";
}
?>
          </select>
        </div>
        <div class="form-group">
          <input class="btn btn-default" type="submit" value="Submit" />
        </div>
      </form>

<?php require_once("includes/footer.php"); ?>