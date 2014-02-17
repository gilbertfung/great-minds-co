<?php 
	// GENERAL FUNCTIONS
	function redirect_to($url) {
		return header("Location: ".$url);
	}

	function randcol() {
		return dechex(rand(0xF8F8F8, 0xFFFFFF)); //printf("#%06X\n", mt_rand(0, 0xFFFFFF));
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
		$ideamaker = $post_array['ideamaker'];

		$stmt = mysqli_prepare($db, "INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if (!$stmt) die('mysqli error: '.mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'ssssssibs', $name, $email, $password, $location, $website, $industry, $ind_years, $bio, $contact_pref);
		if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
		mysqli_stmt_execute($stmt);

		$query = "SELECT user_id "
				."FROM user "
				."WHERE email = {$email}";
		$user_id = mysqli_query($db, $query);

		if ($ideamaker == true) {
			// you're special, ideamaker.
			$stmt = mysqli_prepare($db, "INSERT INTO ideamaker VALUES (?)");
			if (!$stmt) die('mysqli error: '.mysqli_error($db));
			mysqli_stmt_bind_param($stmt, 'i', $user_id);
			if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
			mysqli_stmt_execute($stmt);
		} else {
			// just a promoter
			$stmt = mysqli_prepare($db, "INSERT INTO ideamaker VALUES (?)");
			if (!$stmt) die('mysqli error: '.mysqli_error($db));
			mysqli_stmt_bind_param($stmt, 'i', $user_id);
			if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
			mysqli_stmt_execute($stmt);
		}

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

	function is_ideamaker($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM user "
				."INNER JOIN ideamaker "
					."ON user.user_id = ideamaker.user_id "
				."WHERE {$user_id} "
				."LIMIT 1";
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		if ($user = mysqli_fetch_assoc($result)) {
			return $user;
		} else {
			return null;
		}
	}

	// DISPLAY IDEAS OR PEOPLE
	function find_projects_by_user_id($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM idea i, ideamaker_project ip, project p "
				."WHERE ip.user_id = {$user_id} "
				."AND i.idea_id = ip.user_id "
				."AND i.idea_id = p.idea_id "
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
	}

	function find_ideas_by_user_id($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM idea i, user_thought ut, thought t "
				."WHERE ut.user_id = {$user_id} " // is from this user
				."AND i.idea_id = ut.idea_id "
				."AND i.idea_id = t.idea_id " // are this user's ideas
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
	}

	function find_all_ideas() {
		global $db;
		
		$query = "SELECT * "
				."FROM idea " // are this user's ideas
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
	}

	function find_idea_by_id($idea_id) {
		global $db;
		$idea_id = mysqli_real_escape_string($db, $idea_id);
		
		$query = "SELECT * "
				."FROM idea "
				."WHERE idea.idea_id = {$idea_id} ";
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		if ($idea = mysqli_fetch_assoc($result)) {
			return $idea;
		} else {
			return null;
		}
	}

	// FOLLOW AND PROMOTE FEATURES
	function find_follows_by_user_id($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM user u, user_follows uf "
				."WHERE u.user_id = {$user_id} " // is from this user
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
		if ($ideas = mysqli_fetch_assoc($result)) {
			return $ideas;
		} else {
			return null;
		}
	}

	function find_promotes_by_user_id($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM idea i, promotes p "
				."WHERE p.user_id = {$user_id} "
				."AND i.idea_id = p.idea_id"
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
		if ($ideas = mysqli_fetch_assoc($result)) {
			return $ideas;
		} else {
			return null;
		}
	}


	function follow_button($user) {
		global $db; 
		$string = '<div id="follow-'.$user["user_id"].'" class="follow-button">';
		$query = "SELECT following_user_id "
				."FROM user_follows "
				."WHERE user_id = ".$user["user_id"]; 
		$result = mysqli_query($db, $query);
		if ($row = mysqli_fetch_assoc($result)) {
			// hide follow
			$string .= '<button name="follow" class="follow" style="display:none">Follow</button>';
			$string .= '<button name="unfollow" class="unfollow">Following</button>';
		} else {
			// hide unfollow
			$string .= '<button name="follow" class="follow">Follow</button>';
			$string .= '<button name="unfollow" class="unfollow" style="display:none">Following</button>';
		}
		$string .= '</div>';

		$string .= '<script type="text/javascript">
			$(document).ready(function() {
				var item = "#follow-"+'.$user['user_id'].';
				$(item).children(".follow").click(function() {
					var dataString = "process.php?follow="+'.$user['user_id'].';
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {'
							// var $html = $(html);
							// $html.filter("#err").appendTo("#error");
							.'$(".follow").hide();
							$(".unfollow").show();
						}
					});
				});
				$(item).children(".unfollow").click(function() {
					var dataString = "process.php?unfollow="+'.$user["user_id"].';
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {'
							// var $html = $(html);
							// $html.filter('#err').appendTo('#error');
							.'$(".unfollow").hide();
							$(".follow").show();
						}
					});
				});
			});
		</script>';

		return $string;
	}

	function promote_button($idea) {
		global $db; 
		$string = '<div id="promote-'.$idea["idea_id"].'" class="promote-button">';
		$query = "SELECT user_id "
				."FROM promotes "
				."WHERE idea_id = ".$idea["idea_id"]; 
		$result = mysqli_query($db, $query);
		if ($row = mysqli_fetch_assoc($result)) {
			// hide promote
			$string .= '<button name="promote" class="promote" style="display:none">Promote</button>';
			$string .= '<button name="unpromote" class="unpromote">Promoted</button>';
		} else {
			// hide unpromote
			$string .= '<button name="promote" class="promote">Promote</button>';
			$string .= '<button name="unpromote" class="unpromote" style="display:none">Promoted</button>';
		}
		$string .= '</div>';

		$string .= '<script type="text/javascript">
			$(document).ready(function() {
				var item = "#promote-"+'.$idea['idea_id'].';
				$(item).children(".promote").click(function() {
					var dataString = "process.php?promote="+'.$idea['idea_id'].';
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {'
							// var $html = $(html);
							// $html.filter("#err").appendTo("#error");
							.'$(".promote").hide();
							$(".unpromote").show();
						}
					});
				});
				$(item).children(".unpromote").click(function() {
					var dataString = "process.php?unpromote="+'.$idea['idea_id'].';
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {'
							// var $html = $(html);
							// $html.filter('#err').appendTo('#error');
							.'$(".unpromote").hide();
							$(".promote").show();
						}
					});
				});
			});
		</script>';

		return $string;
	}

	function follow($boolean, $user_id, $following_user_id) {
		global $db;
		$query;
		if ($boolean) {
			$query = "INSERT INTO user_follows VALUES (?, ?)"; 
		} else {
			$query = "DELETE FROM user_follows WHERE user_id = ? AND following_user_id = ? LIMIT 1"; 
		}
		$stmt = mysqli_prepare($db, $query);
		// if (!$stmt) {echo('<div id="err">mysqli error: '.mysqli_error($db).'</div>');};
		mysqli_stmt_bind_param($stmt, 'ii', $user_id, $following_user_id);
		// if (!mysqli_stmt_execute($stmt)) {echo '<div id="err">stmt error: '.mysqli_stmt_error($stmt).'</div>';}
		$result = mysqli_stmt_execute($stmt);
	}

	function promote($boolean, $user_id, $idea_id) {
		global $db;
		$query;
		if ($boolean) {
			$query = "INSERT INTO promotes VALUES (?, ?)"; 
		} else {
			$query = "DELETE FROM promotes WHERE user_id = ? AND idea_id = ? LIMIT 1"; 
		}
		$stmt = mysqli_prepare($db, $query);
		// if (!$stmt) {echo('<div id="err">mysqli error: '.mysqli_error($db).'</div>');};
		mysqli_stmt_bind_param($stmt, 'ii', $user_id, $idea_id);
		// if (!mysqli_stmt_execute($stmt)) {echo '<div id="err">stmt error: '.mysqli_stmt_error($stmt).'</div>';}
		$result = mysqli_stmt_execute($stmt);
	}

/*
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
	}*/
?>