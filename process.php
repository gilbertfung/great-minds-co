<?php
	if (isset($_GET['action'])) {
		$action = $_GET['action'];
		switch ($action) {
			case 'login':
				// validate log in
				break;
			
			case 'createAccount':
				createAccount();
				break;

			case 'viewProfile':
				// go to profile page
				break;

			default:
				echo "You processed nothing.";
				break;
		} 
	} else {
		echo "You did nothing.";
	}

	// checks submission of Create Account form and adds the info to a text file
	function createAccount() {
		// detect form submission
		if (isset($_POST['submit'])) {
			// add every field into $content
			$content = [];
			foreach($_POST as $key => $value) { // do all, regardless if it has FALSE elements or not, for the sake of table consistency (applies to promoters)
				$content[$key] = $value;
			}

			// detect if each required variable is set
			$numCompletedFields = count(array_filter($_POST)); // array_filter w/o callback removes all FALSE elements
			if ($numCompletedFields == count($content)) {
				// prepare content for writing to text file
				array_pop($content); // pop off 'submit', I don't want that in my text file
				$contentString = implode(' | ', $content)."\n";
				
				// write user information into text file
				$file = 'users.txt';
				file_put_contents($file, $contentString, FILE_APPEND); // open file, APPEND content, close file
				
				// redirect to Account Created page
				header('Location: index.php?action=accountCreated');
			} else {
				// TODO: validate beforehand, so this doesn't happen
				echo "I didn't get all required variables.";
			}
		} else {
			// TODO: validate beforehand, so this doesn't happen
			echo "I didn't get a submission.";
		}
	}
?>