<?php 
    require('../src/dbconnect.php');
    require('../src/config.php');
    
    if (isset($_POST['deleteBtn'])) {

        if(empty($title)){
            try {
                $query = "
                    DELETE FROM users
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

    $users = fetchAllUsers(); 


    $data = [

        'users' => $users,
        
    ];

    echo json_encode($data);

    


?>