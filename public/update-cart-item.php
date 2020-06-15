<?php
    require('../src/config.php');

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if(!empty($_POST['articleId'])
        && !empty($_POST['quantity'])
        && isset($_SESSION['items'][$_POST['articleId']])
    ) {
        $_SESSION['items'][$_POST['articleId']]['quantity'] = $_POST['quantity'];
    }

    header('Location: checkout.php');
    exit;

?>

