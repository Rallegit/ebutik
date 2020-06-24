<?php
	require('../../src/dbconnect.php');

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
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/style.css">

    <title>Bacardi</title>
</head>
<body>
	<div class="container-fluid p-0 m-0">
		<!-- Above header -->
		<div class="d-flex justify-content-end bg-white">
			<div class="d-flex justify-content end">
				<form action="../edit.php?" method="GET">
					<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
					<input type="submit" value="My page" class="btn logInBtn">
				</form>
			</div>
			<div class="p-2 logInBtn">
				<?php
					if (isset($_SESSION['username'])) {
						$loggedInUsername = htmlentities(ucfirst($_SESSION['username'])); 
						$aboveNav = "Welcome <span> $loggedInUsername</span> | <a href='../logout.php'>Log out</a>";
					} else {
						$aboveNav = "<a href='../signup.php'>Sign up</a> | <a href='../login.php'>Log in</a>";
					}
				echo $aboveNav;
				?>
			</div>	
		</div>
		
		<!-- Navbar --> 
		<div class="d-flex justify-content-around text-center pb-3 mb-5">
			<div class="col">
				<form action="../index.php?">
					<input type="submit" value="Home" class="btn">
				</form>
			</div>

			<div class="col">
				<form action="../products.php?">
					<input type="submit" value="Products" class="btn">
				</form>
			</div>

			<!-- <div class="col">
				<form action="createproducts.php?">
					<input type="submit" value="Add Product" class="btn">
				</form>
			</div> -->

			<div class="col">
				<form action="contact.php?">
					<input type="submit" value="Contact" class="btn">
				</form>
			</div>
		</div>

