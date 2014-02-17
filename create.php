<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php requireSSL(true);

if (isset($_POST['submit'])) {
	// print_r($_POST);
	// process form
	$user_id = $_SESSION['user_id'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	$url = $_POST['url'];
	$industry = $_POST['industry'];
	// $tags = $_POST['tags'];
	$project = $_POST['project'];

	$query = "INSERT INTO idea VALUES (NULL, ?, ?, ?, NULL)"; // add to idea
	$stmt = mysqli_prepare($db, $query);
	mysqli_stmt_bind_param($stmt, 'sbs', $title, $content, $url);
	$result = mysqli_stmt_execute($stmt);

	$idea_id = mysqli_insert_id($db);
	print_r($idea_id);

	if ($project) {
		// add to project table
		$query = "INSERT INTO project VALUES (?)"; // associate idea to thoughts, so that it can be categorized as such
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, 'i', $idea_id);
		$result = mysqli_stmt_execute($stmt);

		$query = "INSERT INTO ideamaker_project VALUES (?, ?)"; // associate idea to this user 
		if (!$stmt) die('mysqli error: '.mysqli_error($db));
		$stmt = mysqli_prepare($db, $query);
				if (!$stmt) die('mysqli error: '.mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'ii', $user_id, $idea_id);
				if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
		$result = mysqli_stmt_execute($stmt);
	} else {
		$query = "INSERT INTO thought VALUES (?)"; // associate idea to thoughts, so that it can be categorized as such
		$stmt = mysqli_prepare($db, $query);
		mysqli_stmt_bind_param($stmt, 'i', $idea_id);
		$result = mysqli_stmt_execute($stmt);
		// if ( !mysqli_stmt_execute($stmt) ) { die('stmt error: '.mysqli_stmt_error($stmt)); } // there is an error, but works as intended...
		
		$query = "INSERT INTO user_thought VALUES (?, ?)"; // associate idea to this user 
		if (!$stmt) die('mysqli error: '.mysqli_error($db));
		$stmt = mysqli_prepare($db, $query);
				if (!$stmt) die('mysqli error: '.mysqli_error($db));
		mysqli_stmt_bind_param($stmt, 'ii', $user_id, $idea_id);
				if (!mysqli_stmt_execute($stmt)) die('stmt error: '.mysqli_stmt_error($stmt));
		$result = mysqli_stmt_execute($stmt);
	}
	// $query = "INSERT INTO idea_tag VALUES (idea_id, ?)" // associate idea to idea_tags, so that idea can be categorized with tags

	if ($result) {
		// Success
		$_SESSION["message"] = "Idea created.";
		redirect_to("profile.php?id=you");
	} else {
		// Failure
		$_SESSION["message"] = "Something went wrong when the idea was being submitted.";
		redirect_to("create.php");
	}
} else {

}
?>

<?php require 'includes/layouts/header.php'; ?>
<div id="cover">
	<h2>Post your Idea</h2>
	<form id="create" name="create" action="create.php" method="post">
		<h3>Jot it down:</h3>
		<fieldset>
			<input type="text" name="title" placeholder="Idea Title" required>
			<br>
			<textarea name="content" form="create" placeholder="What's your idea about?" rows="5"></textarea>
			<br>
			<input type="url" name="url" placeholder="http://visit-for-more.info">
			<br>
			<label>Project photo:</label>
			<input id="profile-image-input" type="file" name="profileImage">
			<br>
			<input type="text" name="industry" placeholder="Relevant Industry or Field">
			<br>
			<input type="text" name="tags" placeholder="Any tags you want to put here?" disabled>
			<br>
			<input type="checkbox" name="project" value="project">This is a project. <!--TODO advanced project creation via connecting users-->
			<input class="button" type="submit" name="submit" value="Post your idea">
		</fieldset>
	</form>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>