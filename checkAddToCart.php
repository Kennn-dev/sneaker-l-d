<?php
   
    require_once __DIR__. "/autoload/autoload.php";
    if(!isset($_SESSION['email']))
    {
        header("Location: http://localhost/fruitstore/loginForm.php");
        $_SESSION['fail'] = "Please login first !";
    }
    else
    {
        $id = intval(getInput('id'));
       
        //get products
       
            $product = $db->fetchID('products', $id);
            if(! isset($_SESSION['cart'][$id]))
                {
                    //new cart  
                    $_SESSION['cart'][$id]['name'] = $product['name'];
                    $_SESSION['cart'][$id]['image'] = $product['image'];
                    $_SESSION['cart'][$id]['price'] = $product['price'];
                    $_SESSION['cart'][$id]['quantity'] = 1;
                    header("Location: http://localhost/fruitstore/addCart.php?id=$id");
                }
                else
                {
                    //add to cart 
                    $_SESSION['cart'][$id]['quantity'] += 1;
                    header("Location: http://localhost/fruitstore/addCart.php?id=$id");
                }
        
        

    }
    
   

?>