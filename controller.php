<?php
	require 'view/header.php';

	if (isset($_GET['action'])) {
		$action = $_GET['action'];
		switch ($action) {
			case 'login':
				require 'view/login.php';
				break;

			case 'register':
				require 'view/register.php';
				break;

			case 'accountCreated':
				//require 'view/accountCreated.php';
				require 'view/main.php';
				break;
			
			default:
				require 'view/main.php';
				break;
		} 
	} else {
		require 'view/main.php';
	}

	require 'view/footer.php';
?>