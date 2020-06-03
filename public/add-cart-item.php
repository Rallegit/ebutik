<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    echo"<pre>";
    print_r($_POST);
    echo"<pre>";

    if(!empty($_POST['quantity'])){
        $articleId = (int) $_POST['articleId'];
        $quantity = (int) $_POST['quantity'];

        try{
            $query = "
            SELECT * FROM products
            WHERE id = id;
            ";
            $stmt = $dbconnect->prepare($query);
            $stmt->bindvalue(':id', $_POST['articleId']);
            $stmt->execute();
            $product = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        
        if ($product) {
                $product = array_merge($product, ['quantity' => $quantity]);
                echo"<pre>";
                print_r($product);
                echo"<pre>";
                $articleItem = ['$articleId => $product'];
                $_SESSION['items'] = $articleItem; 
        }

        if (empty($_SESSION['items'])) {
            $_SESSION['items'] = $articleItem;
        } else {
            //$_SESSION['items] = $articleItem;
            if (isset($_SESSION['items']['articleId'])) {
                $_SESSION['items'][$articleId]['quantity'] += $quantity;
            } else {
                $_SESSION['items'] += $articleItem;
            }
        } 
    }

    header('Location: products.php');
    exit;
?>

