<?php
// connect database 
    require_once __DIR__. "/../../autoload/autoload.php";
    
    $id = intval(getInput('id'));

    //Remember check products in category (products = 0)

    $deleteCategory = $db->fetchID('categories',$id);
    
    $delete_access = $db->fetchOne("products"," categoryID = $id ");
    if($delete_access == NULL)
    {
        $num = $db->delete('categories',$id);
        if($num > 0)
        {
            header("Location: http://localhost/fruitstore/admin/modules/categories/index.php");
        }
    }
    else
    {
        $name = $deleteCategory['name'];
        $_SESSION['fail'] = "There are still products in category $name !";
        header("Location: http://localhost/fruitstore/admin/modules/categories/index.php");
    }
?>
