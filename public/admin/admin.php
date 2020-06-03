<?php
    require('../../src/dbconnect.php');
    require('../../src/config.php');

    checkLoginSession(); //refakturerad

?>

    <?php include('layout/header.php'); ?>

    <div class="d-flex justify-content-around text-center bg-light">
        <div class="col">
            <form action="createproducts.php?">
                <input type="submit" value="Add Product" class="btn">
            </form>
        </div>
        <div class="col">
            <form action="users.php">
                <input type="submit" value="User-list" class="btn">
            </form>
        </div>
        <div class="col">
            <form action="admincreate.php">
                <input type="submit" value="Create user" class="btn">
            </form>
        </div>
        <div class="col">
            <form action="../index.php">
                <button class="contentBtn">Back</button>
            </form>
        </div>
    </div>

    <?php include('layout/footer.php'); ?>