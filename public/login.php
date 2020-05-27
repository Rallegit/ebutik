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
        $msg = '<div class="error_msg">Error! You need to log in to view this page. Please log in och sign up.</div>';
    }

    if (isset($_GET['logout'])) {
        $msg = '<div class="success_msg">You have logged out!</div>';
    }

    if (isset($_POST['doLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

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

        // If user exists AND password is correct, will be considered true. Meaning you are logged in
        if ($user && $password === $user['password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit;
        } else {
            // If user doesnt Exist, will be considered false
            // OR if user exists but password is wrong. will also be considered false
            $msg = '<div class="error_msg">Fel inloggningsuppgifter. Var snäll och försök igen.</div>';
        }
    }
?>

<?php include('layout/header.php'); ?>

    <div id="form">  
        <form method="POST" action="#">
    
            <?=$msg?>
            
            <p>
                <label for="input1">Username:</label> <br>
                <input type="text" class="text" name="username">
            </p>

            <p>
                <label for="input2">Password:</label> <br>
                <input type="password" class="text" name="password">
            </p>

            <p>
                <input type="submit" name="doLogin" value="Log in">
            </p>

    </div>

<?php include('layout/footer.php'); ?>
