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
        <input type="submit" value="User-list" class="btn">
    </form>
    <form action="admincreate.php">
        <input type="submit" value="Create user" class="btn">
    </form>
    <form action="../index.php">
        <button class="contentBtn">Back</button>
    </form>
