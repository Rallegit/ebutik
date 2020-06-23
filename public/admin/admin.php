<?php
    require('../../src/dbconnect.php');
    require('../../src/config.php');

    checkLoginSession(); //refakturerad

?>

    <?php include('layout/header.php'); ?>

    <!-- <div class="d-flex justify-content-around text-center bg-dark"> -->
    <div class="d-flex flex-column bg-dark">
        <div class="col">
            <form action="createproducts.php?">
                <input type="submit" value="Add Product" class="btn text-white">
            </form>
        </div>
        <div class="col">
            <form action="users.php">
                <input type="submit" value="User-list" class="btn  text-white">
            </form>
        </div>
        <div class="col">
            <form action="admincreate.php">
                <input type="submit" value="Create user" class="btn  text-white">
            </form>
        </div>
        <div class="col">
            <form action="../index.php">
                <button class="btn contentBtn text-white">Back</button>
            </form>
        </div>
    </div>

    <?php include('layout/footer.php'); ?>