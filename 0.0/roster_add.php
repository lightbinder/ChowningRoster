<html>
  <head>
    <title>ChowningRoster 0.0 - Add Student to Roster</title>
  </head>
  
  <body>
    
    <h1>Add Student to Roster</h1>
    <form action="roster_add_do.php" method="get">
      First Name: <input type="text" name="fname" /><br />
      Last Name: <input type="text" name="lname" /><br />
      Sex:
      <select name="sex">
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Alien">Alien</option>
      </select><br />
      Date of Birth: 
      <select name="dob_month">
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
      <select name="dob_day">
<?php
for($x = 1; $x < 32; $x++)
{
	echo "        <option value=\"$x\">$x</option>\n";
}
?>
      </select>
      <select name="dob_year">
<?php
$x = date("Y");
$y = $x - 100;
for($x; $x > $y; $x--)
{
	echo "        <option value=\"$x\">$x</option>\n";
}
?>
      </select><br />
      Level:
      <select name="level">
        <option value="MS-1">MS-1</option>
        <option value="MS-2">MS-2</option>
        <option value="MS-3">MS-3</option>
        <option value="MS-4">MS-4</option>
        <option value="PGY-1">PGY-1</option>
        <option value="PGY-2">PGY-2</option>
        <option value="PGY-3">PGY-3</option>
        <option value="PGY-4">PGY-4</option>
        <option value="Fellow">Fellow</option>
        <option value="Attending">Attending</option>      
      </select><br />
      Favorite Programming Language:
      <select name="proglang">
        <option value="Assembly">Assembly</option>
        <option value="C">C</option>
        <option value="C++">C++</option>
        <option value="Java">Java</option>
        <option value="Javascript">Javascript</option>
        <option value="MUMPS">MUMPS</option>
        <option value="PHP">PHP</option>
        <option value="Python">Python</option> 
        <option value="SQL">SQL</option>
     </select><br />
      <input type="submit" value="Submit" />
    </form>

  </body>
</html>