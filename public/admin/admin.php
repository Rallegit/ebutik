<?php
    require('../../src/dbconnect.php');
    require('../../src/config.php');
    
    if (!isset($_SESSION['username'])) {
        header('Location: ../login.php?mustLogin');
        exit;
    }

?>



    <form action="createproducts.php?">
        <input type="submit" value="Add Product" class="btn">
    </form>

    <form action="users.php">
        <input type="submit" value="Users" class="btn">
    </form>

