<?php 

    require_once __DIR__. "/autoload/autoload.php";
    $categories = $db->fetchAll('categories');
    $products = $db->fetchAll('products');
    // unset($_SESSION['cart']);
    // unset($_SESSION['email']);
    $newProducts = $db->fetchsql("SELECT * FROM `products` ORDER BY `products`.`id` ASC")

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
                                <span>Shop</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
            <!-- Breadcrumb Section End -->
        <!-- Product Section Begin -->
        <section class="product spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-5">
                        <div class="sidebar">
                            <div class="sidebar__item">
                                <h4>Categories</h4>
                                <ul>
                                    <?php foreach($categories as $item) : ?>
                                    <li ><a href="productByCategory.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                            <div class="sidebar__item">
                                <h4>Price</h4>
                                <div class="price-range-wrap">
                                    <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                        data-min="10" data-max="540">
                                        <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                        <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    </div>
                                    <div class="range-slider">
                                        <div class="price-input">
                                            <input type="text" id="minamount">
                                            <input type="text" id="maxamount">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__item">
                                <div class="latest-product__text">
                                    <h4>Latest Products</h4>
                                    <div class="latest-product__slider owl-carousel">
                                        <div class="latest-prdouct__slider__item">
                                            <!-- <a href="#" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="public/frontend/img/latest-product/lp-1.jpg" alt="">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>Crab Pool Security</h6>
                                                    <span>$30.00</span>
                                                </div>
                                            </a> -->
                                             <!-- items per column  ...-->
                                        </div>
                                        <div class="latest-prdouct__slider__item">
                                            <!-- <a href="#" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="public/frontend/img/latest-product/lp-1.jpg" alt="">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>Crab Pool Security</h6>
                                                    <span>$30.00</span>
                                                </div>
                                            </a> -->
                                            <!-- items per slide .. -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7">
                        <div class="product__discount">
                            <div class="section-title product__discount__title">
                                <h2>New</h2>
                            </div>
                            <div class="row">
                                <div class="product__discount__slider owl-carousel">
                                    <?php foreach($newProducts as $item) : ?>
                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="public/uploads/products/<?php echo $item['image'] ?>">
                                                <ul class="product__item__pic__hover">
                                                    <li><a href=""><i class="fa fa-heart"></i></a></li>
                                                    <li><a href=""><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="checkAddToCart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <h5><a href="detailProduct.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></h5>
                                                <div class="product__item__price"><?php echo formatPrice($item['price']) ?> VND</div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <!-- ... -->
                                </div>
                            </div>
                        </div>
                        <div class="filter__item">
                            <div class="row">
                                <div class="col-lg-4 col-md-5">
                                    <div class="filter__sort">
                                        <span>Sort By</span>
                                        <select>
                                            <option value="0">Default</option>
                                            <option value="0">Default</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <div class="filter__found">
                                        <h6><span>16</span> Products found</h6>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3">
                                    <div class="filter__option">
                                        <span class="icon_grid-2x2"></span>
                                        <span class="icon_ul"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach($products as $item): ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="public/uploads/products/<?php echo $item['image'] ?>">
                                        <ul class="product__item__pic__hover">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="checkAddToCart.php?id=<?php echo $item['id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="detailProduct.php?id=<?php echo $item['id'] ?>"><?php echo $item['name'] ?></a></h6>
                                        <h5><?php echo formatPrice($item['price']) ?> VND</h5>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                            <!-- items show up -->
                        </div>
                        <div class="product__pagination">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Section End -->
<?php require_once __DIR__. "/layouts/footer.php"; ?>       