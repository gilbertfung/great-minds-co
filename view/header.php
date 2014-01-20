<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Great Minds Co.</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/main.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</head>

<body>
	<div class="main">
		<header id="header">
			<h1 id="title"><a href="index.php">Great Minds, Co.</a></h1>
			<nav id="nav">
				<ul>
					<?php 
						// if (!$loggedIn) {
						// If not logged in, show Register / Login
							echo '<li><a href="?action=login">Register / Login</a></li>';
						// } else {
						// If logged in, show Settings
							//  echo "<li><a href="?action=login">Settings</a></li>";
							//}
					?>
				</ul>
			</nav>
		</header>
