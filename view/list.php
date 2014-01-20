<?php
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

	function showList($from = 'all') {
		$entities = loadEntities();
		if (isset($_GET['groupBy'])) {
			$groupBy = $_GET['groupBy'];
			switch ($groupBy) {
				case 'industries': // show unique industry entries
					
					break;
				
				default: // all. default sort by member name
					break;
			} // end switch
		} else { // do your default: show all by member name
			usort($entities, 'compareNames');
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
				foreach ($entities as $entity) {
					$id = $entity[0];
					$name = $entity[2];
					$industry = $entity[10];
					$location = $entity[6];
					$website = $entity[7];

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
				$industriesUnique = [];
				foreach ($entities as $entity) {
					$industry = $entity[10];
					array_push($industriesUnique, $industry);
				}
				
				$industriesUnique = array_unique($industriesUnique); // remove all duplicate industries for placing in list
				sort($industriesUnique); // sort the industries by name
				foreach ($industriesUnique as $industry) {
					echo "<li class=\"$industry\">";
						echo "<a href=\"index.php?action=list&type=ideaMakers&groupBy=$industry\">$industry</a>";
					echo "</li>";
				}
			?>
		</ul>
<?php
	}

	function loadEntities()	{
		// insert PHP code that loads file content into the variable $content
		$file = 'users.txt';
		$contentString = file_get_contents($file);
		// format the content so that it can be placed in a table
		$content = explode("\n", $contentString); // explode into elements of entities

		$result = [];
		$id = 0;
		foreach ($content as $entityString) {
			// extract data from each entity, and put it into an array within $content
			$entity = explode(" | ", $entityString);

			// insert an id to the array. text file solution, since every line is a separate entity
			array_unshift($entity, $id);
			$id += 1;
			array_push($result, $entity);
		}
		return $result;
	}

	function compareNames($a, $b) { 
		return ($a[2] < $b[2]) ? -1 : 1; 
	}

	function compareIndustries($a, $b) { 
		return ($a[10] < $b[10]) ? -1 : 1; 
	}
?>