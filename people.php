<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions/functions.php'; ?>
<?php require_once 'includes/functions/user.php'; ?>
<?php require_once 'includes/functions/entity.php'; ?>
<?php require_once 'includes/functions/ajax.php'; ?><?php require_once 'includes/layouts/header.php'; ?>
<?php requireSSL(false);
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
	<h2>People
		<span class="action">
			<a id="viewbar" href="#">Bar</a> 
			<a id="viewtile" href="#">Tile</a> 
			<a id="viewlist" href="#">List</a> 
			<a href="#" id="togglefilter">Filter</a>
		</span>
	</h2>
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
		<input type="submit" name="filter" value="Update list">
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
			$("#viewbar").click(function() {
				$(".content > div").attr("class", "bar");
			})
			$("#viewtile").click(function() {
				$(".content > div").attr("class", "tile");
			})
			$("#viewlist").click(function() {
				$(".content > div").attr("class", "list");
			})
		});
	</script>

	<section class="content flex">
		<?php 
			$people = find_all_users();
			while ($user = mysqli_fetch_assoc($people)) {
				$is_ideamaker = "";
				if (is_ideamaker($user['user_id'])) {$is_ideamaker = "Ideamaker";}
				echo '<div id="'.$user["user_id"].'" class="bar" style="background:#'.randcol().'">';
					echo '<h3><a href="profile.php?id='.$user["user_id"].'">'.$user["name"].'</a><span> '.$is_ideamaker.'</span><span class="action">'.$user["industry"].'</span></h3>';
					echo follow_button($user);
				echo '</div>'; 
			}
		?>
	</section>
</div>
</section>
<?php require 'includes/layouts/footer.php'; ?>