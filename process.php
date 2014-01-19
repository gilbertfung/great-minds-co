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
			foreach($_POST as $key=>$value) { // do all, regardless if it has FALSE elements or not, for the sake of table consistency (applies to promoters)
				$content[$key] = $value;
			}

			// detect if each required variable is set
			$num_completed_fields = count(array_filter($_POST)); // array_filter w/o callback removes all FALSE elements
			if ($num_completed_fields == count($content)) {
				// prepare content for writing to text file
				array_pop($content); // pop off 'submit', I don't want that in my text file
				$formatted_content = implode(' | ', $content)."\n";
				
				// write user information into text file
				$file = 'users.txt';
				file_put_contents($file, $formatted_content, FILE_APPEND); // open file, APPEND content, close file
				
				// redirect to Account Created page
				$newURL = 'index.php?action=accountCreated';
				header('Location: '.$newURL);
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