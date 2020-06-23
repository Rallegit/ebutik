
<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
  
    if(!empty($_POST['articleId']) 
        && isset($_SESSION['items'][$_POST['articleId']])
    ) {
        unset($_SESSION['items'][$_POST['articleId']]);
    }

    header('Location: checkout.php');
    exit;

    $data = [
        
    ];

    echo json_encode($data);
    
?>


