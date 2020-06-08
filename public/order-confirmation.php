<?php
    // require('../src/config.php');
    // require('../src/dbconnect.php');

    // if (empty($_SESSION['articleItems'])) {
    //     header('Location: products.php');
    //     exit;
    // }

    // $articleItems = $_SESSION['articleItems'];
    // unset($_SESSION['articleItems']);
?>

<?php include('layout/header.php'); ?>

<br>
<h1>Thank you for the purchase</h1>
<p>Your order is complete. </p>
<br>

<table class="table table-borderless">
    <thead>
        <tr>
            <th style="width: 15%">Article</th>
            <th style="width: 50%">Description</th>
            <th style="width: 15%">Quantity</th>
            <th style="width: 15%">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($articleItems as $articleId => $articleItem) {?>
            <tr>
                <td><img src="img/<?=$articleItem['img_url']?>" style="width:50px;height:auto;"></td>
                <td><?=$articleItem['description']?></td>
                <td><?=$articleItem['quantity']?></td>
                <td><?=$articleItem['price']?> kr</td>
            </tr>
        <?php } ?>

        <tr class="border-top">
            <td></td>
            <td></td>
            <td></td>
            <td><b>Total: <?=$articleTotalSum?> kr</b></td>
        </tr>
    </tbody>
</table>