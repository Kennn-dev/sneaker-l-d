<?php 

    require_once __DIR__. "/autoload/autoload.php";
    $key        = intval(getInput('key'));
    $quantity   = intval(getInput('quantity'));

    $_SESSION['cart'][$key]['quantity'] = $quantity;

    
    echo 1;

?>