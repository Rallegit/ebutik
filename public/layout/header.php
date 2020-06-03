<?php
	//  unset($_SESSION['items']);
	//  if(!isset($_SESSION['items'])) {
	// 	$_SESSION['items'] = [];
	//  }

	// require('../src/config.php');
	require('../src/dbconnect.php');

    try {
		$query = "SELECT * FROM users;";
		$stmt = $dbconnect->query($query);
		$users = $stmt->fetchAll();
		}   catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}
		
	$articleItemCount = count($_SESSION['items']);

	$articleTotalSum = 0; //count($_SESSION['items']);

	foreach ($_SESSION['items'] as $articleId => $articleItem) {
		$articleTotalSum += $articleItem['price'] * $articleItem['quantity'];
	}
	
	$products = fetchAllProducts(); // refakturerat
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	
	<!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
    <title>Bacardi</title>
</head>
<body>
	<div class="container">

		<!-- Above header -->
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

		<div class="row">
			<div class="col-lg-12 col-sm-12 col-12 main-section">
				<a href="products.php" data-toggle="dropdown" role="button" aria-expanded="false"> 
					<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown-toggle">
						<span class="fa fa-gift bigicon">View Cart</span>
						<span class="badge badge-pill badge-danger">
							<?=$articleItemCount?>
						</span>
						<!-- <span class="caret"></span> -->
					</button>
				</a>
				
				<div class="dropdown-menu">
					<div class="d-flex flex-column">
					  	<div class="col">
					  		<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</div>

						<?php foreach ($products as $key => $article) { ?>

							<div class="article">
								<img src="admin/<?=$article['img_url']?>" style="width:50px;height:auto;">
								<?=htmlentities($article['title'])?>
								<?=htmlentities ($article['price'])?>
							</div>
					
						<?php } ?>

						<div class="col total-section text-left">
							<br>
					  		<p>Totalt:
					  			<span class="text-info">
									<?=$articleTotalSum['quantity']?>
								</span>
							</p>

							<?php foreach ($_SESSION['items'] as $articleId => $articleItem) { ?>
								<div class="row cart-detail">
									<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
									</div>
									<div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
										<p>Rum</p>
										<span class="price text-info"> 500 kr</span>
										<span class="count"> Amount: 1</span>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>