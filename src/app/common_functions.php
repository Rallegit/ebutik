<?php
	// Functions
	function redirect($location) {
	    header("Location: {$location}");
	    exit;
	}

	function checkLoginSession() {
	    if (!isset($_SESSION['username'])) {
	        redirect('login.php?mustLogin');
	    } 
	}

	function debug($var) {
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}

