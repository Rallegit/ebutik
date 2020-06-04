<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    echo"<pre>";
    print_r($_POST);
    echo"<pre>";

    if(!empty($_POST['quantity'])) {
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
            $article = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        
        if ($article) {
            $article = array_merge($article, ['quantity' => $quantity]);
            echo"<pre>";
            print_r($article);
            echo"<pre>";
            $articleItem = [$articleId => $article];
        }

        if (empty($_SESSION['items'])) {
            $_SESSION['items'] = $articleItem;
        } else {
            $_SESSION['items'] = $articleItem;
            if (isset($_SESSION['items'][$articleId])) {
                $_SESSION['items'][$articleId]['quantity'] += $quantity;
            } else {
                $_SESSION['items'] += $articleItem;
            }
        } 
    }

    // echo "<pre>";
    // print_r($_SERVER);
    // echo "<pre>";
    // exit;
  //  header('Location: products.php');
  //  exit;
?>

