<?php 

    session_start();
    
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    header("Location: http://localhost/fruitstore/index.php");

?>