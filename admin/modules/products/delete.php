<?php
// connect database 
    require_once __DIR__. "/../../autoload/autoload.php";
    
    $id = intval(getInput('id'));

    //Remember check products in category (products = 0)

    $deleteCategory = $db->delete('products',$id);
    if($deleteCategory > 0)
    {
        header("Location: http://localhost/fruitstore/admin/modules/products/index.php");
    }
?>