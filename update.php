<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions/functions.php'; ?>
<?php require_once 'includes/functions/user.php'; ?>
<?php require_once 'includes/functions/entity.php'; ?>
<?php require_once 'includes/functions/ajax.php'; ?><?php requireSSL(true);

if (isset($_POST['submit'])) {
	$user_id = $_SESSION['user_id'];
	$idea_id = $_SESSION['idea_id'];

	$update_name = $_POST['update_name'];
	$content = $_POST['content'];

	$query = "INSERT INTO `update` VALUES (NULL, ?, NULL, ?)"; // add to update
	$stmt = mysqli_prepare($db, $query);
	mysqli_stmt_bind_param($stmt, 'ss', $update_name, $content);
	$result = mysqli_stmt_execute($stmt);

	$update_id = mysqli_insert_id($db); // get the just-created id number
	print_r($update_id);

	$query = "INSERT INTO project_update VALUES (?, ?)"; // associate project to update
	$stmt = mysqli_prepare($db, $query);
	mysqli_stmt_bind_param($stmt, 'ii', $idea_id, $update_id);
	$result = mysqli_stmt_execute($stmt);

	$query = "INSERT INTO ideamaker_update VALUES (?, ?)"; // associate update to this user (so we know who authored this particular update)
	if (!$stmt) die('mysqli error: '.mysqli_error($db));
	$stmt = mysqli_prepare($db, $query);
			// if (!$stmt) die('mysqli error: '.mysqli_error($db));
	mysqli_stmt_bind_param($stmt, 'ii', $user_id, $update_id);
			// if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
	$result = mysqli_stmt_execute($stmt);

	if ($result) {
		// Success
		$_SESSION["message"] = "Idea created.";
		redirect_to("project.php?id=".$idea_id);
	} else {
		// Failure
		$_SESSION["message"] = "Something went wrong when the update was being submitted.";
		redirect_to("update.php");
	}
} else {

}
?>

<?php require 'includes/layouts/header.php'; ?>
<div id="cover">
	<h2>Post your Idea</h2>
	<form id="update" name="update" action="update.php" method="post">
		<h3>Jot it down:</h3>
		<fieldset>
			<input type="text" name="update_name" placeholder="Update Name" required>
			<br>
			<textarea name="content" form="update" placeholder="What's your update about?" rows="5"></textarea>
			<br>
			<input class="button" type="submit" name="submit" value="Post your update">
		</fieldset>
	</form>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>