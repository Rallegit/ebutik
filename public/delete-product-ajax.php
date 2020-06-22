   <?php

    require('../src/dbconnect.php');
    require('../src/config.php');

    // if (isset($_POST['deleteProductBtn'])) {
    //     deleteProduct($_POST['id']); 
    // }
    if (isset($_POST['deleteProductBtn'])) {
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

    
    $products = fetchAllProducts();

    $data = [

        'products' => $products,
        
    ];

    echo json_encode($data);


?>
