<?php
	//unset($_SESSION['items']);
	if(!isset($_SESSION['items'])) {
		$_SESSION['items'] = [];
	}

	//echo"<pre>";
	//print_r($_SESSION['items']);
	//echo"<pre>";

	// require('../src/dbconnect.php');

    // try {
	// 	$query = "SELECT * FROM users;";
	// 	$stmt = $dbconnect->query($query);
	// 	$users = $stmt->fetchAll();
	// 	}   catch (\PDOException $e) {
	// 	throw new \PDOException($e->getMessage(), (int) $e->getCode());
	// }
		
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
	<div class="container-fluid p-0">
		<!-- Log in/ Log out -->
		<div class="d-flex justify-content-end poop">
			<div class="d-flex justify-content-end">
				<form action="edit.php?" method="GET">
					<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
					<input type="submit" value="My page" class="btn">
				</form>

				<form action="admin/admin.php">
					<input type="submit" value="Admin" class="btn">
				</form>
			</div>
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
		</div>
	
		<!-- Navbar -->
		<div class="d-flex justify-content-around text-center bg-white">
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

				<button type="button" class="btn bg-warning dropdown-toggle" data-toggle="dropdown-toggle">
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
									<div>
									<!-- <form action="delete-cart-item.php" method="POST">
										<input type="hidden" name="articleId" value="<?=$articleId?>" >
										<button type="submit" class="btn">
											<svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
												<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
											</svg>
										</button>
									</form> -->
									</div>
								</div>
							<?php } ?>
							<span class="count">Total: <?=$articleTotalSum?>kr</span>
							<form action="checkout.php" method="POST">
								<input type="submit" name="" value="Checkout" class="btn btn-primary">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>