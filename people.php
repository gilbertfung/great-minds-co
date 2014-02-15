<?php
require 'view/header.php';

// for industry filter
$query = "SELECT * "
		."FROM tag "
		."WHERE tag_type = 'industry'";
$industries = mysqli_query($db, $query);
if (!$industries) { die("Database query failed."); }

// for location filter
$query = "SELECT * "
		."FROM tag "
		."WHERE tag_type = 'location'";
$locations = mysqli_query($db, $query);
if (!$locations) { die("Database query failed."); }
?>
<div id="cover">
	<h2>People<span><a href="?show=list">Bar</a> <a href="?show=list">Tile</a> <a href="?show=list">List</a> <a href="" id="togglefilter">Filter</a></span></h2>
	<form id="filter" action="filter.php?in=people" method="get">
		<h3>Filter</h3>
		<!-- <label>Industry:</label> -->
		<select name="industry">
			<option value="default" selected>Industry / Field</option>
			<?php
			while ($row = mysqli_fetch_array($industries)) { // queries industry tags only
				echo '<option value="'.$row['tag_name'].'">'.$row['tag_name'].'</option>';
			}?>
		</select>
		<!-- <label>Location:</label> -->
		<select name="location">
			<option value="default" selected>Your Location</option>
			<?php
			while ($row = mysqli_fetch_array($locations)) { // queries location tags only
				echo '<option value="'.$row['tag_name'].'">'.$row['tag_name'].'</option>';
			}?>
		</select>

		<!--<label>Number of Followers: <input type="text" name="followers"></label>-->
		<input type="submit" value="Update list">
	</form>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#filter').hide();
			$("#togglefilter").click(function() {
				if ($('#filter').css("display") == "none") {
					$("#filter").show();
				} else {
					$("#filter").hide();
				}
			});
		});
	</script>

	<section id="content" class="flex">
		<?php 
			$query = "SELECT * "
					."FROM idea ";
					// ."WHERE $filter = 'selected tag'"; // TODO: join tags as well for filter
			$result = mysqli_query($db, $query);
			if (!$result) { die("Database query failed."); }
		?>
		<div id="12345" class="bar">
			<h3><a href="profile.php">First Last</a></h3>
			<p><a href="people.php?industry=tag">Tag Name 1</a>, <a href="people.php?industry=tag">Tag Name 2</a></p>
			<div class="follow-button">
				<button name="follow" class="follow">Follow</button>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#content').on('click', 'button', function() {
					$.ajax({
						type: "POST",
						url: "process.php?follow=12345",
						success: function() {
							$('#12345 button').css('background-color', '#a8eff0').text("Followed!");
						}
					});
				});
			});
		</script>
	</section>
</div>
</section>
<?php
require 'view/footer.php';
?>