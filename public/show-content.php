<?php
    require('../src/dbconnect.php');
    require('../src/config.php');

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

        // if (empty($title)) {
        //     $error .= "<li>Title is mandatory</li>";
        // }

        // if (empty($description)) {
        //     $error .= "<li>Description is mandatory</li>";
        // }

        // if (empty($price)) {
        //     $error .= "<li>Price is mandatory</li>";
        // }

        // if ($error) {
        //     $msg = "<ul class='warningerror'>{$error}</ul>";
        // }

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

    <div class="d-flex flex-column mt-5 ml-5" id="productPage">
        <form action="#" method="POST">
            <div class="d-flex justify-content-center ml-5">
                <div class="col">
                    <img src="admin/<?=$product['img_url']?>" style="width:90px;height:auto;">
                </div>

                <div class="d-flex flex-column">
                    <div class="col-7">
                        <h1><?=htmlentities($product['title'])?></h1> <br>
                        <p><?=htmlentities($product['description'])?></p>
                    </div>
                
                    <div class="col-5 font-weight-bold">
                        <h3><?=htmlentities ($product['price'])?>SEK</h3>
                    </div>
                </div>
            </div>   
        </form>

        <form action="products.php">
            <div class="col-2 mt-3">
               <input type="submit" class="form-control" value="Back to products">
            </div>
        </form>
    </div>


<?php include('layout/footer.php'); ?>