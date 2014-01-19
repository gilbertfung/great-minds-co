<section class="content">
	<div id="hero">
		<h1>
			<?php
				// if redirected from accountCreated, show a welcome message
				if (isset($_GET['action']) && $_GET['action'] == 'accountCreated') {
					$heroText = "Hey, name. Welcome to Great Minds, Co.";
				} else {
					$heroText = "Let's share.";
				}
				echo $heroText;
			?>
		</h1>
	</div>
	<div>
		<a href="?viewBy=Industry">View all Idea-Makers by Industry</a>
		<a href="?viewBy=Name">View all Idea-Makers</a>
	</div>
	This is content.
</section>