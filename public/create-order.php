<?php
	// echo "<pre";
	// print_r($_POST);
	// echo "<pre";
	// exit;

	if (isset($_POST['createOrderBtn'])) {
		$firstName 		= trim($_POST['firstName']);
		$lastName 		= trim($_POST['lasttName']);
		$email 	   		= trim($_POST['email']);
		$password 		= trim($_POST['password']);
		$phone 			= trim($_POST['phone']);
		$street 		= trim($_POST['street']);
		$city 			= trim($_POST['city']);
		$country 		= trim($_POST['country']);
		$postalCode 	= trim($_POST['postalCode']);
		// $createOrderBtn = trim($_POST['createOrderBtn']);
	}

	// Check if user already exist in our DB
	try {
        $query = "
            SELECT * FROM users
            WHERE email = :email;
        ";
        
        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':email', $email//$_GET['email']);
        $stmt->execute();
        $user = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }


	if ($user) { //If users exists already in our DB
		$userId = $user['id'];
	} else { // Else create new user, and fetch the newly created id 
		try {
	        $query = "
	            INSERT INTO users (firstName, lastName, email, password, phone, street, postalCode, city, country)
	            VALUES :firstName, :lastName, :email, :password, :phone, :street, :postalCode, :city, :country
	        ";
	        
	        $stmt = $dbconnect->prepare($query);
	        $stmt->bindvalue(':firstName', $firstName);
        	$stmt->bindvalue(':lastName', $lastName);
        	$stmt->bindvalue(':email', $email);//$_GET['email']);
        	$stmt->bindvalue(':password', $password);
        	$stmt->bindvalue(':phone', $phone);
        	$stmt->bindvalue(':street', $street);
        	$stmt->bindvalue(':postalCode', $postalCode);
        	$stmt->bindvalue(':city', $city);
        	$stmt->bindvalue(':country', $country);
	        $stmt->execute();
	        $user = $stmt->fetch();
	    } catch (\PDOException $e) {
	        throw new \PDOException($e->getMessage(), (int) $e->getCode());
	    }
	}
?>