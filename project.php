<?php
require 'view/header.php';
?>
<div id="cover">
<h2>Project Name</h2>
	<article id="cover-info">
		<div class="flex">
			<div class="side"><img src="//" width="320" height="240"></div>
			<div class="section">This is a blurb.
			<div class="promote-button">
				<button name="promote" class="promote">Promote</button>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$('.promote-button').on('click', 'button', function() {
					$.ajax({
						type: "POST",
						url: "process.php?promote=12345",
						success: function() {
							$('.promote-button button').css('background-color', '#a8eff0').text("Promoted!");
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