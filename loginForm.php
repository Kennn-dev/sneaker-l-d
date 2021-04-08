<?php 
    require_once __DIR__. "/autoload/autoload.php";

    $data = 
    [
        'email' => postInput('email'),
        'password' => postInput('password'),

    ];

    $error = [];

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($data['email']== '') 
        {
            $error['email'] ='Email required';
        }

        if($data['password'] == '')
        {
            $error['password'] = 'Password required';
        }
        
        //no error
        if(empty($error))
        {   
            $email = $data['email'];
            // $password = md5($data['password']);
            $password = $data['password'];
            $check = $db->fetchOne('user',"email = '".$data['email']."' AND password = '".$data['password']."'");
            
            if($check != null)
            {
                $_SESSION['username'] = $check['first_name'];
                $_SESSION['email'] = $check['email'];

                //for checkout form
                $_SESSION['user_id'] = $check['id'];
                $_SESSION['last_name'] = $check['last_name'];
                $_SESSION['first_name'] = $check['first_name'];
                $_SESSION['phone'] = $check['phone'];
                $_SESSION['address'] = $check['address'];
                //email $_SESSION['email'] = $check['email'];
                
                header("Location: http://localhost/fruitstore/index.php");
            }
            else
            {   
                $_SESSION['fail'] = 'Wrong Email or Password !';
            }
        }
    }


?>


<?php  require_once __DIR__. "/layouts/header.php";?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="public/frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Sneaker Lord</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Home</a>
                        <span>Login</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Checkout Section Begin -->
<div class="container-fluid mt-3">

</div>

<section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Login</h4>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email">
                                        <?php if(isset($error['email'])): ?>
                                        <label class="text-danger"><?php $error['email'] ?></label>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Password<span>*</span></p>
                                    <input type="password" name="password">
                                    <?php if(isset($error['password'])): ?>
                                    <label class="text-danger"><?php $error['password'] ?></label>
                                    <?php endif;?>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    <li>Vegetable’s Package <span>$75.99</span></li>
                                    <li>Fresh Vegetable <span>$151.99</span></li>
                                    <li>Organic Bananas <span>$53.99</span></li>
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>$750.99</span></div>
                                <div class="checkout__order__total">Total <span>$750.99</span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="acc-or">
                                        Create an account?
                                        <input type="checkbox" id="acc-or">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
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
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div> -->
                    </div>
                    <div class="checkout__input">
                        <label for="acc">
                            Haven't Account ? <a href="registerForm.php">  Create one ?</a> 
                        </label>
                        <?php if(isset($_SESSION['fail'])) :?>
                <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['fail'] ; unset($_SESSION['fail']); ?>
                <?php endif ;?>
                    </div>
                    <button type="submit" class="site-btn">LOGIN</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
<?php require_once __DIR__. "/layouts/footer.php"; ?> 