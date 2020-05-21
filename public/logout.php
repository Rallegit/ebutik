<?php
	require('../src/config.php');
	$_SESSION = [];
	session_destroy();
	redirect('login.php?logout');
	