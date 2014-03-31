<?php 
// GENERAL FUNCTIONS
	function redirect_to($url) {
		return header("Location: ".$url);
	}

	function randcol() { //http://stackoverflow.com/questions/43044/algorithm-to-randomly-generate-an-aesthetically-pleasing-color-palette
		$r = dechex(round(rand(0, 63) + 190));
		$g = dechex(round(rand(0, 63) + 190));
		$b = dechex(round(rand(0, 63) + 190));
		return $r.$g.$b;
	}

// HTTPS FUNCTIONS
	function requireSSL($boolean) {
		if ($boolean) {
			if(!isset($_SERVER["HTTPS"])) {
				header("Location: https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
				exit();
			}
		} else {
			// for when https isn't important
			if(isset($_SERVER["HTTPS"])) {
				header("Location: http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
				exit();
			}
		}
	}

/*
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
	}*/
?>