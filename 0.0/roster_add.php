<html>
  <head>
    <title>ChowningRoster 0.0 - Add Student to Roster</title>
  </head>
  
  <body>
    <h1>Add Student to Roster</h1>
    
    <!-- Form:  allows user to submit data -->
    <!-- action: indicates the script/program that will process user-submitted data -->
    <!-- method: hypertext transfer protocol (HTTP) method -->
      <!-- The HTTP provides two methods: get and post -->
        <!-- Get: displays HTTP variables in the url after a ? -->
          <!-- Example: http://www.mysite.com?variable=value -->
        <!-- Post: does NOT display HTTP variables -->
    <form action="roster_add_do.php" method="get">
    
       <!-- input: an element that allows user input -->
         <!-- type: attribute defines input style, "text" is a text box -->
         <!-- name: http variable name sent to url -->
         <!-- value: value/content of http variable, assigned by user in type="text" -->
         <!-- example using first input -->
           <!-- yoursite.com?fname=Tim -->
      First Name: <input type="text" name="fname" /><br />
      <!-- <br /> inserts a line break -->
      Last Name: <input type="text" name="lname" /><br />
      
      <!-- select: defines dropdown, has name for http variable name -->
        <!-- option: selectable item from dropdown, has value to assign to dropdown variable name -->
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
      
<!-- Interrupting dropdown menu with php to create options with script -->
<?php
/* PHP */
	/* Variables: a dollar sign and a name -> $your_favorite_name */

/* for Loop */
	/* Starts at initial value of variable used (in this case $x) */
	/* Goes until indicated condition is met ($x < 32) */
	/* Increment value per iteration of loop ($x++ adds 1 to $x each time */
	/* Executes internal command once for each iteration of the loop (31 times in this case to create 31 days of the month) */
for($x = 1; $x < 32; $x++)
{
	/* echo */
		/* Prints directly to the source code (HTML in this case) whatever follows */
		/* Variables used will have their values printed (note $x in the loop) */
	echo "        <option value=\"$x\">$x</option>\n";
}
?>
      </select>
      <select name="dob_year">
<?php
/* date() function grabs current date and returns (holds a value that can be passed to a variable) a value based on what is in the parentheses (an argument) ("Y" requests a four digit year) */ 
$x = date("Y");
$y = $x - 100;

/* This for loop goes backwards */
	/* The condition is reversed */
	/* $x-- subtracts 1 from $x each time */
	/* prints an option for each year to 100 years ago */
for($x; $x > $y; $x--)
{
	/* \n: a line feed character, begins a new line when printing text */
		/* This is for readability when looking at the source code from the browser */
	echo "        <option value=\"$x\">$x</option>\n";
}
?>
      </select><br />
      
      <!-- Another dropdown menu for level of individual -->
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
      
      <!-- Another dropdown menu for favorite programming language -->
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
      
      <!-- Ye Olde Submit Button: sends data entered into the form by the user to the HTTP header (url) -->
      <input type="submit" value="Submit" />
    </form>

  </body>
</html>