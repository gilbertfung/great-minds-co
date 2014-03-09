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
	<h2>Ideas
		<span class="action">
			<a id="viewbar" href="#">Bar</a> 
			<a id="viewtile" href="#">Tile</a> 
			<a id="viewlist" href="#">List</a> 
			<a href="#" id="togglefilter">Filter</a>
		</span>
	</h2>
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
				$(".content div").attr("class", "bar");
			})
			$("#viewtile").click(function() {
				$(".content div").attr("class", "tile");
			})
			$("#viewlist").click(function() {
				$(".content div").attr("class", "list");
			})
		});
	</script>
	
	<section class="content flex">
		<?php 
			$ideas = find_all_ideas();
			while ($idea = mysqli_fetch_assoc($ideas)) {
				$is_project = "";
				if (is_project($idea['idea_id'])) {$is_project = "Project";}
				echo '<div id="'.$idea["idea_id"].'" class="tile" style="background:#'.randcol().'">';
					echo '<h3><a href="project.php?id='.$idea["idea_id"].'">'.$idea["title"].'</a><span class="action">'.$is_project.'</span></h3>';
					echo promote_button($idea);
				echo '</div>'; 
			}
		?>
	</section>
</div>
</section> <!--#topic-->
<?php require 'includes/layouts/footer.php'; ?>