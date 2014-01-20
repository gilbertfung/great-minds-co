<?php
	require 'view/header.php';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
		switch ($action) {
			// Login page
			case 'login':
				require 'view/login.php';
				break;

			// Register page
			case 'register':
				require 'view/register.php';
				break;

			// Account created page
			case 'accountCreated':
				// if redirected from accountCreated, show a welcome message
				$heroText = "Hey, welcome to Great Minds, Co.";
				require 'view/main.php';
				break;
			
			// List by * page
			case 'list':

				require 'view/main.php';
				require 'view/list.php';
				break;

			// View profile page
			case 'viewProfile':
				require 'view/profile.php';
				break;

			// If no action or is index, go to main.
			default:
				require 'view/main.php';
				break;
		} 
	} else {
		// Show index if there is no action.
		require 'view/main.php';
	}

	require 'view/footer.php';
?>