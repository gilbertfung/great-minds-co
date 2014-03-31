<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/apiconfig.php'; ?>
<?php require_once 'includes/functions/functions.php'; ?>
<?php require_once 'includes/functions/user.php'; ?>
<?php require_once 'includes/functions/entity.php'; ?>
<?php require_once 'includes/functions/ajax.php'; ?><?php require_once 'includes/layouts/header.php'; ?>
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
<section class="content flex">
	<div class="bar flex">
		<div class="side"><img src="//" width="320" height="240"></div>
		<div class="section">
			<p><?php 
				if (empty($user['bio'])) {
					echo "This person didn't write a bio.";
				} else {
					echo $user['bio']; 
				}?>
			</p>
			<?php echo follow_button($user) ?>
			<!-- <div id='error'></div> -->
			<table>
				<tr>
					<th>Industry</th>
					<th>Location</th>
					<th>Website</th>
					<th>Contact me...</th>
				</tr>
				<tr>
					<td><?php echo $user['industry']; ?></td>
					<td><?php echo $user['location']; ?></td>
					<td><?php echo $user['website']; ?></td>
					<td><?php echo $user['contact_pref']; ?></td>
				</tr>
			</table>
		</div>	
	</div>
	<div class="bar flex">
		<?php if (is_ideamaker($user['user_id']) == true) {
		echo '<h3>'.$user['name'].'\'s Projects <span class="action"></span></h3>';
		$projects = find_projects_by_user_id($_SESSION['user_id']);

		while ($project = mysqli_fetch_assoc($projects)) {
			echo '<div id="project-'.$project["idea_id"].'" class="tile" style="background:#'.randcol().'">';
				echo '<h3><a href="project.php?id='.$project["idea_id"].'">'.$project["title"].'</a></h3>';
				echo '<p>by <a href="profile.php">John</a>, <a href="profile.php">Alice</a></p>';
				echo promote_button($project);
			echo '</div>'; 
			}
		} else {
			// don't show anything
		}
		?>
	</div>
	<div class="bar flex">
		<h3><?php echo $user['name']; ?>'s Ideas <span class="action"><a href="create.php">Create a new Idea</a></span></h3>
		<?php 
			$ideas = find_ideas_by_user_id($user['user_id']);

			while ($idea = mysqli_fetch_assoc($ideas)) {
				echo '<div id="idea-'.$idea["idea_id"].'" class="tile" style="background:#'.randcol().'">';
					echo '<h3><a href="project.php?id='.$idea["idea_id"].'">'.$idea["title"].'</a></h3>';
					echo promote_button($idea);
				echo '</div>'; 
			}
		?>
	</div>
	<div class="bar flex">
		<h3><?php echo $user['name']; ?>'s Follows</h3>
		<?php 
			$follows = find_follows_by_user_id($user['user_id']);
			while ($auser = mysqli_fetch_assoc($follows)) {
				echo '<div id="follow-'.$auser["user_id"].'" class="tile" style="background:#'.randcol().'">';
					echo '<h3><a href="profile.php?id='.$auser["user_id"].'">'.$auser["name"].'</a></h3>';
					echo follow_button($auser);
				echo '</div>'; 
			}
		?>
	</div>
	<div class="bar flex">
		<h3><?php echo $user['name']; ?>'s Promotes</h3>
		<?php 
			$promotes = find_promotes_by_user_id($user['user_id']);
			while ($idea = mysqli_fetch_assoc($promotes)) {
				echo '<div id="promote-'.$idea["idea_id"].'" class="tile" style="background:#'.randcol().'">';
					echo '<h3><a href="project.php?id='.$idea["idea_id"].'">'.$idea["title"].'</a></h3>';
					echo promote_button($idea);
				echo '</div>'; 
			}
		?>
	</div>
</section>
<aside class="flex">
	<?php if (!empty($user['twitter_userid'])) { ?>
	<div class="bar">
		<h3><?php echo $user['name']; ?>'s Tweets</h3>
		<ul id="flickrphotos" class="flex">
		<?php 
			$username = find_user_by_id($user['user_id']);
			$tweets = get_latest_tweets($username['twitter_userid']);
			foreach ($tweets as $tweet) {
				if (!empty($tweet['text'])) {
					echo '<li class="tile" style="background:#'.randcol().'">';
						echo $tweet['text'];
						echo '<p><a href="http://twitter.com/'.$tweet['user']['id_str'].'/status/'.$tweet['id_str'].'">';
						echo 'View this Tweet</a></p>';
					echo '</li>'; 
				}
			}
		?>
		</ul>
	</div>
	<?php } ?>
	<?php if (!empty($user['flickr_userid'])) { ?>
	<div class="bar">
		<h3><?php echo $user['name']; ?>'s Flickr Photostream</h3>
		<ul class="flex">
		<?php 
			$username = find_user_by_id($user['user_id']);
			$photos = get_latest_photos($username['flickr_userid']);
			foreach ($photos['photo'] as $photo) {
				echo '<a href="'.$f->buildPhotoURL($photo).'">';
					echo '<li class="tile" style="background-image:url('.$f->buildPhotoURL($photo, 'medium').')">';
						// echo '<img style="background:url('.$f->buildPhotoURL($photo, 'small').')">';
					echo '</li>'; 
				echo '</a>';
			}
		?>
		</ul>
	</div>
	<?php } ?>
</aside>

</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>

<?php
/*
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
*/
?>