<?php
// connect database 
    require_once __DIR__. "/../../autoload/autoload.php";
    
    $id = intval(getInput('id'));

    //Remember check products in category (products = 0)

    $deleteBill = $db->delete('bills',$id);
    if($deleteBill > 0)
    {
        header("Location: http://localhost/fruitstore/admin/modules/bills/index.php");
    }
?>