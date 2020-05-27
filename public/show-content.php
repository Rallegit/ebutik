<?php
    require('../src/dbconnect.php');
    require('../src/config.php');
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

// Content sida - här ska alla inlägg visas upp för besökare för att sedan 
// klicka sig vidare till att se hela inlägget.

 if (isset($_POST['deleteBtn'])) {
 
 
    if(empty($title)){
        try {
            $query = "
            DELETE FROM products
            WHERE id = :id;
            ";
  
            $stmt = $dbconnect->prepare($query);
            $stmt->bindValue(':id', $_POST['id']);
            $stmt->execute();
      }     catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
      }
    }
}

    
    $title          = '';
    $description    = '';
    $price          = '';
    $error          = '';
    $msg            = '';
    $id             = $_GET["id"];

    if (isset($_POST['send'])) {
        $title = trim($_POST['title']);
        $description = trim(substr(($_POST['description']),0 , 10));
        $price = trim($_POST['price']);

        if (empty($title)) {
            $error .= "<li>Title is mandatory</li>";
        }

        if (empty($description)) {
            $error .= "<li>Description is mandatory</li>";
        }

        if (empty($price)) {
            $error .= "<li>Price is mandatory</li>";
        }

        if ($error) {
            $msg = "<ul class='warningerror'>{$error}</ul>";
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
                $stmt->execute();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
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
    }   catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    




    
?>

<?php include('layout/header.php'); ?>

    <div class="box-content">
        <form action="#" method="POST">
            <li class="blogOne">
                <h1>
                 <?=htmlentities($products['title'])?>
                </h1>

                <br>

                <section>
                    <?=htmlentities($products['description'])?>
                </section>
                
                <br>

                <p>
                    <?=htmlentities ($products['price'])?>
                </p>

                <br>
            </li>          
        </form>
    </div>

    <div class="box2">
        <form action="products.php">
            <button class="contentBtn">Back to products</button>
        </form>
    </div>

<?php include('layout/footer.php'); ?>