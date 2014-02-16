<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php require_once 'includes/layouts/header.php'; ?>
<?php
	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
		$_SESSION['message'] = "Sign in to follow people and promote their ideas.";
		redirect_to("ideas.php");
	}
?>
<div id="cover">
	<h2>Your Dashboard</h2>
	<section class="content" class="flex">
		<h3>Your Projects <span class="action"><a href="create.php">Create a new Idea</a></span></h3>
		<?php 
			$user_id = $_SESSION['user_id'];
			$query = "SELECT * "
					."FROM project "
					."WHERE user_id = $user_id";
			$result = mysqli_query($db, $query);
			if (!$result) { die("Database query failed."); }
		?>
		<div id="follows" class="tile">
			<h3><a href="project.php">Idea name</a></h3>
			<p>by <a href="profile.php">John</a>, <a href="profile.php">Alice</a></p>
			<div class="promote-button">
				<button name="promote" class="promote">Promote</button>
			</div>
		</div>
	</section>
	<section class="content" class="flex">
		<h3>Your Ideas</h3>
		<?php 
			$query = "SELECT * "
					."FROM user ";
			$result = mysqli_query($db, $query);
			if (!$result) { die("Database query failed."); }
		?>
		<div id="follows" class="tile">
			<h3><a href="project.php">Idea name</a></h3>
			<p>by <a href="profile.php">John</a>, <a href="profile.php">Alice</a></p>
			<div class="promote-button">
				<button name="promote" class="promote">Promote</button>
			</div>
		</div>
	</section>
	<section class="content" class="flex">
		<h3>Your Follows</h3>
		<?php 
			$query = "SELECT * "
					."FROM user ";
			$result = mysqli_query($db, $query);
			if (!$result) { die("Database query failed."); }
		?>
		<div id="follows" class="tile">
			<h3><a href="project.php">Idea name</a></h3>
			<p>by <a href="profile.php">John</a>, <a href="profile.php">Alice</a></p>
			<div class="promote-button">
				<button name="promote" class="promote">Promote</button>
			</div>
		</div>
	</section>
	<section class="content" class="flex">
		<h3>Your Promotes</h3>
		<?php 
			$query = "SELECT * "
					."FROM idea ";
			$result = mysqli_query($db, $query);
			if (!$result) { die("Database query failed."); }
		?>
		<div id="promotes" class="tile">
			<h3><a href="project.php">Idea name</a></h3>
			<p>by <a href="profile.php">John</a>, <a href="profile.php">Alice</a></p>
			<div class="promote-button">
				<button name="promote" class="promote">Promote</button>
			</div>
		</div>
	</section>
</div>
</section> <!--#topic-->
<?php require 'includes/layouts/footer.php'; ?>