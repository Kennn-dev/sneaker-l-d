<?php
// connect database 
    require_once __DIR__. "/../../autoload/autoload.php";
    
    $id = intval(getInput('id'));

    $is_checkout = $db->fetchID('bills',$id);
    
    if( empty($is_checkout))
    {
        /// fail 
        echo 'fail';
    }
    else
    {
        if($is_checkout['is_checkout'] == 0)
        {
            $is_checkout_status =  1 ;
        }
        if($is_checkout['is_checkout'] == 1)
        {
            $is_checkout_status =  0 ;
        }
        // $is_checkout_status = $isCheckout['is_checkout'] == 0 ? 1 : 0;

        $update = $db->update('bills',array('is_checkout' => $is_checkout_status), array('id'=>$id));
        if($update > 0)
        {
            //success 
            header("Location: http://localhost/fruitstore/admin/modules/bills/index.php");
        }
        else
        {
            // echo $is_checkout_status;
            $_SESSION['fail'] = 'Update failed :(';
            header("Location: http://localhost/fruitstore/admin/modules/bills/index.php?checkout=$is_checkout_status");
        }
    }

    
?>