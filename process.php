<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/apiconfig.php'; ?>
<?php require_once 'includes/functions/functions.php'; ?>
<?php require_once 'includes/functions/user.php'; ?>
<?php require_once 'includes/functions/entity.php'; ?>
<?php require_once 'includes/functions/ajax.php'; ?>
<?php // FOLLOWING FEATURES
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

	// RETREIVE TWEETS
	if (isset($_GET['tweetsby'])) {
		$username = $_GET['tweetsby'];
		$latest_tweets = get_latest_tweets(get_twitter_id_by_username($username)); // associative array

		$d = new DomDocument('1.0', 'UTF-8');
		$d->preserveWhiteSpace = FALSE;
		$d->formatOutput = FALSE;

		$tweets = $d->createElement('tweets');
		foreach ($latest_tweets as $latest_tweet) {
			$tweet = $d->createElement('tweet');

				$id_str = $d->createElement('id_str', $latest_tweet['id_str']);
				$tweet->appendChild($id_str);
				
				$text = $d->createElement('text',$latest_tweet['text']);
				$tweet->appendChild($text);

				$user = $d->createElement('user');

					$id_str = $d->createElement('id_str', $latest_tweet['user']['id_str']);
					$user->appendChild($id_str);

					$screen_name = $d->createElement('screen_name', $latest_tweet['user']['screen_name']);
					$user->appendChild($screen_name);

				$tweet->appendChild($user);

			$tweets->appendChild($tweet);
		}
		$d->appendChild($tweets);
		// $d->saveXML();

		$outXML = $d->saveXML();
		print_r($outXML);
		// echo $outXML;

		// foreach ($tweets as $tweet) {
		// 	if (!empty($tweet['text'])) {
		// 		echo '<li class="tile" style="background:#'.randcol().'">';
		// 			echo $tweet['text'];
		// 			echo '<p><a href="http://twitter.com/'.$tweet['user']['id_str'].'/status/'.$tweet['id_str'].'">';
		// 			echo 'View this Tweet</a></p>';
		// 		echo '</li>'; 
		// 	}
		// }
	}

	// RETRIEVE PHOTOS
	if (isset($_GET['photosby'])) {
		$username = $_GET['photosby'];
		$photos = get_latest_photos(get_flickr_id_by_username($username));
		foreach ($photos['photo'] as $photo) {
			echo '<a href="'.$f->buildPhotoURL($photo).'">';
				echo '<li class="tile" style="background-image:url('.$f->buildPhotoURL($photo, 'medium').')">';
					// echo '<img style="background:url('.$f->buildPhotoURL($photo, 'small').')">';
				echo '</li>'; 
			echo '</a>';
		}
	} ?>