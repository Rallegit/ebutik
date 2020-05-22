<?php
	require('../src/dbconnect.php');

	try {
        $query = "
            SELECT * FROM users
            WHERE id = :id;
        ";

        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':id', $_GET['id']);
        $stmt->execute();
        $users = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Bacardi</title>
</head>
<body>
	<!-- Above header -->
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
	
	<!-- Navbar --> 
	<header id="menu">
<!--      	<main class="navbar">-->
<!--	        <a id="home-link" href="index.php">Home</a>-->
<!--	        <a id="products" href="products.php">Products</a>-->
<!--	        <a id="contact" href="contact.php">Contact</a>-->
<!--			<a id="mypagetest" href="edit.php">Edit PAGE</a>-->
		<main class="navbar">	
		 
			<form action="index.php?">
				<input type="submit" value="Home" class="btn">
			</form>

			<form action="products.php?">
				<input type="submit" value="Products" class="btn">
			</form>

			<form action="contact.php?">
				<input type="submit" value="Uppdatera" class="btn">
			</form>

			<form action="edit.php?" method="GET">
				<input type="hidden" name="id" value="<?=$users['id']?>">
				<input type="submit" value="My page" class="btn">
			</form>
      	</main>
    </header>


