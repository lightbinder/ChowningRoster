<?php
$db_host = "localhost";
$db_user = "chowningrosterdb";
$db_pass = "lAsw3KeLATKnZ4ZTBOxQLHvpXm99wezS";
$db_db = "chowningrosterdb";

$con = mysqli_connect($db_host, $db_user, $db_pass, $db_db);

/* SQL Query: SELECT */
	/* Selects values from specified columns ( * denotes all columns) */
	/* FROM `table_name`:  specifies which table the columns come from */
$query = "SELECT * FROM `roster`;";
$stmt = $con->prepare($query);
$stmt->execute();

/* bind_result */
	/* Lists the variables that will receive values from the select statement */
	/* Variables should be in order of all columns selected */
$stmt->bind_result($rid, $lname, $fname, $sex, $dob, $level, $proglang);
?>

<html>
  <head>
    <title>ChowningRoster 0.0 - View Roster</title>
  </head>
  <body>
    <h1>View Roster</h1>
    
    <!-- HTML Tables -->
      <!-- The border attribute is now replaced by CSS, which will be used in later versions -->
    <table border="1">
      
      <!-- Table row -->
      <tr>
        
        <!-- Table Headers: sets up table columns; all future rows need to have same number of columns -->
        <th>Last Name</th>
        <th>First Name</th>
        <th>Sex</th>
        <th>Date of Birth</th>
        <th>Level</th>
        <th>Favorite Programming Language</th>
      </tr>
<?php
/* while Loop */
	/* Like the for loop, but goes until a condition is false */
	/* Used when an unknown number of iterations are needed */
	/* In this case, goes until $stmt->fetch() retrieves no more rows in SQL table */

/* fetch() */
	/* Retrieves the results from previous $query and puts them in variables noted in bind_result() */
	/* The while loop keeps going through all rows returned by SELECT query */
while($stmt->fetch())
{
	/* Echo selected values from database into html table */
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

/* Close the prepared statement and the database connection */
$stmt->close();
$con->close();
?>
    
    <!-- Close the table outside the loop or the table will close each time a row is printed (creates havoc) -->
    </table>
    <h1>Actions</h1>
    <ul>
      <li><a href="roster_add.php">Add a student</a></li>
      <li><a href="index.php">Home</a></li>
    </ul>
  </body>
</html>