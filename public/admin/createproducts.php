<?php
    require('../../src/config.php');
    
    if (!isset($_SESSION['username'])) {
        header('Location: ../login.php?mustLogin');
        exit;
    }

    require('../../src/dbconnect.php');

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

    $title       = '';
    $description = '';
    $price       = '';
    $img_url     = '';
    $error       = '';
    $msg         = '';
    
    if (isset($_POST['add'])) {
        $title       = trim($_POST['title']);
        $description = trim($_POST['description']);
        $price       = trim($_POST['price']);

        if (empty($title)) {
            $error .= "<p>Title is mandatory</p>";
        }

        if (empty($description)) {
            $error .= "<p>Description is mandatory</p>";
        }

        if (empty($price)) {
            $error .= "<p>Price is mandatory</p>";
        }

        if ($error) {
            $msg = "<div class='errors'>{$error}</div>";
        }

        if (empty($error)) {

            try {
                $query = "
                INSERT INTO products (title, description, price)
                VALUES (:title, :description, :price);
                ";

                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':title', $title);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':price', $price);
                $products = $stmt->execute();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
            }
            if ($products) {
                $msg = '<p class="success">Your product are now posted. </p>';
            } 
        }
    }
        
    try {
        $query = "SELECT * FROM products;";
        $stmt = $dbconnect->query($query);
        $products = $stmt->fetchAll();
    }      catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }

?>
	<div>
		<form action="../edit.php?" method="GET">
			<input type="hidden" name="id" value="<?=$_SESSION['id']?>">
			<input type="submit" value="My page" class="btn">
		</form>
	</div>
    <form action="admin.php">
        <button class="contentBtn">Back</button>
    </form>

    <div class="box2">
        <div class="insidebox">

            <h1>Publish product</h1>
            <form action="" method="POST">

                <div class="inputone">
                    <input type="text" name="title" placeholder="Title">

                    <br>

                    <div class="file-upload-wrapper">
                        <input type="file" id="input-file-now" class="file-upload" />
                    </div>

                    <br>

                    <textarea type="text" name="description" placeholder="Description" rows="10" cols="60" style="resize:none"></textarea>

                    <br>
                    
                    <input type="text" name="price" placeholder="Price">
                    <button class="btn1" name="add">Add Product</button>
                </div>

            </form>

            <?=$msg?>
        </div>
    </div>
    
    <div class="box">
        <ul class="lists">
            <?php foreach ($products as $key => $article) { ?>
                <li class="blogOne">
                
                    <h2>
                        <?=htmlentities($article['title'])?>
                    </h2>

                    <br>

                    <section>
                        <?=htmlentities($article['description'])?>
                    </section>

                    <br>

                    <h3>
                        <?=htmlentities($article['price'])?>
                    </h3>

                    <br>
                    
                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?=$article['id']?>">
                        <input type="submit" name="deleteBtn" value="Ta Bort" class="btn">
                    </form>
                    
                    <form action="updateproduct.php?" method="GET">
                        <input type="hidden" name="id" value="<?=$article['id']?>">
                        <input type="submit" value="Uppdatera" class="btn">
                    </form>
                
                </li>
                
                <br>
                <br>
                
                <div class="bordertext"></div>
            <?php } ?> 
        </ul> 
    
    </div>


<?php include('layout/footer.php'); ?>