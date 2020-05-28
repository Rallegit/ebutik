<?php
    require('../src/config.php');
    require('../src/app/users_functions.php');
    require('../src/dbconnect.php');

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

        if (empty($error)) {
            $userData = [
                'username'      => $username,
                'password'      => $password,
                'email'         => $email,
                'phone'         => $phone,
                'street'        => $street,
                'postal_code'   => $postal_code,
                'city'          => $city,
                'country'       => $country,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
            ];

            $result = add($userData); // refakturerad å klar!!!!!

            if ($result) {
                $msg = '<div class="success_msg">The account was successfully created</div>';
            } else {
                $msg = '<div class="error_msg">Failed to create an account. Please try again.</div>';
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
                <label for="input2">Lösenord:</label> <br>
                <input type="password" class="text" name="password">
            </p>

            <p>
                <label for="input2">Bekräfta lösenord:</label> <br>
                <input type="password" class="text" name="confirmPassword">
            </p>
            
            <p>
                <label for="input3">First name:</label> <br>
                <input type="text" class="text" name="first_name" value="<?=htmlentities($first_name)?>">
            </p>
            
            <p>
               <label for="input4">Last name:</label> <br>
               <input type="text" class="text" name="last_name" value="<?=htmlentities($last_name)?>">
           </p>
           <p>
                <label for="input8">Phone:</label> <br>
                <input type="text" class="text" name="phone" value="<?=htmlentities($phone)?>">
            </p>  
           <p>
               <label for="input5">Street:</label> <br>
               <input type="text" class="text" name="street" value="<?=htmlentities($street)?>">         
           </p>

            <p>
                <label for="input6">City</label> <br>
                <input type="text" class="text" name="city" value="<?=htmlentities($city)?>">
            </p>  

            <p>
                <label for="input7">Postal code</label> <br>
                <input type="text" class="text" name="postal_code"value="<?=htmlentities($postal_code)?>">
            </p>
              
            <label for="country">Country</label>
            <select id="country" name="country">
                <option value="trump">TrumpNation</option>
                <option value="norway">Norway</option>
                <option value="denmark">Denmark</option>
                <option value="finland">Finland</option>
                <option value="sweden">Sweden</option>
            </select>

                <input type="submit" name="signup" value="Register">
            
        </form>
    </div>

<?php include('layout/footer.php'); ?>
