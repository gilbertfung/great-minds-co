<section class="content">
	<div id="hero">
		<h2>
			<?php
				if (isset($heroText)) {
					echo $heroText;
				} else {
					// All pages without $heroText already set, will have this phrase.
					echo "Let's share.";
				}
			?>
		</h2>
	</div>
	<nav id="menu">
		<button><a href="?action=list&type=industries">View all Idea-Makers by Industry</a></button>
		<button><a href="?action=list&type=ideaMakers">View all Idea-Makers</a></button>
	</nav>
</section>