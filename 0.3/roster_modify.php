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

list($dob_year, $dob_month, $dob_day) = split('[/.-]', $dob);
?>
    
    <h1>Modify Student</h1>
    <form action="roster_modify_do.php" method="get">
      <?php echo "<input type=\"text\" name=\"rid\" value=\"$rid\" style=\"display:none;\" />\n"; ?>
      <?php echo "First Name: <input type=\"text\" name=\"fname\" value=\"$fname\" /><br />\n"; ?>
      <?php echo "Last Name: <input type=\"text\" name=\"lname\" value=\"$lname\" /><br />\n"; ?>
      Sex:
      <select name="sex">
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
      </select><br />
      Date of Birth: 
      <select name="dob_month">
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
	echo "        <option value=\"$month_ctr\"";
	if($dob_month == $month_ctr) echo " selected";
	echo ">$month_array[$month_ctr]</option>\n";
}
?>
      </select>
      <select name="dob_day">
<?php
for($day_ctr = 1; $day_ctr < 32; $day_ctr++)
{
	echo "        <option value=\"$day_ctr\"";
	if($dob_day == $day_ctr) echo " selected";
	echo ">$day_ctr</option>\n";
}
?>
      </select>
      <select name="dob_year">
<?php
$year_ctr = date("Y");
$year_last = $year_ctr - 100;
for($year_ctr; $year_ctr > $year_last; $year_ctr--)
{
	echo "        <option value=\"$year_ctr\"";
	if($dob_year == $year_ctr) echo " selected";
	echo ">$year_ctr</option>\n";
}
?>
      </select><br />
      Level:
      <select name="level">
<?php
$level_file = fopen("level.txt","r");
while($line = fgets($level_file))
{
	$line = str_replace("\r\n", "", $line);
	echo "        <option value=\"$line\"";
	if($level == $line) echo " selected";
	echo ">$line</option>\n";
}
fclose($level_file);
?>
      </select><br />
      Favorite Programming Language:
      <select name="proglang">
<?php
$proglang_file = fopen("proglang.txt", "r");
while($line = fgets($proglang_file))
{
	$line = str_replace("\r\n", "", $line);
	echo "        <option value=\"$line\"";
	if($proglang == $line) echo " selected";
	echo ">$line</option>\n";
}
fclose($proglang_file);
?>
     </select><br />
      <input type="submit" value="Submit" />
    </form>

    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add Student to Roster</a></li>
      <li><a href="roster_view.php">View Roster</a></li>
      <li><a href="index.php?logout">Logout</a></li>
    </ul>

<?php require_once("includes/footer.php"); ?>