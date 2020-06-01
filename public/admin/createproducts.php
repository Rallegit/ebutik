<?php
    require('../../src/config.php');
    
    checkLoginSession(); //refakturerad

    require('../../src/dbconnect.php');

    if (isset($_POST['deleteBtn'])) {
        deleteProduct($_POST['id']); //refakturerad
    }

    $title       = '';
    $description = '';
    $price       = '';
    $error       = '';
    $msg         = '';
    // $img_url     = '';
    
    if (isset($_POST['add'])) {
        $title       = trim($_POST['title']);
        $description = trim($_POST['description']);
        $price       = trim($_POST['price']);
    // $img_url     = trim($_POST['img_url']);
        
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
                // $stmt->bindValue(':img_url', $img_url);
                $products = $stmt->execute();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
            }
            if ($products) {
                $msg = '<p class="success">Your product are now posted. </p>';
            } 
        }
    }
        
    $products = fetchAllProducts(); // refakturerat

    // UPLOAD IMAGE --->
    // checking if the form has been submitted
    $msg            = "";
    $error          = "";
    $newPathAndName = "";
    $img_url        = "";

    if(isset($_POST['add'])){

        // Validation for file upload starts here
        if(is_uploaded_file($_FILES['upload']['tmp_name'])) {
            //this is the actual name of the file
            $fileName = $_FILES['upload']['name'];
            //this is the file type
            $fileType = $_FILES['upload']['type'];
            //this is the temporary name of the file
            $fileTempName = $_FILES['upload']['tmp_name'];
            //this is the path where you want to save the actual file
            $path = "img/";
            //this is the actual path and actual name of the file
            $newPathAndName = $path . $fileName;

            // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
            // Check MIME Type by yourself.
            $allowedFileTypes = [
                'image/jpg',
                'image/jpeg',
                'image/gif',
                'image/png',
            ];
                echo "<pre>";
                var_dump( (bool) array_search($fileType, $allowedFileTypes, true));
                echo "</pre>";

            $isFileTypeAllowed = (bool) array_search($fileType, $allowedFileTypes, true);
            if ($isFileTypeAllowed == false) {
                $error = "The file type is invalid. Allowed types are jpeg, png, gif.<br>";
            } else {
                // Will try to upload the file with the function 'move_uploaded_file'
                // Returns true/false depending if it was successful or not
                $isTheFileUploaded = move_uploaded_file($fileTempName, $newPathAndName);
                if ($isTheFileUploaded == false) {
                    // Otherwise, if upload unsuccessful, show errormessage
                    $error = "Could not upload the file. Please try again<br>";
                }
            }
        }

        if (empty($error)) {
            $msg = "Successfully uploaded the new rum";
            // Save the image url in DB here, along with other data
            $img_url = $newPathAndName;
        } else {
            $msg = $error;
        }
    }


?>
	<div>
		<form action="../edit.php?" method="GET">
			<input type="submit" value="My page" class="btn">
		</form>
	</div>
    <form action="admin.php">
        <button class="contentBtn">Back</button>
    </form>
<!-- Lägg till nya artiklar -->
<!-- Lägg till nya artiklar -->
    <div class="box2">
        <div class="insidebox">

            <h1>Add product</h1>
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="inputone">
                    <input type="text" name="title" placeholder="Title">

                    <br>
                        
                    <form action="products.php?" method="POST">
                    file: <input type="file" name="upload" value=""/> 
                    </form> 
                    <!-- <input type="text" name="img_url" id="add-img_url" placeholder="Bildens filnamn." > -->

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
    <!-- Artiklar börjar här  -->
    <!-- Artiklar börjar här  -->
    <div class="box">
        <ul class="lists">
            <?php foreach ($products as $key => $article) { ?>
                <li class="articles">

                    <div class="article_img">
                        <img src="<?=$img_url?>">
                   </div>

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