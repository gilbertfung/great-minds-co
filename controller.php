<?php
	require 'view/header.php';

	$action = $_GET['action'];
	switch ($action) {
		case 'login':
			require 'view/login.php';
			break;
		
		default:
			require 'view/main.php';
			break;
	}

	require 'view/footer.php';
?>