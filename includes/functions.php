<?php 
	// GENERAL FUNCTIONS
	function redirect_to($url) {
		return header("Location: ".$url);
	}

	// HTTPS FUNCTIONS
	function requireSSL($boolean) {
		if ($boolean) {
			if(!isset($_SERVER["HTTPS"])) {
				header("Location: https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
				exit();
			}
		} else {
			// for when https isn't important
			if(isset($_SERVER["HTTPS"])) {
				header("Location: http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
				exit();
			}
		}
	}

	// LOGIN / REGISTRATION / AUTHENTICATION FUNCTIONS
	function login($email, $password) {
		$user = find_user_by_email($email);
		if ($user) {
			// user found
			if (password_verify($password, $user['password'])) {
				// password match
				return $user;
			} else {
				// password mismatch
				return false;
			}
		} else {
			// user not found
			return false;
		}
	}

	function register($post_array) {
		// $post_array is an associative array.
		global $db;
		$name = $post_array['name'];
		$email = $post_array['email'];
		$password = password_hash($post_array['password'], PASSWORD_BCRYPT);
		$location = $post_array['location'];
		$website = $post_array['website'];
		$industry = strtolower($post_array['industry']);
		$ind_years = $post_array['ind_years'];
		$bio = $post_array['bio'];
		$contact_pref = $post_array['contact_pref'];

		$stmt = mysqli_prepare($db, "INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if (!$stmt) die('mysqli error: '.mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'ssssssibs', $name, $email, $password, $location, $website, $industry, $ind_years, $bio, $contact_pref);
		if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
		mysqli_stmt_execute($stmt);

		// $query = "INSERT INTO user ( "
		// 		."name, email, password, location, website, industry, ind_years, bio, contact_pref"
		// 		.") VALUES ( "
		// 		."'{$name}', '{$email}', '{$password}', '{$location}', '{$website}', '{$industry}', {$ind_years}, '{$bio}', '{$contact_pref}'"
		// 		.")";
		// $result = mysqli_query($db, $query);
	}	

	function find_user_by_email($email) {
		global $db;
		$email = mysqli_real_escape_string($db, $email);

		$query = "SELECT * "
				."FROM user "
				."WHERE email = '{$email}' "
				."LIMIT 1";
		$result = mysqli_query($db, $query);

		if ($user = mysqli_fetch_assoc($result)) {
			return $user;
		} else {
			return null;
		}
	}

	function find_user_by_id($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM user "
				."WHERE user_id = {$user_id} "
				."LIMIT 1";
		$result = mysqli_query($db, $query);
		
		if ($user = mysqli_fetch_assoc($result)) {
			return $user;
		} else {
			return null;
		}
	}


	// reusable code to quickly load formatted content from databse
	function loadEntities()	{
		// insert PHP code that loads file content into the variable $content
		$file = 'users.txt';
		$contentString = file_get_contents($file);
		// format the content so that it can be placed in a table
		$content = explode("\n", $contentString); // explode into elements of entities

		$result = [];
		// $id = 0;
		foreach ($content as $entityString) {
			// extract data from each entity, and put it into an array within $content
			$entity = explode(" | ", $entityString);

			// NVM. insert an id to the array. text file solution, since every line is a separate entity
			// array_unshift($entity, $id);
			// $id += 1;
			array_push($result, $entity);
		}
		return $result;
	}

	// used for usort function
	function compare($a, $b) { 
		return ($a[1] < $b[1]) ? -1 : 1; 
	}

	// extract unique entities from the entire database
	function getUniqueGroup($entities, $index) {
		$uniqueResult = [];
		foreach ($entities as $entity) {
			$result = $entity[$index];
			array_push($uniqueResult, $result);
		}
		
		$uniqueResult = array_unique($uniqueResult); // remove all duplicate industries for placing in list
		sort($uniqueResult); // sort the industries by name

		return $uniqueResult;
	}
?>