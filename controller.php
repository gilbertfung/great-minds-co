<?php
if (isset($_GET['action'])) {
	$action = $_GET['action'];
	switch ($action) {
		case 'login': // Login page
			require 'view/login.php';
			break;

		
		case 'register': // Register page
			require 'view/register.php';
			break;

		
		case 'accountCreated': // Account created page
			// if redirected from accountCreated, show a welcome message
			$heroText = "Hey, welcome to Great Minds, Co.";
			require 'view/main.php';
			break;
		
		
		case 'list': // List by * page
			require 'view/main.php';
			require 'view/list.php';
			break;

		
		case 'viewProfile': // View profile page
			header('Location: profile.php');
			break;

		default: // If no action or is index, go to main.
			require 'view/main.php';
	} 
} else {
	// Show index if there is no action.
	require 'view/header.php';
	require 'view/main.php';
	require 'view/footer.php';
}
?>