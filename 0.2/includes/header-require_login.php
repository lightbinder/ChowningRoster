<?php

/**
 * A simple, clean and secure PHP Login Script / MINIMAL VERSION
 * For more versions (one-file, advanced, framework-like) visit http://www.php-login.net
 *
 * Uses PHP SESSIONS, modern password-hashing and salting and gives the basic functions a proper login system needs.
 *
 * @author Panique
 * @link https://github.com/panique/php-login-minimal/
 * @license http://opensource.org/licenses/MIT MIT License
 */

// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("php-login/libraries/password_compatibility_library.php");
}

// include the configs / constants for the database connection
require_once("php-login/config/db.php");

// load the login class
require_once("php-login/classes/Login.php");

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();

// ... ask if we are logged in here:

/* If the user is not logged in, this code will redirect them back to the index page in logged out view */
	/* Prevents users from typing in a page without first logging in */
if ($login->isUserLoggedIn() == false) {
	/* header() */
		/* Sends a message to the HTTP headers */
		/* Location: redirects to the given file location */
	header("Location: index.php?logout");
}
?>

<html>
  <head>
    <title>Chowning Roster 0.2</title>
  </head>
  
  <body>