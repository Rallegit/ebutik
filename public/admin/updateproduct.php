<?php
    require('../../src/config.php');

    if (!isset($_SESSION['username'])) {
        header('Location: login.php?mustLogin');
        exit;
    }

    require('../../src/dbconnect.php');

    $title       = '';
    $description = '';
    $price       = '';
    $img_url     = '';
    $error       = '';
    $msg         = '';

    if (isset($_POST['add'])) {

        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $price = trim($_POST['price']);

        if (empty($title)) {
            $error .= "<div>Title is mandatory</div>";
        }

        if (empty($description)) {
            $error .= "<div>Description is mandatory</div>";
        }

        if (empty($price)) {
            $error .= "<div>Price is mandatory</div>";
        }

        if ($error) {
            $msg = "<div class='errors'>{$error}</div>";
        }

        if (empty($error)) {

            try {
                $query = "
                UPDATE products
                SET title = :title, description = :description, price = :price
                WHERE id = :id
                ";

                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':price', $price);
                $stmt->bindValue(':id', $_GET['id']);
                $products = $stmt->execute();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
            }
            
            if ($products) {
                $msg = '<div class="success">Your product is now updated.</div>';
            } 
        }
    }

    try {
        $query = "
            SELECT * FROM products
            WHERE id = :id;
        ";
        
        $stmt = $dbconnect->prepare($query);
        $stmt->bindvalue(':id', $_GET['id']);
        $stmt->execute();
        $products = $stmt->fetch();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    

?>


<?php include('layout/header.php'); ?>

<div class="box">
    
    <div class="insidebox">
        <h1>Update</h1>
        <form action="#" method="POST">
            <input type="text" name="title" value="<?=htmlentities($products['title'])?>">
            <br>
            <textarea type="text" name="description" rows="10" cols="60" style="resize:none"><?=htmlentities($products['description'])?></textarea>
            <br>
            <input type="text" name="price" value="<?=htmlentities($products['price'])?>">
            <br>
            <button class="btn" name="add">Update</button>
            <a href="../index.php">Back</a>
        </form>

    </div>
    </ul>
    
</div>
<div class="box2">
    <?=$msg?>
</div>




<?php include('layout/footer.php'); ?>