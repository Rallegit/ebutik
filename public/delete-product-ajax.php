   <?php

    require('../src/dbconnect.php');
    require('../src/config.php');

    if (isset($_POST['deleteProductBtn'])) {
        deleteProduct($_POST['id']); 
    }
    
    $products = fetchAllProducts();

    $data = [

        'products' => $products,
        
    ];

    echo json_encode($data);


?>
