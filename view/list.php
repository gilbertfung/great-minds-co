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
			
			foreach ($entities as $key => $entity) {
				$industry = $entity[9];
				// if industry is not the one that was requested, remove it from entities.
				if ($industry != $groupBy) {
					array_splice($entity, $key, 1);
				}
			}
			//$industriesUnique = getUniqueGroup($entities, 10); // all unique industries are in here. use this to determine
					// remove entities that do not match specified industry
				// foreach ($entities as $entity) {
				// 	isolate industry - array_search(needle, haystack)
				// 	add to industrieslist
				// }

				// foreach ($variable as $key => $value) {
				// 	keep groupby remove rest
				// }
				// 	break;
				
				// default: // all. default sort by member name
				// 	break;
			// } // end switch
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

					echo "<tr class=\"entity\">";
						echo "<td><a href=\"profile.php?id=$id\">$name</a></td>";
						echo "<td>$industry</td>";
						echo "<td>$location</td>";
						echo "<td>$website</td>";
					echo "</tr>";
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