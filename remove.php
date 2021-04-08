<?php

    require_once __DIR__. "/autoload/autoload.php";

    $key = intval(getInput('key'));

    unset($_SESSION['cart'][$key]);
    // echo $key;
    header("Location: http://localhost/fruitstore/addCart.php");

?>