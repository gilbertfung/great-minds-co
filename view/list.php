<?php
	require_once 'functions.php';

	if (isset($_GET['type'])) {
		$type = $_GET['type'];
		switch ($type) {
			case 'industries':
				showGroup();
				break;

			case 'ideaMakers':
				showList();
				break;
			
			default:
				echo "I've got nothing to list. Try something else?";
				break;
		}
	}

	function showList($groupBy = 'all') { 
		$entities = loadEntities();

		// if set, show entries from specified industry
		if (isset($_GET['groupBy'])) {
			$groupBy = $_GET['groupBy'];
		} else { // do your default: show all by member name
			usort($entities, 'compare');
		}
?>
		<table id="showList">
			<thead>
				<tr>
					<th>Name</th>
					<th>Industry / Field</th>
					<th>Location</th>
					<th>Website</th>
				</tr>
			</thead>
			<tbody>
<?php 
				foreach ($entities as $key => $entity) {
					$id = $key; // $id = $entity[0];
					$name = $entity[1];
					$industry = $entity[9];
					$location = $entity[5];
					$website = $entity[6];

					if (isset($_GET['groupBy'])) {
						$groupBy = $_GET['groupBy'];
						if ($industry == $groupBy) {
							echo "<tr class=\"entity\">";
								echo "<td><a href=\"profile.php?id=$id\">$name</a></td>";
								echo "<td>$industry</td>";
								echo "<td>$location</td>";
								echo "<td>$website</td>";
							echo "</tr>";
						} // else don't show any that aren't from that industry
					} else { // if groupBy doesn't exist, just do as normally do
						echo "<tr class=\"entity\">";
							echo "<td><a href=\"profile.php?id=$id\">$name</a></td>";
							echo "<td>$industry</td>";
							echo "<td>$location</td>";
							echo "<td>$website</td>";
						echo "</tr>";
					}
				}
?>
			</tbody>
		</table>
<?php
	}

	function showGroup($group = 'industries') {
		$entities = loadEntities(); // load file & format content & sort
?>
		<ul id="showGroup">
			<?php 
				$industriesUnique = getUniqueGroup($entities, 9);
				foreach ($industriesUnique as $industry) {
					echo "<li class=\"$industry\">";
						echo "<a href=\"index.php?action=list&type=ideaMakers&groupBy=$industry\">$industry</a>";
					echo "</li>";
				}
			?>
		</ul>
<?php
	}
?>