<?php 

    require_once __DIR__. "/autoload/autoload.php";
    $conn = mysqli_connect("localhost","root" ,"","fruitstore");
    mysqli_set_charset($conn,"utf8");

    $first_name ; $last_name ; $email ; $phone ;$address ; $password;
    $error = [];

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        if(isset($_POST['first_name']) && $_POST['first_name'] != null)
        {
            $first_name = $_POST['first_name'];
        }
        if($first_name == '')
        {
            $error['first_name'] = 'input is null';
        }
        
        if(isset($_POST['last_name']) && $_POST['last_name'] != null)
        {
            $last_name = $_POST['last_name'];
        }
        if($last_name == '')
        {
            $error['last_name'] = 'input is null';
        }

        if(isset($_POST['email']) && $_POST['email'] != null)
        {
            $email = $_POST['email'];
        }
        if($email == '')
        {
            $error['email'] = 'input is null';
        }

        if(isset($_POST['phone']) && $_POST['phone'] != null)
        {
            $phone = $_POST['phone'];
        }
        if($phone == '')
        {
            $error['phone'] = 'input is null';
        }

        if(isset($_POST['address']) && $_POST['address'] != null)
        {
            $address = $_POST['address'];
        }
        if($address == '')
        {
            $error['address'] = 'input is null';
        }

        if(isset($_POST['password']) && $_POST['password'] != null)
        {
            $password = $_POST['password'];
        }
        if($password == '')
        {
            $error['password'] = 'input is null';
        }

        //success 

        if(empty($error))
        {
            $sql = " INSERT INTO user(first_name, last_name, email, phone, address, password) 
            VALUES ('".$first_name."','".$last_name."','".$email."','".$phone."','".$address."','".$password."')";
            $insert = mysqli_query($conn, $sql) or die;
            header("Location: http://localhost/fruitstore/loginForm.php");
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
                        <span>Register</span>
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
            <div class="checkout__form">
                <h4>Register</h4>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-lg-12 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="first_name">
                                        <?php if(isset($error['first_name'])): ?>
                                        <label class="text-danger">Input is null</label>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name">
                                        <?php if(isset($error['last_name'])): ?>
                                        <label class="text-danger">Input is null</label>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="number" name="phone">
                                        <?php if(isset($error['phone'])): ?>
                                        <label class="text-danger">Input is null</label>
                                        <?php endif;?>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="checkout__input">
                                        <p>Address<span>*</span></p>
                                        <input 
                                            type="text" 
                                            placeholder="Street Address" 
                                            class="checkout__input__add"
                                            name="address"    
                                        >
                                        <?php if(isset($error['address'])): ?>
                                        <label class="text-danger">Input is null</label>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email">
                                        <?php if(isset($error['email'])): ?>
                                        <label class="text-danger">Input is null</label>
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
                                        <label class="text-danger">Input is null</label>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="site-btn">REGISTER</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
    <?php require_once __DIR__. "/layouts/footer.php"; ?> 