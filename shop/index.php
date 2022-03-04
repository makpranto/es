<?php
include 'a/fun.php';
if (isset($_COOKIE[$kook])) {
    setcookie($kook, hide('e', hide('e', hide('e', hide('e', $user_id)))), time()+60*24*60*60);
    $_COOKIE[$kook] = hide('e', hide('e', hide('e', hide('e', $user_id))));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Buy all your groceries and gadgets. We will have them delivered to your relatives and friends in Zimbabwe and they can pay on delivery."><meta name="keywords" content="apise.shop apise shop">
	<title>Enfield Zimbabwe Pvt. Ltd - Online Store</title>
    <?php style(); ?>
</head>
<body>
    <?php nav(); ?>
    <section class="carousel-slider-main text-center border-top border-bottom bg-white">
        <div class="owl-carousel owl-carousel-slider">
            <div class="item">
                <a href="<?php echo "$home"; ?>categories/groceries/"><img class="img-fluid" src="img/slider/Grocery.png" alt="First slide"></a>
            </div>
            <div class="item">
                <a href="<?php echo "$home"; ?>categories/hardware/"><img class="img-fluid" src="img/slider/Hardware.png" alt="First slide"></a>
            </div>
            <div class="item">
                <a href="<?php echo "$home"; ?>categories/electronics/"><img class="img-fluid" src="img/slider/Electronics.png" alt="First slide"></a>
            </div>
            <div class="item">
                <a href="<?php echo "$home"; ?>categories/houseware/"><img class="img-fluid" src="img/slider/Homeware.png" alt="First slide"></a>
            </div>
        </div>
    </section>
    <?php cats(); random(20); featured_cat();?>
    <section class="section-padding bg-white border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-truck-fast"></i>
                        <h6>Cheap same day Delivery</h6>
                        <p>Delivering in 24hrs at the rate of <?php echo $delivery_rate*100; ?>% of total purchase.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-basket"></i>
                        <h6>100% Satisfaction</h6>
                        <p>We make sure that we exceed your expectation.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-tag-heart"></i>
                        <h6>Great Daily Deals Discount</h6>
                        <p>Be on the lookout for our promotions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php foot();script(); ?>
</body>
</html>
