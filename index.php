<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions/functions.php'; ?>
<?php require_once 'includes/functions/user.php'; ?>
<?php require_once 'includes/functions/entity.php'; ?>
<?php require_once 'includes/functions/ajax.php'; ?><?php require_once 'includes/layouts/header.php'; ?>
<?php
	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
		$_SESSION['message'] = "Sign in to follow people and promote their ideas.";
		redirect_to("ideas.php");
	}
?>
<div id="cover">
	<h2>Your Dashboard</h2>
	<div class="bar flex">
	<?php if ($_SESSION['ideamaker'] == true) {
		echo '<h3>Your Projects <span class="action"></span></h3>';
		$projects = find_projects_by_user_id($_SESSION['user_id']);

		while ($project = mysqli_fetch_assoc($projects)) {
			$is_project = "";
			if (is_project($project['idea_id'])) {$is_project = "Project";}
			echo '<div id="project-'.$project["idea_id"].'" class="tile" style="background:#'.randcol().'">';
				echo '<h3><a href="project.php?id='.$project["idea_id"].'">'.$project["title"].'</a><span class="action">'.$is_project.'</span></h3>';
				// echo '<p>by <a href="profile.php">John</a>, <a href="profile.php">Alice</a></p>';
				echo promote_button($project);
			echo '</div>'; 
			}
		} else {
			// don't show anything
		}
		?>
	</div>
	<div class="bar flex">
		<h3>Your Ideas <span class="action"><a href="create.php">Create a new Idea</a></span></h3>
		<?php 
			$ideas = find_ideas_by_user_id($_SESSION['user_id']);

			while ($idea = mysqli_fetch_assoc($ideas)) {
				echo '<div id="idea-'.$idea["idea_id"].'" class="tile" style="background:#'.randcol().'">';
					echo '<h3><a href="project.php?id='.$idea["idea_id"].'">'.$idea["title"].'</a></h3>';
					echo promote_button($idea);
				echo '</div>'; 
			}
		?>
	</div>
	<div class="bar flex">
		<h3>Your Follows</h3>
		<?php 
			$follows = find_follows_by_user_id($_SESSION['user_id']);
			while ($user = mysqli_fetch_assoc($follows)) {
				echo '<div id="follow-'.$user["user_id"].'" class="tile" style="background:#'.randcol().'">';
					echo '<h3><a href="profile.php?id='.$user["user_id"].'">'.$user["name"].'</a></h3>';
					echo follow_button($user);
				echo '</div>'; 
			}
		?>
	</div>
	<div class="bar flex">
		<h3>Your Promotes</h3>
		<?php 
			$promotes = find_promotes_by_user_id($_SESSION['user_id']);
			while ($idea = mysqli_fetch_assoc($promotes)) {
				echo '<div id="promote-'.$idea["idea_id"].'" class="tile" style="background:#'.randcol().'">';
					echo '<h3><a href="project.php?id='.$idea["idea_id"].'">'.$idea["title"].'</a></h3>';
					echo promote_button($idea);
				echo '</div>'; 
			}
		?>
	</div>
</div>
</section> <!--#topic-->
<?php require 'includes/layouts/footer.php'; ?>