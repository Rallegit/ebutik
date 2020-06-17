
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
                WHERE id = :id;
                ";
            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':id', $articleId);
            $stmt->execute();
            $article = $stmt->fetch();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }
        
        echo json_encode($article);
        
        
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
            if (isset($_SESSION['items'][$articleId])) {
                $_SESSION['items'][$articleId]['quantity'] += $quantity;
            } else {
                $_SESSION['items'] += $articleItem;
            }
        }
    }

    header('Location: products.php');
    exit;
?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- CUSTOM JavaScript -->
    <script src="js/main.js"></script>