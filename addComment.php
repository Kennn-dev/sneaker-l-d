<?php 
require_once __DIR__. "/autoload/autoload.php";
    $conn = mysqli_connect("localhost","root" ,"","fruitstore");
    mysqli_set_charset($conn,"utf8");

    $content = $_POST['content'];
    $idUser = $_SESSION['user_id'];
    $idProd = $_SESSION['product_id'];

    $sql = " INSERT INTO comment(productID, userID, content) 
    VALUES ('".$idProd."','". $idUser."','".$content."')";
    $insert = mysqli_query($conn, $sql) or die;
    header("Location: http://localhost/fruitstore/detailProduct.php?id=".$idProd);
?>