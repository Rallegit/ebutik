 <?php
    require('../src/config.php');
    require('../src/dbconnect.php');
    
    checkLoginSession(); //refakturerad 

    try {
        $query = "
            SELECT * FROM users
            WHERE id = id;
        ";
        
        $stmt = $dbconnect->prepare($query);
        $stmt->bindValue(':id', $_SESSION['id']);
        $stmt->execute();
        $user = $stmt->fetchAll();
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int) $e->getCode());
    }
    
    $msg = '';
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


?>

<?php include('layout/header.php'); ?>

<table class="table table-borderless">
    <thead>
        <tr>
            <th style="width: 15%">Article</th>
            <th style="width: 50%">Description</th>
            <th style="width: 10%"></th>
            <th style="width: 15%">Quantity</th>
            <th style="width: 15%">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($_SESSION['items'] as $articleId => $articleItem) {?>
            <tr>
                <td><img src="img/<?=$articleItem['img_url']?>" style="width:50px;height:auto;"></td>
                <td><?=$articleItem['description']?></td>
                <td>
                    <form action="delete-cart-item.php" method="POST">
                        <input type="hidden" name="articleId" value="<?=$articleId?>" >
                        <input type="submit" name="deleteBtn" value="Ta Bort" class="btn">
                        <svg class="bi bi-trash" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </form>
                </td>
                <td>
                    <form action="update-cart-item.php" class="update-cart-form" method="">
                        <input type="hidden" name="articleId" value="<?=$articleId?>">
                        <input type="number" name="quantity" value="<?=$articleItem['quantity']?>">
                    </form>
                </td>
                <td><?=$articleItem['price']?> kr</td>
            </tr>
        <?php } ?>

        <tr class="border-top">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total: <?=$articleTotalSum?> kr</b></td>
        </tr>
    </tbody>
</table>
 
<form action="create-order.php" method="POST">
    <input type="hidden" name="totalPrice" value="<?=$articleTotalSum?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputFirstName">First name</label>
                <input type="text" class="form-control" name="firstName" id="inputFirstName">
            </div>
            <div class="form-group col-md-6">
                <label for="inputLastName">Last name</label>
                <input type="text" class="form-control" name="lastName" id="inputLastName">
            </div>
        </div>
        <div class="form-group">
            <label for="inputUsername">Username</label>
            <input type="text" class="form-control" id="inputUsername" name="username">
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" id="inputPassword" name="password">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="text" class="form-control" id="inputEmail" name="email">
        </div>
        <div class="form-group">
            <label for="inputPhone">Phone</label>
            <input type="text" class="form-control" id="inputPhone" name="phone">
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="street">
        </div>
        <div class="form-group col-md-2">
                <label for="inputZipcode">Zip code</label>
                <input type="text" class="form-control" name="postalCode" id="inputZipcode">
        </div>
        <div class="form-group">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" name="city" id="inputCity">
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputCountry">Country</label>
                <select id="inputCountry" name="country" class="form-control">
                    <option selected>Choose...</option>
                    <option>Sweden</option>
                    <option>Finland</option>
                    <option>Denmark</option>
                    <option>Norway</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check if you agree terms
                </label>
            </div>
        </div>
    <button type="submit" class="btn btn-primary" name="createOrderBtn">Order now</button>
</form>

<?php include('layout/footer.php'); ?>