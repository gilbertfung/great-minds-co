<?php
	require 'view/header.php';

	$action = $_GET['action'];
	switch ($action) {
		case 'value':
			# code...
			break;
		
		default:
			echo "An action was made.";
			break;
	}
	require 'view/main.php';
	require 'view/footer.php';
?>