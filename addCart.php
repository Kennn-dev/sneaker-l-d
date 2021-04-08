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
        // echo $id;
           

    }

?>
<?php  require_once __DIR__. "/layouts/header.php";?>

<!-- //////////////////////////////////////////// -->
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="public/frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="index.php">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($_SESSION['cart']) > 0) : ?>
                            <?php foreach($_SESSION['cart'] as $key => $item): ?>
                            <tr>
                                <td class="shoping__cart__item">
                                    <img width="80px" height="80px" src="public/uploads/products/<?php echo $item['image'] ?>" alt="">
                                    <h5><?php echo $item['name'] ?></h5>
                                </td>
                                <td class="shoping__cart__price">
                                    <?php echo formatPrice($item['price']) ?> VND
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input 
                                                name="quantity"
                                                id="quantity"
                                                type="number" 
                                                value="<?php echo $item['quantity'] ?>"
                                                min="1"
                                            >
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    <?php echo formatPrice($item['price']*$item['quantity']) ?> VND
                                </td>
                                <!-- Remove item -->
                                <td class="shoping__cart__item__close">
                                    <a href="remove.php?key=<?php echo $key  ?>">
                                    <span class="fas fa-ban"></span>
                                    </a>
                                </td>
                                <!-- Update quantity -->
                                <td class="shoping__cart__item__close ">
                                    <a id="update_btn" data-key ="<?php echo $key ?>" href="">
                                    <span class="fa fa-sync "></span>
                                    </a>
                                </td>
                            </tr>
                            <?php  endforeach;?>
                            <?php else :?>
                            <tr>
                                <td class="shoping__cart__price" style="text-align: left; width : 30%">Buy something ...</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="index.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="index.php" class="primary-btn cart-btn cart-btn-right">CONTINUE SHOPPING</a></div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <?php if(isset($_SESSION['cart'])) : ?>
                    <?php $subtotal =0; ?>
                        <?php foreach($_SESSION['cart'] as $item) : ?>
                        <?php $subtotal += ($item['price']*$item['quantity']) ?>
                          <?php endforeach; ?>
                    <ul>
                        <li>Total <span><?php $_SESSION['total_price'] = $subtotal ;echo formatPrice($subtotal) ?> VND</span></li>
                    </ul>
                    <?php endif; ?>
                    <a href="cartCheckout.php" class="primary-btn">CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
<?php  require_once __DIR__. "/layouts/footer.php";?>