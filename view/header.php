<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Great Minds Co.</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/main.css">
</head>

<body>
	<div class="main">
		<header id="header">
			<h1 id="title"><a href="#">Great Minds, Co.</a></h1>
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
