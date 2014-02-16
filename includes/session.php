<?php
session_start();

function message() {
	if (isset($_SESSION['message'])) {
		$output = '<p id="post-message">'.htmlentities($_SESSION['message']).'</p>';
		
		// clear after use
		$_SESSION['message'] = null;

		return $output;
	}
}
?>