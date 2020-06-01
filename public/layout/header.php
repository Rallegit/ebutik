<?php
	require('../src/dbconnect.php');

    try {
		$query = "SELECT * FROM users;";
		$stmt = $dbconnect->query($query);
		$users = $stmt->fetchAll();
		}   catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
    <title>Bacardi</title>
</head>
<body>
	<!-- Above header -->
    <header id="above">
	    <nav class="login">
			
			<div>
				<form action="edit.php?" method="GET">
					<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
					<input type="submit" value="My page" class="btn">
				</form>
			</div>
			
			<form action="admin/admin.php">
					<input type="submit" value="Admin" class="btn">
			</form>
			
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
	
	<!-- Navbar --> 
	<ul class="navbar">
	<header id="menu">
		<form action="index.php?">
			<input type="submit" value="Home" class="btn">
		</form>
			
		<form action="products.php?">
			<input type="submit" value="Products" class="btn">
		</form>


		<form action="contact.php?">
			<input type="submit" value="Contact" class="btn">
		</form>
      	</ul>

    </header>

