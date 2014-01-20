<?php
	require 'view/header.php';
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
					<p>Want to know more about me? Here's my website: $website<br>
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

	</div>
	<div id="profile-ideas">
	</div>
</section>
<?php
	require 'view/footer.php';
?>