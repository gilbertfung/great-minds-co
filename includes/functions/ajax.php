<?php 
// FOLLOW AND PROMOTE FEATURES
	function find_follows_by_user_id($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM user u, user_follows uf "
				."WHERE u.user_id = uf.following_user_id "
				."AND uf.user_id = {$user_id} " // is from this user
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
		if ($users = mysqli_fetch_assoc($result)) {
			return $users;
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

	function follow_button($user) { // target user
		$string = '<div class="follow-button">';
		if (!isset($_SESSION['user_id'])) {$_SESSION['user_id'] = 0;}
		$follows = find_follows_by_user_id($_SESSION['user_id']);
		$button_set = false;

		while ($initiator = mysqli_fetch_assoc($follows)) {
			if ($initiator['following_user_id'] == $user['user_id']) {
				// you are already following: hide follow
				$string .= '<button id="follow-'.$user["user_id"].'" name="follow" class="follow" style="display:none">Follow</button>';
				$string .= '<button id="unfollow-'.$user["user_id"].'" name="unfollow" class="unfollow">Following</button>';
				$button_set = true;
			}
		}

		if (!$button_set) { // button hasn't been set for this person
			// you are not following: hide unfollow
			$string .= '<button id="follow-'.$user["user_id"].'" name="follow" class="follow">Follow</button>';
			$string .= '<button id="unfollow-'.$user["user_id"].'" name="unfollow" class="unfollow" style="display:none">Following</button>';
		}

		$string .= '</div>';
		$string .= '<script type="text/javascript">
			$(document).ready(function() {
				var follow = "#follow-"+'.$user['user_id'].';
				var unfollow = "#unfollow-"+'.$user['user_id'].';
				$(follow).click(function() {
					var dataString = "process.php?follow="+'.$user['user_id'].';
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {
							//var $html = $(html);
							//$html.filter("#err").appendTo("#error");
							$(follow).hide();
							$(unfollow).show();
						}
					});
				});
				$(unfollow).click(function() {
					var dataString = "process.php?unfollow="+'.$user["user_id"].';
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {
							//var $html = $(html);
							//$html.filter("#err").appendTo("#error");
							$(unfollow).hide();
							$(follow).show();
						}
					});
				});
			});
		</script>';

		return $string;
	}

	function promote_button($idea) {
		$string = '<div class="promote-button">';
		if (!isset($_SESSION['user_id'])) {$_SESSION['user_id'] = 0;}
		$promotes = find_promotes_by_user_id($_SESSION['user_id']);
		$button_set = false;

		while ($initiator = mysqli_fetch_assoc($promotes)) {
			if ($initiator['idea_id'] == $idea['idea_id']) {
				// hide promote
				$string .= '<button id="promote-'.$idea["idea_id"].'" name="promote" class="promote" style="display:none">Promote</button>';
				$string .= '<button id="unpromote-'.$idea["idea_id"].'" name="unpromote" class="unpromote">Promoted</button>';
				$button_set = true;
			}
		} 

		if (!$button_set) {
			// hide unpromote
			$string .= '<button id="promote-'.$idea["idea_id"].'" name="promote" class="promote">Promote</button>';
			$string .= '<button id="unpromote-'.$idea["idea_id"].'" name="unpromote" class="unpromote" style="display:none">Promoted</button>';
		}

		$string .= '</div>';
		$string .= '<script type="text/javascript">
			$(document).ready(function() {
				var promote = "#promote-"+'.$idea['idea_id'].';
				var unpromote = "#unpromote-"+'.$idea['idea_id'].';
				$(promote).click(function() {
					var dataString = "process.php?promote="+'.$idea['idea_id'].';
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {
							// var $html = $(html);
							// $html.filter("#err").appendTo("#error");
							$(promote).hide();
							$(unpromote).show();
						}
					});
				});
				$(unpromote).click(function() {
					var dataString = "process.php?unpromote="+'.$idea['idea_id'].';
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {
							// var $html = $(html);
							// $html.filter("#err").appendTo("#error");
							$(unpromote).hide();
							$(promote).show();
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

// API FUNCTIONS
	function get_twitter_id_by_username($username) {
		global $cb; 

		// Create query
		$params = array(
			'screen_name' => $username
		);
			
		// Make the REST call
		$result = (array) $cb->users_show($params);
		// Convert results to an associative array
		$data = json_decode(json_encode($result), true);
		return $data['id_str'];
	}

	function get_flickr_id_by_username($username) {
		global $f;

		$f->people_findByUsername($username);
		return $f->parsed_response['user']['id'];
	}

	function get_username_by_twitter_id($id) {
		global $cb; 

		// Create query
		$params = array(
			'user_id' => $id
		);
			
		// Make the REST call
		$result = (array) $cb->users_show($params);
		// Convert results to an associative array
		$data = json_decode(json_encode($result), true);
		return $data['screen_name'];
	}

	function get_username_by_flickr_id($id) {
		global $f;

		$f->people_getInfo($id);
		return $f->parsed_response['person']['username'];
	}

	function get_latest_tweets($id) {
		global $cb; 

		// Create query
		$params = array(
			'user_id' => $id,
			'count' => 6
		);
			
		// Make the REST call
		$result = (array) $cb->statuses_userTimeline($params);
		// Convert results to an associative array
		$data = json_decode(json_encode($result), true);
		return $data;
	}

	function get_latest_photos($id) {
		global $f;

		$f->people_getPublicPhotos($id, NULL, NULL, 6, 1);
		return $f->parsed_response['photos'];
	}

?>