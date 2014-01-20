<?php
	require 'view/header.php';

	require_once 'functions.php';

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$entities = loadEntities();
		// for each entity, 
		foreach ($entities as $key => $value) {
			# code...
		}
			// if id is the same as the one from GET, 
				// output its information in the profile page.
	} else {
		echo "No user ID specified. Who are you looking for?";
	}

	// $file = 'users.txt';
	// $content = file_get_contents($file);
	
	// $content = explode("\n", $content);
	// 	// iterate until the end of file
	// 	foreach ($content as $entity) {
	// 		$entity = explode(" | ", $entity);
	// 		foreach ($entity as $value) {
	// 			= $value
	// 		}
	// 		$userType = $entity[0];
	// 		$name = $entity[1];
	// 		$email = $entity[2];
	// 		$password = $entity[3];
	// 		$confirmPassword = $entity[4];
	// 		$location = $entity[5];
	// 		$website = $entity[6];
	// 		$bio = $entity[7];
	// 		$profileImage = $entity[8];
	// 		$industry = $entity[9];
	// 		$years = $entity[10];
	// 		$contactBy = $entity[11];

	// 		// print content of user
	// 		echo "<a href={$homepage}>{$name}</a>, {$team}, {$email}";
	// 	}
	require 'view/footer.php';
?>