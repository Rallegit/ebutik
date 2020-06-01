<?php
/**
 * When refactoring to functions, you need to consider the following:
 *
 * 1. Make sure all necessary variables are availabe in the function scope
 * 2. Make sure to return the value, if its needed for the particular code
 */	

	function fetchAllProducts() {
        global $dbconnect;

        try {
            $query = "SELECT * FROM products;";
            $stmt = $dbconnect->query($query);
            $products= $stmt->fetchAll();
        }   catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        return $products;
	}

/*------------------------------------------------------------*/

    function fetchAllUsers() {
        global $dbconnect;

        try {
            $query = "SELECT * FROM users;";
            $stmt = $dbconnect->query($query);
            $users = $stmt->fetchAll();
        }      catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        return $users;
    }

/*------------------------------------------------------------*/

	function fetchProductById($id) {
        global $dbconnect;

        try {
            $query = "
                SELECT * FROM products
                WHERE id = :id;
            ";
            
            $stmt = $dbconnect->prepare($query);
            $stmt->bindvalue(':id', $_GET['id']);
            $stmt->execute();
            $product = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        return $product;
	}

/*------------------------------------------------------------*/

    function fetchUserById($id) {
        global $dbconnect;

        try {
            $query = "
                SELECT * FROM users
                WHERE id = :id;
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindvalue(':id', $_GET['id']);
            $stmt->execute();
            $account = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        return $account;
    }

/*------------------------------------------------------------*/

    function fetchAccountById() {
        global $dbconnect;

        try {
            $query = "
                SELECT * FROM users
                WHERE id = :id;
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindvalue(':id', $_GET['id']);
            $stmt->execute();
            $konto = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        return $konto;
    }

/*------------------------------------------------------------*/

	function fetchByUsername($username) {
		global $dbconnect;

        try {
            $query = "
                SELECT * FROM users
                WHERE username = :username;
            ";

            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        return $user;
	}

/*------------------------------------------------------------*/

	// function deleteUser($id) {
    //     global $dbconnect;

    //     if(empty($users)){
    //         try {
    //             $query = "
    //             DELETE FROM users
    //             WHERE id = :id;
    //             ";
      
    //             $stmt = $dbconnect->prepare($query);
    //             $stmt->bindValue(':id', $_POST['id']);
    //             $result = $stmt->execute();
    //       }     catch (\PDOException $e) {
    //             throw new \PDOException($e->getMessage(), (int) $e->getCode());
    //       }
    //         session_start();
    //         $_SESSION["successmsg"]='User deleted!';
    //         session_destroy();
    //         redirect('../index.php'); /// hittat inte sökväg om users -> deleteBtn // mypage --> users deleteknapp
    //     }
	// } // FIXA SENENNESNSENSENESNSNE

/*------------------------------------------------------------*/

    function deleteProduct($id) {
        global $dbconnect;

        if(empty($title)){
            try {
                $query = "
                DELETE FROM products
                WHERE id = :id;
                ";
        
                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':id', $_POST['id']);
                $stmt->execute();
            }     catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }
        }
    }

/*------------------------------------------------------------*/

	// function update($userData){

	// }

/*------------------------------------------------------------*/

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

/*------------------------------------------------------------*/

