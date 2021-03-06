<?php
    require('../src/config.php');
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

            $result = add($userData);

            if ($result) {
                $msg = '<div class="alert alert-success" role="alert">The account was successfully created</div>';
            } else {
                $msg = '<div class="alert alert-danger" role="alert">Failed to create an account. Please try again.</div>';
            }
        }

    }

?>

<?php include('layout/header.php'); ?>

    <div class="d-flex justify-content-center ">
        <?=$msg?>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <table class="table-light card p-5 rounded border-0 shadow">
            <form method="POST" action="#">
                <tr>
                    <td>
                        <label for="input1">Username:</label><br>
                        <input type="text" class="text form-control" name="username" value="<?=htmlentities($username)?>">
                    </td>
                    <td>
                        <label for="input2">E-mail address:</label><br>
                        <input type="text" class="text form-control" name="email" value="<?=htmlentities($email)?>">
                    </td>
                    
                </tr>
                <tr>    
                    <td>
                        <label for="input3">Lösenord:</label><br>
                        <input type="password" class="text form-control" name="password">
                    </td>

                    <td>
                        <label for="input4">Bekräfta lösenord:</label><br>
                        <input type="password" class="text form-control" name="confirmPassword">
                    </td>
                </tr>
                <tr>    
                    <td>
                        <label for="input5">First name:</label><br>
                        <input type="text" class="text form-control" name="first_name" value="<?=htmlentities($first_name)?>">
                    </td>
                    <td>
                        <label for="input6">Last name:</label><br>
                        <input type="text" class="text form-control" name="last_name" value="<?=htmlentities($last_name)?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="input7">Phone:</label><br>
                        <input type="text" class="text form-control" name="phone" value="<?=htmlentities($phone)?>">
                    </td>
                        <td>
                        <label for="input8">Street:</label><br>
                        <input type="text" class="text form-control" name="street" value="<?=htmlentities($street)?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="input9">City</label><br>
                        <input type="text" class="text form-control" name="city" value="<?=htmlentities($city)?>">
                    </td>

                    <td>
                        <label for="input7">Postal code</label><br>
                        <input type="text" class="text form-control" name="postal_code"value="<?=htmlentities($postal_code)?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="country">Country</label><br>
                        <select id="country" name="country" class="form-control">
                            <option value="norway">Norway</option>
                            <option value="denmark">Denmark</option>
                            <option value="finland">Finland</option>
                            <option value="sweden">Sweden</option>
                        </select>
                    </td>
                </tr>
                <br>
                <tr>
                    <td>
                        <input type="submit" name="signup" value="Sign Up" class="btn btn-dark text-light mt-4 d-block">
                    </td>
                <tr>
            </table>
            </form>
        </div>
    </div>

<?php include('layout/footer.php'); ?>
