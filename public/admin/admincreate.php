<?php
    require('../../src/dbconnect.php');
    require('../../src/config.php');

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
                $msg = '<div class="alert alert-success" role="alert">Your account is successfully made. </div>';
            } else {
                $msg = '<div class="alert alert-danger" role="alert">The signup failed. Please try again.</div>';
            }
        }
    }
?>
    <?php include('layout/header.php'); ?>

    <div class="d-flex justify-content-around bg-dark mb-5">
        <form action="createproducts.php?">
            <input type="submit" value="Add Product" class="btn text-light">
        </form>

        <form action="users.php">
            <input type="submit" value="User-list" class="btn text-light">
        </form>
        <form action="admincreate.php">
            <input type="submit" value="Create user" class="btn text-light">
        </form>
        <form action="admin.php">
            <button class="contentBtn">Back</button>
        </form>
    </div>

    <div class="d-flex justify-content-center">
        <?=$msg?>
    </div>
    <div class="d-flex justify-content-center">
        <table class="table-light card p-5 rounded border-0 shadow">
            <tr>
            <form method="POST" action="#">       
                
                <td>
                    <label for="input1">Username:</label> <br>
                    <input type="text" class="text" name="username" value="<?=htmlentities($username)?>">
                </td>

                <td>
                    <label for="input1">E-mail address:</label> <br>
                    <input type="text" class="text" name="email" value="<?=htmlentities($email)?>">
                </td>

            </tr>
            <tr>    
                <td>
                    <label for="input2">Password:</label> <br>
                    <input type="password" class="text" name="password">
                </td>

                <td>
                    <label for="input2">Confirm password:</label> <br>
                    <input type="password" class="text" name="confirmPassword">
                </td>
                
                <tr>
                    <td>
                        <label for="input3">First name:</label> <br>
                        <input type="text" class="text" name="first_name" value="<?=htmlentities($first_name)?>">
                    </td>
                
                <td>
                    <label for="input4">Last name:</label> <br>
                    <input type="text" class="text" name="last_name" value="<?=htmlentities($last_name)?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="input8">Phone:</label> <br>
                    <input type="text" class="text" name="phone" value="<?=htmlentities($phone)?>">
                </td>

                <td>
                    <label for="input5">Street:</label> <br>
                    <input type="text" class="text" name="street" value="<?=htmlentities($street)?>">         
                </td>
            </tr>
            </tr>

                <td>
                    <label for="input6">City</label> <br>
                    <input type="text" class="text" name="city" value="<?=htmlentities($city)?>">
                </td>  

                <td>
                    <label for="input7">Postal code</label> <br>
                    <input type="text" class="text" name="postal_code"value="<?=htmlentities($postal_code)?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="country">Country</label><br>
                    <select id="country" name="country">
                        <option value="norway">Norway</option>
                        <option value="denmark">Denmark</option>
                        <option value="finland">Finland</option>
                        <option value="sweden">Sweden</option>
                    </select> 
            </tr>
            <tr>
                <td>
                    <input type="submit" name="signup" value="Add new user" class="btn bg-dark text-light mt-2"> 
                </td>
            </tr>   
            </form>
        </table>
    </div>
<?php include('layout/footer.php'); ?>

