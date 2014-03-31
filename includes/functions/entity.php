<?php 
// IS PROJECT STATUS
	function is_project($idea_id) {
		global $db;
		$idea_id = mysqli_real_escape_string($db, $idea_id);
		
		$query = "SELECT * "
				."FROM idea i, project p "
				."WHERE i.idea_id = p.idea_id "
				."AND i.idea_id = {$idea_id} "
				."LIMIT 1";
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		if ($idea = mysqli_fetch_assoc($result)) {
			return $idea;
		} else {
			return null;
		}
	}

	function is_project_owner($idea_id, $user_id) {
		global $db;
		
		$query = "SELECT * "
				."FROM ideamaker_project "
				."WHERE ideamaker_project.idea_id = {$idea_id} "
				."AND ideamaker_project.user_id = {$user_id} "
				."LIMIT 1";
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		if ($idea = mysqli_fetch_assoc($result)) {
			return $idea;
		} else {
			return null;
		}
	}

// FINDING PROJECTS
	function find_projects_by_user_id($user_id) {
		global $db;
		$user_id = mysqli_real_escape_string($db, $user_id);
		
		$query = "SELECT * "
				."FROM idea i, ideamaker_project ip, project p "
				."WHERE ip.user_id = {$user_id} "
				."AND i.idea_id = ip.idea_id "
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

	function find_all_ideas_only() {
		global $db;
		
		$query = "SELECT * "
				."FROM idea, thought "
				."WHERE idea.idea_id = thought.idea_id "
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
	}

	function find_all_projects_only() {
		global $db;
		
		$query = "SELECT * "
				."FROM idea, project "
				."WHERE idea.idea_id = project.idea_id "
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

// FINDING UPDATES
	function find_all_updates_by_project($idea_id) {
		global $db;
		
		$query = "SELECT DISTINCT `update`.update_id, `update`.update_name, `update`.date_created, `update`.content "
				."FROM `update`, project_update, project "
				."WHERE project_update.idea_id = project.idea_id "
				."AND project_update.idea_id = {$idea_id} "
		;
		$result = mysqli_query($db, $query);
		if (!$result) { die("Database query failed."); }
		return $result;
	}
	
?>