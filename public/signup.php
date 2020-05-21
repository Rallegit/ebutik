<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    $username  = '';
    $email     = '';
    $error     = '';
    $msg       = '';
    
    if (isset($_POST['signup'])) {
        $first_name        = trim($_POST['first_name']);
        $last_name        = trim($_POST['last_name']);
        $email           = trim($_POST['email']);
        $password        = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirmPassword']);
        $phone        = trim($_POST['phone']);
        $street        = trim($_POST['street']);
        $postal_code        = trim($_POST['postal_code']);
        $city        = trim($_POST['city']);
        $country        = trim($_POST['country']);

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
                    INSERT INTO users (username, password, email)
                    VALUES (:username, :password, :email);
                ";

                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':password', $password);
                $stmt->bindValue(':email', $email);
                $result = $stmt->execute();
            } catch(\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }

            if ($result) {
                $msg = '<div class="success_msg">Ditt konto är nu skapat</div>';
            } else {
                $msg = '<div class="error_msg">Registreringen misslyckades. Var snäll och försök igen senare!</div>';
            }
        }
    }

?>

<?php include('layout/header.php'); ?>

    <div id="form"> 
        <form method="POST" action="#">       
            
            <?=$msg?>
            
            <p>
                <label for="input1">Username:</label> <br>
                <input type="text" class="text" name="username" value="<?=htmlentities($username)?>">
            </p>

            <p>
                <label for="input1">E-mail address:</label> <br>
                <input type="text" class="text" name="email" value="<?=htmlentities($email)?>">
            </p>

            <p>
                <label for="input2">Password:</label> <br>
                <input type="password" class="text" name="password">
            </p>

            <p>
                <label for="input2">Confirm password:</label> <br>
                <input type="password" class="text" name="confirmPassword">
            </p>

            <p>
                <input type="submit" name="signup" value="Register">
            </p>
        </form>
    </div>

<?php include('layout/footer.php'); ?>
