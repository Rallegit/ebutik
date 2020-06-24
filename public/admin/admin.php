<?php
    require('../../src/dbconnect.php');
    require('../../src/config.php');

    checkLoginSession(); //refakturerad

?>

    <?php include('layout/header.php'); ?>

    <div class="d-flex flex-column" id="productPage">
        <div class="d-flex justify-content-center text-center mb-5">
            <h2>Admin Page</h2>
        </div>

        <div class="d-flex justify-content-around text-center adminBtn">
            <div class="col">
                <form action="createproducts.php?">
                    <input type="submit" value="Add Product" class="btn btn-dark">
                </form>
            </div>
            <div class="col">
                <form action="users.php">
                    <input type="submit" value="User-list" class="btn btn-dark">
                </form>
            </div>
            <div class="col">
                <form action="admincreate.php">
                    <input type="submit" value="Create user" class="btn btn-dark">
                </form>
            </div>
        </div>
    </div>

    <?php include('layout/footer.php'); ?>