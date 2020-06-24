<?php
    require('../../src/config.php');
    
    checkLoginSession();

    require('../../src/dbconnect.php');
    
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

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container-fluid p-0">

        <div class="d-flex justify-content-center">
            <div class="p-2">
                <form action="../edit.php?" method="GET">
                    <input type="hidden" name="id" value="<?=$_SESSION['id']?>">
                    <input type="submit" value="My page" class="btn bg-dark text-light">
                </form>
            </div>
            <div class="p-2">
                <form action="admin.php">
                    <button class="contentBtn btn bg-dark text-light">Back</button>
                </form>
            </div>
        </div>
        
    
    <h2>All users</h2>
    <table class="table table-dark userList">
        <thead>
            <tr>
                <td>Username</td>
                <td>First name</td>
                <td>Last name</td>
                <td>E-mail</td>
                <td>Password</td>
                <td>Phone</td>
                <td>Street</td>
                <td>Postal code</td>
                <td>City</td>
                <td>Country</td>
                <td>Register date</td>
            </tr>
        </thead>
        <?php foreach (array_reverse($users) as $texterino) { ?>
        <tbody>
            </tr>
                <td>
                    <?=htmlentities($texterino['username'])?>
                </td>
                <td>
                    <?=htmlentities($texterino['first_name'])?>
                </td>
                <td>
                    <?=htmlentities($texterino['last_name'])?>
                </td>
                <td>   
                    <?=htmlentities($texterino['email'])?>
                </td>
                <td>
                    <?=htmlentities($texterino['password'])?>
                
                </td>
                <td>
                    <?=htmlentities($texterino['phone'])?>
                </td>
                <td>
                    <?=htmlentities($texterino['street'])?>
                </td>
                <td>
                    <?=htmlentities($texterino['postal_code'])?>
                </td>
                <td>
                    <?=htmlentities($texterino['city'])?>
                </td>
                <td>
                    <?=htmlentities($texterino['country'])?>
                </td>
                <td>
                    <?=htmlentities($texterino['register_date'])?>
                </td>
                <td>   
                    <form method="POST">
                        <input type="hidden" name="id" value="<?=$texterino['id']?>">
                        <input type="submit" name="deleteUserBtn" value="Delete" class="delete-user-btn btn bg-light text-dark mb-2">
                    </form>
                </td>
                <td>
                    <form action="updateuser.php?" method="GET">
                        <input type="hidden" name="id" value="<?=$texterino['id']?>">
                        <input type="submit" value="Update" class="btn bg-light text-dark mb-2">
                    </form>
                </td>
            <?php } ?> 
        </tbody>               
    </table>
<?php include('layout/footer.php'); ?> 