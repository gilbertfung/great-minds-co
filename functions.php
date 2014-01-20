<?php 
	// reusable code to quickly load formatted content from databse
	function loadEntities()	{
		// insert PHP code that loads file content into the variable $content
		$file = 'users.txt';
		$contentString = file_get_contents($file);
		// format the content so that it can be placed in a table
		$content = explode("\n", $contentString); // explode into elements of entities

		$result = [];
		// $id = 0;
		foreach ($content as $entityString) {
			// extract data from each entity, and put it into an array within $content
			$entity = explode(" | ", $entityString);

			// NVM. insert an id to the array. text file solution, since every line is a separate entity
			// array_unshift($entity, $id);
			// $id += 1;
			array_push($result, $entity);
		}
		return $result;
	}

	// used for usort function
	function compare($a, $b) { 
		return ($a[1] < $b[1]) ? -1 : 1; 
	}

	// extract unique entities from the entire database
	function getUniqueGroup($entities, $index) {
		$uniqueResult = [];
		foreach ($entities as $entity) {
			$result = $entity[$index];
			array_push($uniqueResult, $result);
		}
		
		$uniqueResult = array_unique($uniqueResult); // remove all duplicate industries for placing in list
		sort($uniqueResult); // sort the industries by name

		return $uniqueResult;
	}
?>