<?php 

    require_once __DIR__. "/autoload/autoload.php";

    $id = intval(getInput('id'));
    $_SESSION['product_id'] = $id;
    $products = $db->fetchAll('products');
    $detailProduct = $db->fetchID('products', $id);
    // $otherProducts = $db->fetchAll('categories');
    $id2 = $detailProduct['categoryID'];
    $sql = " SELECT * FROM `products` WHERE `categoryID` = $id2";
    $sql2 = "SELECT comment.content, user.first_name, user.last_name from comment,user where comment.productID = $id and user.id = comment.userID";
    $listComment = $db->fetchsql($sql2);
    $productsMore = $db->fetchsql($sql);
 
    // var_dump($productsMore);
?>
<?php  require_once __DIR__. "/layouts/header.php";
?>
<style>
    <?php include "styles.css"; ?>
</style>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="public/frontend/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Sneaker Lord</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                            src="public/uploads/products/<?php echo $detailProduct['image'] ?>" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="public/uploads/products/<?php echo $detailProduct['image'] ?>"
                            src="public/uploads/products/<?php echo $detailProduct['image'] ?>" alt="">
                        <img data-imgbigurl="public/uploads/products/<?php echo $detailProduct['image'] ?>"
                            src="public/uploads/products/<?php echo $detailProduct['image'] ?>" alt="">
                        <img data-imgbigurl="public/uploads/products/<?php echo $detailProduct['image'] ?>"
                            src="public/uploads/products/<?php echo $detailProduct['image'] ?>" alt="">
                        <img data-imgbigurl="public/uploads/products/<?php echo $detailProduct['image'] ?>"
                            src="public/uploads/products/<?php echo $detailProduct['image'] ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?php echo $detailProduct['name'] ?></h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price"><?php echo formatPrice($detailProduct['price']) ?> VND</div>
                    <p><?php echo $detailProduct['description'] ?></p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="checkAddToCart.php?id=<?php echo $id?>" class="primary-btn">ADD TO CARD</a>
                    <a href="#" class="heart-icon"><i class="fa fa-heart"></i></a>
                    <!-- <div class="alert alert-success">Add success</div> -->
                    <ul>
                        <li><b>Availability</b> <span>In Stock</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Weight</b> <span>0.5 kg</span></li>
                        <li>
                            <b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div> 
        </div>
    </div>
</section>
<!-- Product Details Section End -->
<!-- Comment -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Comment</h2>
                </div>
            </div>
        </div>
        <div class="comment-group">
            <form id="comment-form" method="post" >
            <div class="input-group mb-3">
                <input type="text" id="input-content" name="content" class="form-control" placeholder="Give our your feedback here " aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-danger" name="comment"  type="submit" id="button-addon2">Button</button>
            </div>
            </form>
            <div class="comment mt-5">
                <?php 
                    foreach($listComment as $item) :?>
                        <h5 class="mt-3 mb-3"><?php echo($item['first_name'].' '. $item['last_name'])?></h5>
                        <div class="alert alert-dark mt-3 mb-3" role="alert">
                            <?php echo $item['content']?>
                        </div>
                <?php endforeach?>
            </div>
        </div>
    </div>
</section>
<!-- End Comment -->
<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="product__details__pic__slider owl-carousel">
        <?php foreach($productsMore as $item) : ?>
            <div class="">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="public/uploads/products/<?php echo $item['image'] ?>">
                        <ul class="product__item__pic__hover">
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            <li><a href="cartHolder.php?id="><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="detailProduct.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></h6>
                        <h5><?php echo formatPrice($item['price']) ?> VND</h5>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>
<!-- Related Product Section End -->

<?php require_once __DIR__. "/layouts/footer.php"; ?> 