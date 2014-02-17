<?php require_once 'includes/session.php'; ?>
<?php require_once 'includes/dbconnect.php'; ?>
<?php require_once 'includes/functions.php'; ?>
<?php require_once 'includes/layouts/header.php'; ?>
<?php requireSSL(false);
// for industry filter
$query = "SELECT * "
		."FROM tag "
		."WHERE tag_type = 'industry'";
$industries = mysqli_query($db, $query);
if (!$industries) { die("Database query failed."); }
?>

<div id="cover">
	<h2>Ideas<span class="action"><a href="?show=list">Bar</a> <a href="?show=list">Tile</a> <a href="?show=list">List</a> <a href="" id="togglefilter">Filter</a></span></h2>
	<form id="filter" action="filter.php?in=ideas" method="get">
		<h3>Filter</h3>
		<!-- <label>Industry:</label> -->
		<select name="industry">
			<option value="default" selected>Industry / Field</option>
			<?php
			while ($row = mysqli_fetch_assoc($industries)) { // queries industry
				echo '<option value="'.$row['tag_name'].'">'.$row['tag_name'].'</option>';
			}?>
		</select>
		<!--<label>Times promoted: <input type="text" name="timesPromoted"></label>-->
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
	
	<section class="content" class="flex">
		<?php 
			$ideas = find_all_ideas();
			while ($idea = mysqli_fetch_assoc($ideas)) {
				echo '<div id="idea-'.$idea["idea_id"].'" class="tile" style="background:#'.randcol().'">';
					echo '<h3><a href="project.php?id='.$idea["idea_id"].'">'.$idea["title"].'</a></h3>';
					echo promote_button($idea);
				echo '</div>'; 
			}
		?>
	</section>
</div>
</section> <!--#topic-->
<?php require 'includes/layouts/footer.php'; ?>