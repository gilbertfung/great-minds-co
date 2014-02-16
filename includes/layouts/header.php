<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Great Minds Co.</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/main.css">
	<script type="text/javascript" src="//code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<!-- Several portions of code was learned and adopted from the Lynda tutorials. http://www.lynda.com/MySQL-tutorials/PHP-MySQL-Essential-Training/119003-2.html -->
</head>

<body>
	<div class="main">
		<?php echo message(); ?>
		<header id="header">
			<h1 id="title"><a href="index.php">Great Minds, Co.</a></h1>
			<nav id="topnav">
				<ul>
					<?php 
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
						// If logged in, show Settings
							echo '<li><a href="settings.php">Settings</a></li>';
							echo '<li><a href="logout.php">Log out</a></li>';
						} else {
						// If not logged in, show Register / Login
							echo '<li><a href="login.php">Register / Login</a></li>';
						}
					?>
				</ul>
			</nav>
		</header>
		<section id="topic">
			<nav id="sidenav">
				<ul>
					<li id="profile"><a href="profile.php?id=you"><img src="//" width="40" height="40"> You</a></li>
					<li id="home"><a href="index.php"><img src="//" width="40" height="40"> Home</a></li>
					<li id="ideas"><a href="ideas.php"><img src="//" width="40" height="40"> Ideas</a></li>
					<li id="people"><a href="people.php"><img src="//" width="40" height="40"> People</a></li>
				</ul>
			</nav>