<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    // // echo $_GET
    // debug($_GET);

    // // echo $_POST
    // debug($_POST);

    // // echo $_SESSION
    // debug($_SESSION);

    $msg = "";
    if (isset($_GET['mustLogin'])) {
        $msg = '<div class="alert alert-danger" role="alert">Error! You need to log in to view this page. Please log in och sign up.</div>';
    }

    if (isset($_GET['logout'])) {
        $msg = '<div class="alert alert-success" role="alert">You have logged out!</div>';
    }

    if (isset($_POST['doLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = fetchByUsername($username); //refakturerad

        if ($user && $password === $user['password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            redirect('index.php'); // refakturerad å KLAR!!! 

        } else {
            $msg = '<div class="alert alert-danger" role="alert">Fel inloggningsuppgifter. Var snäll och försök igen.</div>';
        }
    }
?>

<?php include('layout/header.php'); ?>

    <div class="d-flex justify-content-center mt-5">
        <form method="POST" action="#">
    
            <?=$msg?>
            
            <div class="col-6">
                <label for="input1">Username:</label> <br>
                <input type="text" class="text" name="username">
            </div>

            <div class="col-3 mt-2">
                <label for="input2">Password:</label> <br>
                <input type="password" class="text" name="password">
            </div>

            <div class="col-3 mt-3">
                <input type="submit" name="doLogin" value="Log in">
            </div>
        </form>
    </div>

<?php include('layout/footer.php'); ?>
