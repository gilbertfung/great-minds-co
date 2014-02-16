<?php
define("DB_SERVER", "localhost");
define("DB_USER", "gilbertf");
define("DB_PASS", "gilbertf");
define("DB_NAME", "gilbertf");

$db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// test if connection succeeded
if(mysqli_connect_errno()) {
	// if failed, exit and print error
	die("Database connection failed: ".mysqli_connect_error()." (".mysqli_connect_errno().")");
}
?>