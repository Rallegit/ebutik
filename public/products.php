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
                INSERT INTO products (img_url, title, description, price)
                VALUES (:img_url, :title, :description, :price);
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
    
    <div class="box-content">
        <ul class="lists">
            <div class="box2">
            
                <?php foreach ($products as $key => $article) { ?>
                <li class="blogOne">

                    <!-- Image SKA VA HEEEEEEER -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="add">
                        <img src="<?=$imgUrl?>">
                    </form>

                    <h2>
                        <form action="#" method="GET">
                            <input type="hidden" name="id" value="<?=$article['id']?>">
                            <?=htmlentities($article['title'])?>
                        </form>
                    </h2>

                    <br>

                    <p>
                        <?=substr(htmlentities ($article['description']),0, 30)?>
                    </p>

                    <br>
                    <p>
                        <?=htmlentities ($article['price'])?>
                    </p>

                    <br>

                    <p>
                        <form action="show-content.php" method="GET">
                            <input type="hidden" name="id" value="<?=$article['id']?>">
                            <button type="submit">Read More</button>
                        </form>
                    </p>
                <?php } ?>
            </div>
        </ul>
    </div>
    
<?php include('layout/footer.php'); ?>