<?php 

    require_once __DIR__. "/autoload/autoload.php";
    $user = $db->fetchID('user',intval($_SESSION['user_id']));

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $data_bill = 
        [
            'user_id' => $_SESSION['user_id'],
            // 'product_id'=>$_SESSION['']
            'total_price' => $_SESSION['total_price'],
        ];

        //insert to 'bills'
        $id_bill = $db->insert('bills',$data_bill);
        if($id_bill > 0)
        {
            foreach($_SESSION['cart'] as $key => $item)
            {
                $data_order = 
                [
                    'bill_id' => $id_bill,
                    'product_id' => $key,
                    'quantity' => $item['quantity'],
                    'price' => ($item['price']*$item['quantity']),
                ];

                
            }
            //insert to 'orders'
            $id_order = $db->insert('orders',$data_order);
            unset($_SESSION['cart']);
            header("Location: http://localhost/fruitstore/index.php");
            // $_SESSION['success'] = 'Checkout success !';
        }
    
    }
?>

<!-- <h4>Information</h4>
<form action="" method="POST" >
    <div class="row">
        <div class="col-lg-12">
        <div class="checkout__input">
        <label for="">First Name :</label>
        <input type="text" name="first_name" value="<?php echo $_SESSION['first_name'] ?>" >
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <div class="checkout__input">
        <label for="">Last Name :</label>
        <input type="text" name="last_name" value="<?php echo $_SESSION['last_name'] ?>" >
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <div class="checkout__input">
        <label for="">Address :</label>
        <input type="text" name="address" value="<?php echo $_SESSION['address'] ?>">
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <div class="checkout__input">
        <label for="">Phone :</label>
        <input type="number" name="phone" value="<?php echo $_SESSION['phone'] ?>">
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
        <div class="checkout__input">
        <label for="">Email :</label>
        <input type="email" name="email" value="<?php echo $_SESSION['email'] ?>" >
        </div>
        </div>
    </div>
    <button type="submit" class="site-btn">CHECKOUT</button>
</form>  -->
<?php  require_once __DIR__. "/layouts/header.php";?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="public/frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Home</a>
                        <span>Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <!-- <div class="col-lg-12">
                <?php if(isset($_SESSION['success'])) : ?>
                <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
                <?php endif; ?>
            </div> -->
        </div>
        <div class="checkout__form">
            <h4>Billing Details</h4>
            <form action="" method="POST" >
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="checkout__input">
                        <label for="">First Name :</label>
                        <input type="text" name="first_name" value="<?php echo $_SESSION['first_name'] ?>" >
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="checkout__input">
                        <label for="">Last Name :</label>
                        <input type="text" name="last_name" value="<?php echo $_SESSION['last_name'] ?>" >
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="checkout__input">
                        <label for="">Address :</label>
                        <input type="text" name="address" value="<?php echo $_SESSION['address'] ?>">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="checkout__input">
                        <label for="">Phone :</label>
                        <input type="number" name="phone" value="<?php echo $_SESSION['phone'] ?>">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="checkout__input">
                        <label for="">Email :</label>
                        <input type="email" name="email" value="<?php echo $_SESSION['email'] ?>" >
                        </div>
                        </div>
                    </div>
                </div> 
                 <!-- bill -->
                <div class="col-lg-4 col-md-6">
                    <div class="checkout__order">
                        <h4>Your Order</h4>
                        <div class="checkout__order__products">Products <span>Total</span></div> 
                        <ul style="overflow: auto; height : 130px;">
                            <?php $subtotal =0; ?>
                            <?php foreach($_SESSION['cart'] as $item) : ?>
                            <?php $subtotal += ($item['price']*$item['quantity']); ?>
                            <li><?php echo $item['name'] ?> <span><?php echo ($item['price']*$item['quantity']); ?></span></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="checkout__order__total">Total <span><?php $_SESSION['total'] = $subtotal ;echo formatPrice($subtotal) ?> VND</span></>
                        <h4></h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adip elit, sed do eiusmod tempor incididunt
                            ut labore et dolore magna aliqua.</p>
                        <div class="checkout__input__checkbox">
                            <label for="payment">
                                Check Payment
                                <input type="checkbox" id="payment">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="checkout__input__checkbox">
                            <label for="paypal">
                                Paypal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" class="site-btn">CHECKOUT</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<?php require_once __DIR__. "/layouts/footer.php"; ?> 
