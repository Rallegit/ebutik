<?php
/**
 * When refactoring to functions, you need to consider the following:
 *
 * 1. Make sure all necessary variables are availabe in the function scope
 * 2. Make sure to return the value, if its needed for the particular code
 */	


	// adds userdata to signup page bland annat
	function add($userData) {
	    global $dbconnect;

        try {
            $query = "
                INSERT INTO users (username, password, email, phone, street, postal_code, city, country, first_name, last_name)
                VALUES (:username, :password, :email, :phone, :street, :postal_code, :city, :country, :first_name, :last_name);
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':username', $userData['username']);
            $stmt->bindValue(':password', $userData['password']);
            $stmt->bindValue(':email', $userData['email']);
            $stmt->bindValue(':phone', $userData['phone']);
            $stmt->bindValue(':street', $userData['street']);
            $stmt->bindValue(':postal_code', $userData['postal_code']);
            $stmt->bindValue(':city', $userData['city']);
            $stmt->bindValue(':country', $userData['country']);
            $stmt->bindValue(':first_name', $userData['first_name']);
            $stmt->bindValue(':last_name', $userData['last_name']);
            $result = $stmt->execute();

        } catch(\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
            
        }
        return $result;
    }