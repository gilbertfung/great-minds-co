<?php
	function requireSSL() {
		if(!isset($_SERVER["HTTPS"])/*$_SERVER["HTTPS"] != "on"*/) {
			header("Location: https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]);
			exit();
		}
	}

	function loadSession() {
		$_SESSION['callback_URL'] = (isset($_SERVER['HTTPS']) ? "https://" : "http://")
									.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		if (!isset($_SESSION['valid_user'])) {
			header("Location: authenticate.php");
		}
	}
?>