<?php
	if (isset($_GET['type'])) {
		$type = $_GET['type'];
		switch ($type) {
			case 'industries':
				showList('industries');
				break;

			case 'ideaMakers':
				showList('ideaMakers');
				break;
			
			default:
				echo "I've got nothing to list. Try something else?";
				break;
		}
	}

	function showList($type = 'ideaMakers', $sort = 'alpha') {
		// insert PHP code that loads file content into the variable $content
		$file = 'users.txt';
		$contentString = file_get_contents($file);
		// format the content so that it can be placed in a table
		$content = explode("\n", $contentString); // explode into elements of entities

		$entities = [];
		$id = 0;
		foreach ($content as $entityString) {
			// extract data from each entity, and put it into an array within $content
			$entity = explode(" | ", $entityString);

			// insert an id to the array. text file solution, since every line is a separate entity
			array_unshift($entity, $id);
			$id += 1;
			array_push($entities, $entity);
		}
		usort($entities, 'compare');

		switch ($type) {
			case 'industries':
				# code...
				break;
			
			default: // show all ideaMakers by default
				
				break;
		}
		?>

		<table>
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
						echo '<tr class="entity">';
							$id = $entity[0];
							$name = $entity[2];
							$industry = $entity[10];
							$location = $entity[6];
							$website = $entity[7];

							echo "<td><a href=\"profile.php?id=$id\">$name</a></td>";
							echo "<td>$industry</td>";
							echo "<td>$location</td>";
							echo "<td>$website</td>";
						echo "</a></tr>";
					}
				?>

			</tbody>
		</table>
		
		<?php
	}

	function compare($a, $b) { 
		return ($a[2] < $b[2]) ? -1 : 1; 
	}

	// Print variable $content
	// echo nl2br($content);
	// echo "<hr/>";

/*
echo "<table border='0'>
<tr>
<th>UserName</th>
<th>ID</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['UserName'] . "</td>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "</tr>";
  }
echo "</table>";
*/
?>