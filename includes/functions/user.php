<?php 
// LOGIN / REGISTRATION / AUTHENTICATION FUNCTIONS
	function login($email, $password) {
		$user = find_user_by_email($email);
		if ($user) {
			// user found
			if (password_verify($password, $user['password'])) { // built-in function
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
		$password = password_hash($post_array['password'], PASSWORD_BCRYPT); // built-in function
		$location = $post_array['location'];
		$website = $post_array['website'];
		$industry = strtolower($post_array['industry']);
		$ind_years = $post_array['ind_years'];
		$bio = $post_array['bio'];
		$contact_pref = $post_array['contact_pref'];
		$ideamaker = false;
		if (isset($post_array['ideamaker'])) {
			$ideamaker = $post_array['ideamaker'];
		}

		$stmt = mysqli_prepare($db, "INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, '', '')");
		// if (!$stmt) die('mysqli error: '.mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'ssssssiss', $name, $email, $password, $location, $website, $industry, $ind_years, $bio, $contact_pref);
		// if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
		mysqli_stmt_execute($stmt);

		$user = find_user_by_email($email);
		$user_id = $user['user_id'];

		if ($ideamaker == true) {
			// you're special, ideamaker.
			$stmt = mysqli_prepare($db, "INSERT INTO ideamaker VALUES (?)");
			// if (!$stmt) die('mysqli id error: '.mysqli_error($db)."<br>".print_r($user_id));
			mysqli_stmt_bind_param($stmt, 'i', $user_id);
			// if (!mysqli_stmt_execute($stmt)) die('stmt  iderror: '.mysqli_stmt_error($stmt));
			mysqli_stmt_execute($stmt);
		} else {
			// just a promoter
			$stmt = mysqli_prepare($db, "INSERT INTO promoter VALUES (?)");
			// if (!$stmt) die('mysqli pperror: '.mysqli_error($db));
			mysqli_stmt_bind_param($stmt, 'i', $user_id);
			// if (!mysqli_stmt_execute($stmt)) die('stmt pperror: '.mysqli_stmt_error($stmt));
			mysqli_stmt_execute($stmt);
		}

		// $query = "INSERT INTO user ( "
		// 		."name, email, password, location, website, industry, ind_years, bio, contact_pref"
		// 		.") VALUES ( "
		// 		."'{$name}', '{$email}', '{$password}', '{$location}', '{$website}', '{$industry}', {$ind_years}, '{$bio}', '{$contact_pref}'"
		// 		.")";
		// $result = mysqli_query($db, $query);
	}	

	function update_profile($post_array) {
		global $db;
		$email = $_SESSION['email'];
		$location = $post_array['location'];
		$website = $post_array['website'];
		$industry = strtolower($post_array['industry']);
		$ind_years = $post_array['ind_years'];
		$bio = $post_array['bio'];

		if (!empty($post_array['twitter_username'])) {
			$twitter_userid = get_twitter_id_by_username($post_array['twitter_username']);
		}
		if (!empty($post_array['flickr_username'])) {
			$flickr_userid = get_flickr_id_by_username($post_array['flickr_username']);
		}

		$stmt = mysqli_prepare($db, "UPDATE user SET location=?, website=?, industry=?, ind_years=?, bio=?, twitter_userid=?, flickr_userid=? WHERE email = ?");
		// if (!$stmt) die('mysqli error: '.mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'sssissss', $location, $website, $industry, $ind_years, $bio, $twitter_userid, $flickr_userid, $email);
		// if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
		mysqli_stmt_execute($stmt);
	}	

// IS USER STATUS
	function is_ideamaker($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM user u, ideamaker i "
				."WHERE u.user_id = i.user_id "
				."AND u.user_id = {$user_id} "
				."LIMIT 1";
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		if ($user = mysqli_fetch_assoc($result)) {
			return $user;
		} else {
			return null;
		}
	}

// FINDING USERS
	function find_user_by_email($email) {
		global $db;
		$email = mysqli_real_escape_string($db, $email);

		$query = "SELECT * "
				."FROM user "
				."WHERE email = '{$email}' "
				."LIMIT 1";
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
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
		if (!$result) { die("Database query failed."); }
		if ($user = mysqli_fetch_assoc($result)) {
			return $user;
		} else {
			return null;
		}
	}

	function find_all_users() {
		global $db;
		
		$query = "SELECT * "
				."FROM user " // are this user's ideas
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
	}

	function find_user_by_idea_id($idea_id) {
		global $db;
		$idea_id = mysqli_real_escape_string($db, $idea_id);
		
		$query; 
		if (is_project($idea_id)) {
			$query = "SELECT * "
					."FROM user u, ideamaker_project ip "
					."WHERE u.user_id = ip.user_id "
					."AND ip.idea_id = {$idea_id} "
			;
		} else {
			$query = "SELECT * "
					."FROM user u, user_thought ut "
					."WHERE u.user_id = ut.user_id "
					."AND ut.idea_id = {$idea_id} "
			;
		}
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		if ($user = mysqli_fetch_assoc($result)) {
			return $user;
		} else {
			return null;
		}
	}

?>