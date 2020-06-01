<?php
    require('../../src/config.php');
    
    checkLoginSession();

    require('../../src/dbconnect.php');

    if (isset($_POST['deleteBtn'])) {
 
        if(empty($title)){
            try {
                $query = "
                DELETE FROM users
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

    $first_name  = '';
    $last_name   = '';
    $phone       = '';
    $street      = '';
    $postal_code = '';
    $city        = '';
    $country     = '';
    $username    = '';
    $email       = '';
    $error       = '';
    $msg         = '';
    
    if (isset($_POST['add'])) {
        $username          = trim($_POST['username']);
        $first_name        = trim($_POST['first_name']);
        $last_name         = trim($_POST['last_name']);
        $email             = trim($_POST['email']);
        $password          = trim($_POST['password']);
        $confirmPassword   = trim($_POST['confirmPassword']);
        $phone             = trim($_POST['phone']);
        $street            = trim($_POST['street']);
        $postal_code       = trim($_POST['postal_code']);
        $city              = trim($_POST['city']);
        $country           = trim($_POST['country']);

        if (empty($first_name)) {
            $error .= "<li>The first name is mandatory</li>";
        }

        if (empty($last_name)) {
            $error .= "<li>The last name is mandatory</li>";
        }

        if (empty($email)) {
            $error .= "<li>The e-mail address is mandatory</li>";
        }

        if (empty($password)) {
            $error .= "<li>The password is mandatory</li>";
        }

        if (empty($phone)) {
            $error .= "<li>The phone is mandatory</li>";
        }

        if (empty($street)) {
            $error .= "<li>The street is mandatory</li>";
        }

        if (empty($postal_code)) {
            $error .= "<li>The postal code is mandatory</li>";
        }

        if (empty($city)) {
            $error .= "<li>The city is mandatory</li>";
        }

        if (empty($country)) {
            $error .= "<li>The country is mandatory</li>";
        }

        if (!empty($password) && strlen($password) < 6) {
            $error .= "<li>The password cant be less than 6 characters</li>";
        }

        if ($confirmPassword !== $password) {
            $error .= "<li>The confirmed password doesnt match</li>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "<li>Unvalid e-mail address</li>";
        }

        if ($error) {
            $msg = "<ul class='error_msg'>{$error}</ul>";
        }

        if (empty($error)) {
            try {
                $query = "
                    INSERT INTO users (username, password, email, phone, street, postal_code, city, country, first_name, last_name)
                    VALUES (:username, :password, :email, :phone, :street, :postal_code, :city, :country, :first_name, :last_name);
                ";

                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':password', $password);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':phone', $phone);
                $stmt->bindValue(':street', $street);
                $stmt->bindValue(':postal_code', $postal_code);
                $stmt->bindValue(':city', $city);
                $stmt->bindValue(':country', $country);
                $stmt->bindValue(':first_name', $first_name);
                $stmt->bindValue(':last_name', $last_name);
                $result = $stmt->execute();
            } catch(\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }

            if ($result) {
                $msg = '<div class="success_msg">Your account is successfully made. </div>';
            } else {
                $msg = '<div class="error_msg">The signup failed. Please try again.</div>';
            }
        }
    }
        
    $users = fetchAllUsers(); //refakturerad 

?>

	<div>
		<form action="../edit.php?" method="GET">
			<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
			<input type="submit" value="My page" class="btn">
		</form>
	</div>

    <form action="admin.php">
        <button class="contentBtn">Back</button>
    </form>
    
    <div class="box">
        <ul class="lists">
            <?php foreach ($users as $key => $texterino) { ?>
                <li class="userList">
                    <h2>All users</h2>
                    <section>
                        Username: <?=htmlentities($texterino['username'])?>
                    </section>

                    <section>
                        First name: <?=htmlentities($texterino['first_name'])?>
                    </section>

                    <br>

                    <section>
                        Last name:  <?=htmlentities($texterino['last_name'])?>
                    </section>

                    <br>

                    <section>
                        Email:  <?=htmlentities($texterino['email'])?>
                    </section>

                    <br>

                    <section>
                        Password: <?=htmlentities($texterino['password'])?>
                    </section>

                    <br>

                    <section>
                        Phone: <?=htmlentities($texterino['phone'])?>
                    </section>

                    <br>

                    <section>
                        Street:  <?=htmlentities($texterino['street'])?>
                    </section>

                    <br>

                    <section>
                        Postal Code:  <?=htmlentities($texterino['postal_code'])?>
                    </section>

                    <br>

                    <section>
                        City:  <?=htmlentities($texterino['city'])?>
                    </section>
                    
                    <br>

                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?=$texterino['id']?>">
                        <input type="submit" name="deleteBtn" value="Ta Bort" class="btn">
                    </form>
                    
                    <form action="updateuser.php?" method="GET">
                        <input type="hidden" name="id" value="<?=$texterino['id']?>">
                        <input type="submit" value="Uppdatera" class="btn">
                    </form>
                
                </li>
                
                <br>
                <br>
                
            <?php } ?> 
        </ul> 

    </div>
    
    <hr>

<?php include('layout/footer.php'); ?>