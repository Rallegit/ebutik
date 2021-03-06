<?php 
    require('../../src/config.php');
    checkLoginSession();
    require('../../src/dbconnect.php');

    // $msg       = '';
    if (isset($_POST['deleteBtn'])) {
 
        if(empty($users)){
            try {
                $query = "
                DELETE FROM users
                WHERE id = :id;
                ";
      
                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':id', $_POST['id']);
                $result = $stmt->execute();
          }     catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
          }
            session_start();
            $_SESSION["successmsg"]='User deleted!';
            session_destroy();
            header('Location: index.php');
            exit;

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
    
    if (isset($_POST['signup'])) {
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

        try {
            $query = "
            UPDATE users
            SET username = :username, password = :password, email = :email, phone = :phone, street = :street, postal_code = :postal_code, city = :city, country = :country, first_name = :first_name, last_name = :last_name 
            WHERE id = :id
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
                 $stmt->bindValue(':id', $_GET['id']);
                 $result = $stmt->execute();
            }   catch(\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
                }
            if ($result) {
                $msg = '<div class="success">User updated</div>';
                } 
    }

    $account = fetchUserById($_GET['id']); //refakturerad

?>

    <form action="admin.php">
        <button class="contentBtn">Back</button>
    </form>

    <div id="form"> 
        <form action="#" method="POST">       
        
            <!-- Visa errormeddelanden -->
            <?=$msg?>
            
            <h1>Update user</h1>
            <p>
                <label for="input1">Username:</label> <br>
                <input type="text" class="text" name="username" value="<?=htmlentities($account['username'])?>">
            </p>

            <p>
                <label for="input1">E-mail address:</label> <br>
                <input type="texter" class="texter" name="email" value="<?=htmlentities($account['email'])?>">
            </p>

            <p>
                <label for="input1">Password:</label> <br>
                <input type="password" class="text" name="password" value="<?=htmlentities($account['password'])?>"
                >
            </p>

            <p>
                <label for="input2">Confirm password:</label> <br>
                <input type="password" class="text" name="confirmPassword" value="<?=htmlentities($account['password'])?>">
            </p>
            
            <p>
                <label for="input3">First name:</label> <br>
                <input type="text" class="text" name="first_name" value="<?=htmlentities($account['first_name'])?>">
            </p>
            
            <p>
                <label for="input4">Last name:</label> <br>
                <input type="text" class="text" name="last_name" value="<?=htmlentities($account['last_name'])?>">
            </p>
            <p>
                <label for="input5">Phone:</label> <br>
                <input type="text" class="text" name="phone" value="<?=htmlentities($account['phone'])?>">
            </p>  
            <p>
                <label for="input6">Street:</label> <br>
                <input type="text" class="text" name="street" value="<?=htmlentities($account['street'])?>">     
            </p>

            <p>
                <label for="input7">City</label> <br>
                <input type="text" class="text" name="city" value="<?=htmlentities($account['city'])?>">
            </p>  

            <p>
                <label for="input8">Postal code</label> <br>
                <input type="text" class="text" name="postal_code" value="<?=htmlentities($account['postal_code'])?>">
            </p>

            <?php
                $countries = [
                    'norway' => 'Norway',
                    'denmark' => 'Denmark',
                    'finland' => 'Finland',
                    'sweden' => 'Sweden',
                ];
            ?>

            <label for="country">Country</label>
            <select id="country" name="country">
                <?php foreach ($countries as $countryKey => $countryName) { ?> 
                   <?php if ($konto['country'] == $countryKey){ ?>
                        <option selected value="<?=$countryKey?>"> <?=$countryName?></option> 
                   <?php } else { ?>
                        <option value="<?=$countryKey?>"> <?=$countryName?></option>
                 <?php   } ?>
                <?php }  ?>
            </select>
            
            <p>
                <input action="users.php" type="submit" name="signup" value="Uppdatera">
            </p>
            
            <form action="index.php?" method="POST">
                <input type="hidden" name="id" value="<?=$_SESSION['id']?>">
                <input type="submit" name="deleteBtn" value="Delete user">
            </form>
           
        </form>
    </div>
    
<?php include('layout/footer.php'); ?>


