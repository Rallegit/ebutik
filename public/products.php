<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    $title       = '';
    $description = '';
    $price       = '';
    $img_url     = '';
    $error       = '';
    $msg         = '';

    if (isset($_POST['add'])) {
        $img_url     = trim($_POST['img_url']);
        $title       = trim($_POST['title']);
        $description = trim(($_POST['description']));
        $price       = trim($_POST['price']);

        if (empty($error)) {

            try {
                $query = "
                INSERT INTO products (title, description, price, img_url)
                VALUES (:title, :description, :price, :img_url);
                ";

                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':img_url', $img_url);
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':price', $price);
                $stmt->execute();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
            }
        }
    }

    $products = fetchAllProducts();
   
?>

    <?php include('layout/header.php'); ?>
    
    <div class="d-flex flex-wrap justify-content-center" id="productPage">
        <?php foreach ($products as $key => $article) { ?>
            <div class="col-xs-12 col-md-4 col-lg-3 mt-5 mx-3 innerProductPage">
                <form action="#" method="GET">
                    <input type="hidden" name="id" value="<?=$article['id']?>">
                </form>
                
                <img class="rounded mx-auto d-block" src="admin/<?=$article['img_url']?>" style="width:70px;height:200px;">

                <div class="col-lg-9 mx-auto mt-4">
                    <h5 class="m-0"><?=substr(htmlentities ($article['title']),0, 20)?></h5> <br>
               
                    <?=substr(htmlentities ($article['description']),0, 30)?> <br>

                    <h6 class="mb-4 align-self-end"><?=htmlentities ($article['price'])?> SEK</h6>
                </div>
 
                <form action="show-content.php" method="GET" class="col-lg-9 mx-auto">
                    <input type="hidden" name="id" value="<?=$article['id']?>">
                    <input type="submit" class="form-control" value="Read more">
                </form>
   
                <form action="add-cart-item.php" method="POST" class="col-lg-9 mx-auto">
                    <input type="hidden" name="articleId" value="<?=$article['id']?>">
                    <input type="number" name="quantity" class="form-control" value="1" min="0">
                    <div>
                    <input type="submit" name="addToCart" class="form-control" id="addBtn" value="Add to cart">
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
    
    <?php include('layout/footer.php'); ?>