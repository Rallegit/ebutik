<?php
	require('../src/config.php');
	$_SESSION = [];
	// unset($_SESSION['username']);
	session_destroy();
	redirect('login.php?logout'); //refakturerad
	?>
	
	<?php include('layout/footer.php'); ?>
