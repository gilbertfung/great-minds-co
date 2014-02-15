<?php
require 'view/header.php';
?>
<div id="cover">
<h2>Person's Name</h2>
	<article id="cover-info">
		<div class="flex">
			<div class="side"><img src="//" width="320" height="240"></div>
			<div class="section">This is a bio.
			<div class="follow-button">
				<button name="follow" class="follow">Follow</button>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.follow-button').on('click', 'button', function() {
					$.ajax({
						type: "POST",
						url: "process.php?follow=12345",
						success: function() {
							$('.follow-button button').css('background-color', '#a8eff0').text("Followed!");
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
<?php
require 'view/footer.php';
?>

<?php
	require_once 'functions.php';

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
	}
?>
<section class="content">
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
</section>
<?php
	require 'view/footer.php';
?>