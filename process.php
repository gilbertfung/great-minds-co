<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions/functions.php'; ?>
<?php require_once 'includes/functions/user.php'; ?>
<?php require_once 'includes/functions/entity.php'; ?>
<?php require_once 'includes/functions/ajax.php'; ?><?php
	// FOLLOWING FEATURES
	$user_id = $_SESSION['user_id'];

	if (isset($_GET['follow'])) {
		// add this person to current user's following list
		$following_user_id = $_GET['follow'];
		follow(true, $user_id, $following_user_id);

		/*$query = "INSERT INTO user_follows VALUES (?, ?)"; 
		$stmt = mysqli_prepare($db, $query);
		// if (!$stmt) {echo('<div id="err">mysqli error: '.mysqli_error($db).'</div>');};
		mysqli_stmt_bind_param($stmt, 'ii', $user_id, $following_user_id);
		// if (!mysqli_stmt_execute($stmt)) {echo '<div id="err">stmt error: '.mysqli_stmt_error($stmt).'</div>';}
		$result = mysqli_stmt_execute($stmt);*/
	} else if (isset($_GET['unfollow'])) {
		// remove this person from current user's following list
		$following_user_id = $_GET['unfollow'];
		follow(false, $user_id, $following_user_id);

		/*$query = "DELETE FROM user_follows WHERE user_id = ? AND following_user_id = ? LIMIT 1"; 
		$stmt = mysqli_prepare($db, $query);
		// if (!$stmt) {echo('<div id="err">mysqli error: '.mysqli_error($db).'</div>');};
		mysqli_stmt_bind_param($stmt, 'ii', $user_id, $following_user_id);
		// if (!mysqli_stmt_execute($stmt)) {echo '<div id="err">stmt error: '.mysqli_stmt_error($stmt).'</div>';}
		$result = mysqli_stmt_execute($stmt);*/
	}

	// PROMOTING FEATURES
	else if (isset($_GET['promote'])) {
		$idea_id = $_GET['promote'];
		promote(true, $user_id, $idea_id);
	} else if (isset($_GET['unpromote'])) {
		$idea_id = $_GET['unpromote'];
		promote(false, $user_id, $idea_id);
	}
?>