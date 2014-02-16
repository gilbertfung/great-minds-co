<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php require_once 'includes/layouts/header.php'; ?>
<?php requireSSL(false); 
	if (!isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == false) {
		$_SESSION['message'] = "Sign in to view your information.";
		redirect_to("login.php");
	}

	$user;
	if (isset($_GET['id'])) {
		if ($_GET['id'] == "you") {
			// looking at own profile
			$user_id = $_SESSION['user_id'];
		} else {
			// looking at someone's profile
			$user_id = $_GET['id'];
		}
		$user = find_user_by_id($user_id);
	} else {
		// looking at nobody's profile
		$_SESSION['message'] = "Who are you looking at?";
		redirect_to("index.php");
	}
?>
<div id="cover">
<h2><?php echo $user['name']; ?></h2>
<article id="cover-info">
	<div class="flex">
		<div class="side"><img src="//" width="320" height="240"></div>
		<div class="section">
			<p><?php 
				if (empty($user['bio'])) {
					echo "This person didn't write a bio.";
				} else {
					echo $user['bio']; 
				}?>
			</p>
			<?php echo '<div id="follow-'.$user["user_id"].'" class="follow-button">';
				$query = "SELECT following_user_id "
						."FROM user_follows "
						."WHERE user_id = ".$user["user_id"]; 
				$result = mysqli_query($db, $query);
				if ($row = mysqli_fetch_assoc($result)) {
					// hide follow
					echo '<button class="follow" name="follow" class="follow" style="display:none">Follow</button>';
					echo '<button class="unfollow" name="unfollow" class="follow">Following</button>';
				} else {
					// hide unfollow
					echo '<button class="follow" name="follow" class="follow">Follow</button>';
					echo '<button class="unfollow" name="unfollow" class="follow" style="display:none">Following</button>';
				}
			echo '</div>'; ?>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				var item = '#follow-'+<?php echo $user['user_id']; ?>;
				$(item).children('.follow').click(function() {
					var dataString = "process.php?follow="+<?php echo $user['user_id']; ?>;
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {
							// var $html = $(html);
							// $html.filter('#err').appendTo('#error');
							$('.follow').hide();
							$('.unfollow').show();
						}
					});
				});
				$(item).children('.unfollow').click(function() {
					var dataString = "process.php?unfollow="+<?php echo $user['user_id']; ?>;
					$.ajax({
						type: "POST",
						url: dataString,
						success: function(html) {
							// var $html = $(html);
							// $html.filter('#err').appendTo('#error');
							$('.unfollow').hide();
							$('.follow').show();
						}
					});
				});
			});
		</script>
		</div>
	</div>
</article>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>
<!-- <div id='error'></div> -->

<?php
	/*require_once 'functions.php';

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$entities = loadEntities();
		// for each entity, 
		foreach ($entities as $key => $entity) {
			// if id/key is the same as the one from GET, 
			if ($key == $id) {
				// output its information in the profile page.
				$name = $entity[1];
				$email = $entity[2];
				$location = $entity[5];
				$website = $entity[6];
				$profileImage = $entity[7];
				$bio = $entity[8];
				$industry = $entity[9];
				$years = $entity[10];
				if ($entity[11] == 'byEmail') {
					$contactBy = 'by email';
				} elseif ($entity[11] == 'byUrl') {
					$contactBy = 'through my website';
				}

				$profile = "
					<p>Right now I've been in the $industry industry for $years years.<br>
					I live in the $location area, and this is what I have to say:</p>
					<blockquote>$bio</blockquote>
					<p>Want to know more about me? Here's my website: <a href=\"$website\">$website</a><br>
					...But if you want to reach me, do it $contactBy. Thanks!</p>";
			}
		}
	} else {
		echo "No user ID specified. Who are you looking for?";
	}*/
?>
<!--<section class="content">
	<div id="hero">
		<?php 
			echo "<h1>Hey, I'm $name.</h1>";
		?>
	</div>
	<div id="profile-image">
		<img src="http://placekitten.com/200/200/">
	</div>
	<div id="profile-info">
		<?php
			echo $profile;
		?>
	</div>
	<div id="profile-projects">
		<h3>My Projects</h3>
	</div>
	<div id="profile-ideas">
		<h3>My Ideas</h3>
	</div>
</section>-->