<?php
	//unset($_SESSION['items']);
	if(!isset($_SESSION['items'])) {
		$_SESSION['items'] = [];
	}

	//echo"<pre>";
	//print_r($_SESSION['items']);
	//echo"<pre>";

	require('../src/dbconnect.php');

    try {
		$query = "SELECT * FROM users;";
		$stmt = $dbconnect->query($query);
		$users = $stmt->fetchAll();
		}   catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
		
	$articleItemCount = count($_SESSION['items']);

	$articleTotalSum = 0; count($_SESSION['items']);

	foreach ($_SESSION['items'] as $articleId => $articleItem) {
 		$articleTotalSum += $articleItem['price'] * $articleItem['quantity'];
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
	
    <title>Bacardi</title>
</head>
<body>
	<div class="container">
		<!-- Header -->
		<div class="d-flex justify-content-end">
			<div class="p-2">
				<form action="edit.php?" method="GET">
					<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
					<input type="submit" value="My page" class="btn">
				</form>
			</div>

			<div class="p-2">
				<form action="admin/admin.php">
					<input type="submit" value="Admin" class="btn">
				</form>
			</div>
		</div>
	
		<!-- Log in/ Log out -->
		<div class="d-flex justify-content-end">
			<div class="p-2">
		        <?php
		          	if (isset($_SESSION['username'])) {
		            	$loggedInUsername = htmlentities(ucfirst($_SESSION['username'])); 
		            	$aboveNav = "Welcome $loggedInUsername | <a href='logout.php'>Log out</a>";
		          	} else {
		            	$aboveNav = "<a href='signup.php'>Sign up</a> | <a href='login.php'>Log in</a>";
		          	}
		          	echo $aboveNav;
				?>
			</div>
	    </div>
	
		<!-- Navbar -->
		<div class="d-flex justify-content-around text-center">
			<div class="col">
				<form action="index.php?">
					<input type="submit" value="Home" class="btn">
				</form>
			</div>
			<div class="col">		
				<form action="products.php?">
					<input type="submit" value="Products" class="btn">
				</form>
			</div>
			<div class="col">
				<form action="contact.php?">
					<input type="submit" value="Contact" class="btn">
				</form>
			</div>
      	</div>
		
		<!-- Cart -->
		<div class="d-flex justify-content-end">
			<div class="d-flex">
				<a href="products.php" data-toggle="dropdown" role="button" aria-expanded="false">
				<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown-toggle">
					<span class="fa fa-gift bigicon">View Cart</span>
					<span class="badge badge-pill badge-danger"><?=$articleItemCount?></span>
				</button>
				
				</a>
				
				<!-- Dropdown Menu -->
				<div class="dropdown-menu">
					<div class="d-flex flex-column">
					  	<div class="col">
					  		<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</div>

						<div class="col total-section text-left">
							<?php foreach ($_SESSION['items'] as $articleId => $articleItem) { ?>
								<div class="row cart-detail">
									<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
										<img src="admin/<?=$articleItem['img_url']?>" style="width:50px;height:auto;">
									</div>
									<div class="col">
										<?=$articleItem['title']?>
									</div>
									<div class="col">
										Antal:<?=$articleItem['quantity']?>
									</div>
								</div>
							<?php } ?>
							<span class="count">Total: <?=$articleTotalSum?>$</span>
							<form action="checkout.php" method="POST">
								<input type="submit" name="" value="Checkout" class="btn btn-primary">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	