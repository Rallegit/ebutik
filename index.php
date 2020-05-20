<?php
require('dbconnect.php');
 if (isset($_POST['deleteBtn'])) {
 
 
    if(empty($rubrik)){
        try {
            $query = "
            DELETE FROM posts
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

    
    $rubrik = '';
    $content = '';
    $author = '';
    $error  = '';
    $msg    = '';
    if (isset($_POST['send'])) {
        $rubrik = trim($_POST['rubrik']);
        $content = trim($_POST['content']);
        $author = trim($_POST['author']);

        if (empty($rubrik)) {
            $error .= "<p>Rubrik är obligatoriskt</p>";
        }

        if (empty($content)) {
            $error .= "<p>Inlägg är obligatoriskt</p>";
        }

        if (empty($author)) {
            $error .= "<p>Författare är obligatoriskt</p>";
        }

        if ($error) {
            $msg = "<div class='errors'>{$error}</div>";
        }

        if (empty($error)) {

            try {
                $query = "
                INSERT INTO posts (title, content, author)
                VALUES (:rubrik, :content, :author);
                ";

                $stmt = $dbconnect->prepare($query);
                $stmt->bindValue(':rubrik', $rubrik);
                $stmt->bindValue(':content', $content);
                $stmt->bindValue(':author', $author);
                $result = $stmt->execute();
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode()); 
            }
            if ($result) {
            $msg = '<p class="success">Ditt inlägg är nu publicerat</p>';
            } 
    }
    }
        
        

    
                    try {
                    $query = "SELECT * FROM posts;";
                    $stmt = $dbconnect->query($query);
                    $posts = $stmt->fetchall();
    }                catch (\PDOException $e) {
                    throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    




    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Page</title>
</head>
<body>
<header>
                <form action="../public/visit.php">
                <button class="adminBtn">Visit page</button>
                </form>
</header>
    
    <div class="box2">
        <div class="insidebox">
            <h1>Worlds most awesome blog</h1>
            <form action="" method="POST">
            <div class="inputone">
                <input type="text" name="rubrik" placeholder="Rubrik...">
                <br>
                <textarea type="text" name="content" placeholder="Innehåll.." rows="10" cols="60" style="resize:none"></textarea>
                <br>
                <input type="text" name="author" placeholder="Ditt namn..">
                <button class="btn1" name="send">Publicera</button>
            </div>
            </form>
            <?=$msg?>
        </div>
    </div>
        <div class="box">
            
        
        <ul class="lists">
            <?php foreach ($posts as $key => $texter) { ?>
                <li class="blogOne">
                <h2>
                <?=htmlentities($texter['title'])?>
                </h2>
                <br>
                <section>
                <?=htmlentities($texter['content'])?>
                </section>
                <br>
                <h3>
                <?=htmlentities($texter['author'])?>
                </h3>
                <br>
                <?=htmlentities($texter['published_date'])?>
                </p>
                <br>
                
                <form action="" method="POST">
                <input type="hidden" name="id" value="<?=$texter['id']?>">
                <input type="submit" name="deleteBtn" value="Ta Bort" class="btn">
                </form>
                
                <form action="update.php?" method="GET">
                <input type="hidden" name="id" value="<?=$texter['id']?>">
                <input type="submit" value="Uppdatera" class="btn">
                </form>
                
                </li>
                <br>
                <br>
                <div class="bordertext"></div>
            <?php } ?>

            

        </ul>

    </div>



</body>
</html>