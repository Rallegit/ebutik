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
  
        if (empty($title)) {
            $error .= "<li>Rubrik är obligatoriskt</li>";
        }

        if (empty($description)) {
            $error .= "<li>Inlägg är obligatoriskt</li>";
        }

        if (empty($price)) {
            $error .= "<li>Pris är obligatoriskt</li>";
        }

        if ($error) {
            $msg = "<ul class='warningerror'>{$error}</ul>";
        }

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

    $products = fetchAllProducts(); // refakturerat
   
?>

    <?php include('layout/header.php'); ?>
    
    <div class="d-flex flex-wrap mt-5">
        <?php foreach ($products as $key => $article) { ?>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mt-5">
                <form action="#" method="GET">
                    <input type="hidden" name="id" value="<?=$article['id']?>">
                </form>
                
                <img src="admin/<?=$article['img_url']?>" style="width:200px;height:auto;">

                <p><?=htmlentities($article['title'])?></p>
               
                <p> <?=substr(htmlentities ($article['description']),0, 30)?></p>

                <p><?=htmlentities ($article['price'])?> SEK</p>
 
                <form action="show-content.php" method="GET">
                    <input type="hidden" name="id" value="<?=$article['id']?>">
                    <input type="submit" class="form-control mt-3" value="Read more">
                </form>
   
                <form action="add-cart-item.php" method="POST">
                    <input type="hidden" name="articleId" value="<?=$article['id']?>">
                    <input type="number" name="quantity" class="form-control mb-3" value="1" min="0">
                    <input type="submit" name="addToCart" class="form-control" value="Add to cart">
                </form>
            </div>
        <?php } ?>
    </div>
    
    <?php include('layout/footer.php'); ?>