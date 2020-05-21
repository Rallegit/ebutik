<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Bacardi</title>
</head>
<body>
    <header id="above">
	    <nav class="login">
	        <?php 
	          	if (isset($_SESSION['username'])) {
	            	$loggedInUsername = htmlentities(ucfirst($_SESSION['username'])); 
	            	$aboveNav = "Welcome $loggedInUsername | <a href='logout.php'>Log out</a>";
	          	} else {
	            	$aboveNav = "<a href='signup.php'>Sign up</a> | <a href='login.php'>Log in</a>";
	          	}
	          echo $aboveNav;
	        ?>
	    </nav>  
    </header>

	


