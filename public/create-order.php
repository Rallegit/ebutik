<?php
	require('../src/dbconnect.php');
	require('../src/config.php');
	
	// echo "<pre>";
	// print_r($_POST);
	// echo "<pre>";
	// exit;

	if (isset($_POST['createOrderBtn'])) {
		$firstName 		= trim($_POST['firstName']);
		$lastName 		= trim($_POST['lastName']);
		$username 		= trim($_POST['username']);
		$email 	   		= trim($_POST['email']);
		$password 		= trim($_POST['password']);
		$phone 			= trim($_POST['phone']);
		$street 		= trim($_POST['street']);
		$city 			= trim($_POST['city']);
		$postalCode 	= trim($_POST['postalCode']);
		$country 		= trim($_POST['country']);
		$totalPrice 	= trim($_POST['totalPrice']);
	
		// Check if user already exist in our DB
		try {
			$query = "
				SELECT * FROM users
				WHERE email = :email
			";
			
			$stmt = $dbconnect->prepare($query);
			$stmt->bindValue(':email', $email);
			$stmt->execute();
			$user = $stmt->fetch();
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
	}
	
	if ($user) { //If users already exists in our DB
		$userId = $user['id'];
	} else {
		try {
	        $query = "
	            INSERT INTO users (first_name, last_name, username, email, password, phone, street, postal_code, city, country)
	            VALUES (:firstName, :lastName, :username, :email, :password, :phone, :street, :postalCode, :city, :country);
	        ";
	        
	        $stmt = $dbconnect->prepare($query);
	        $stmt->bindValue(':firstName', $firstName);
			$stmt->bindValue(':lastName', $lastName);
			$stmt->bindValue(':username', $username);
        	$stmt->bindValue(':email', $email);
        	$stmt->bindValue(':password', $password);
        	$stmt->bindValue(':phone', $phone);
        	$stmt->bindValue(':street', $street);
        	$stmt->bindValue(':postalCode', $postalCode);
        	$stmt->bindValue(':city', $city);
        	$stmt->bindValue(':country', $country);
	        $stmt->execute();
	        $userId = $dbconnect->lastInsertId();
	    } catch (\PDOException $e) {
	        throw new \PDOException($e->getMessage(), (int) $e->getCode());
	    }
	}

	// echo "<pre>";
	// print_r($_POST);
	// echo "<pre>";

	//  echo "<pre>";
	//  print_r($user);
	//  echo "<pre>";


	//  echo "<pre>";
	//  print_r($userId);
	//  echo "<pre>";
	//  exit;
	

	// Create order
	try {
		$query = "
			INSERT INTO orders (user_id, total_price, billing_full_name, billing_street, billing_postal_code, billing_city, billing_country)
			VALUES (:userId, :totalPrice, :fullName, :street, :postalCode, :city, :country);
		";
		
		$stmt = $dbconnect->prepare($query);
		$stmt->bindValue(':userId', $userId);
		$stmt->bindValue(':totalPrice', $totalPrice);
		$stmt->bindValue(':fullName', "{$firstName} {$lastName}");
		$stmt->bindValue(':street', $street);
		$stmt->bindValue(':postalCode', $postalCode);
		$stmt->bindValue(':city', $city);
		$stmt->bindValue(':country', $country);
		$stmt->execute();
		$orderId = $dbconnect->lastInsertId();
	} catch (\PDOException $e) {
		throw new \PDOException($e->getMessage(), (int) $e->getCode());
	}


	// Create order_items
	foreach ($_SESSION['items'] as $articleId => $articleItem) {
		try {
			$query = "
				INSERT INTO order_items (order_id, product_id, quantity, unit_price, product_title)
				VALUES (:orderId, :productId, :quantity, :price, :title);
			";
			
			$stmt = $dbconnect->prepare($query);
			$stmt->bindValue(':orderId', $orderId);
			$stmt->bindValue(':productId', $articleItem['id']);
			$stmt->bindValue(':quantity', $articleItem['quantity']);
			$stmt->bindValue(':price', $articleItem['price']);
			$stmt->bindValue(':title', $articleItem['title']);
			$stmt->execute();
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int) $e->getCode());
		}
	}
	//echo "<pre>";
	//print_r($_SESSION);
	//echo "<pre>";
	//exit;

	//unset($_SESSION['items']);
	header('Location: order-confirmation.php');
	exit;
	
	header('Location: checkout.php');
	exit;

?>
