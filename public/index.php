<?php
	require('../src/config.php');
	require('../src/dbconnect.php');
?>

<?php include('layout/header.php'); ?>
	<!-- Page Content -->
	<div class="container-fluid indexPage">
		<div class="d-flex flex-column justify-content-center logoContainer">
			<img class="logo" src="img/rumshop.png" alt="" style="width: 65vh;">
			<button class="btn shopBtn align-self-center" src="products.php" style="width:10em;">Shop now</button>
		</div>
		<!-- <div class="d-flex justify-content-center">
			<button class="btn shopBtn" src="products.php">Shop now</button>
		</div> -->
	</div>
<?php include('layout/footer.php'); ?>