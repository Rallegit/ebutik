<?php
    require('../src/dbconnect.php');
    require('../src/config.php');

    //echo "<pre>";
    //print_r($_POST);
    //echo "</pre>";

    if (isset($_POST['deleteBtn'])) {
        deleteProduct($_POST['id']); //refakturerad
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
    
    $product = fetchProductById($_GET['id']);//refakturerad
    
?>

    <?php include('layout/header.php'); ?>

    <div class="d-flex flex-column pt-4 pb-4 border">
        <form action="#" method="POST">
            <div class="d-flex align-content-center shadow-sm p-3 bg-white rounded">
                <div class="col-2">
                    <img src="admin/<?=$article['img_url']?>" style="width:200px;height:auto;">
                </div>

                <div class="col-2">
                 <?=htmlentities($product['title'])?>
                </div>

                <div class="wp-100"></div>

                <div class="col-4">
                    <?=htmlentities($product['description'])?>
                </div>
                
                <div class="wp-100"></div>
                

                <div class="col-2">
                    <?=htmlentities ($product['price'])?>
                </div>

                <div class="wp-100"></div>

            </div>   
        </form>

        <form action="products.php">
            <div class="col-2">
                <!-- <button class="contentBtn">Back to products</button> -->
                <input type="submit" class="form-control" value="Back to products">
            </div>
        </form>
    </div>


<?php include('layout/footer.php'); ?>