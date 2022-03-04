<section class="section-padding footer bg-white border-top">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-2">
                <h6 class="mb-4">Contact Us </h6>
                <p class="mb-0"><a class="text-success" href="tel:<?php echo "$business_phone"; ?>"><i class="mdi mdi-phone"></i> <?php echo $business_phone; ?></a></p>
                <p class="mb-0"><a class="text-success" href="tel:<?php echo "$business_phone_2"; ?>"><i class="mdi mdi-phone"></i> <?php echo $business_phone_2; ?></a></p>
                <p class="mb-0"><a class="text-success" href="mailto:<?php echo "$business_email"; ?>"><i class="mdi mdi-email"></i> <span class="__cf_email__"><?php echo "$business_email"; ?></span></a></p>
                <p class="mb-0"><a class="text-dark" href="#"><i class="mdi mdi-home-map-marker"></i> Corner Hobbs/Plymouth <br>Harare Zimbabwe</a></p>
            </div>
            <div class="col-lg-3 col-md-2">
                <h6 class="mb-4">COMPANY</h6>
                <ul>
                    <li><a href="<?php echo "$home"; ?>about">About us</a></li>
                    <li><a href="contact.py">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-3">
                <h6 class="mb-3">Social Media</h6>
                <div class="social-links-footer">
                    <ul>
                        <li><a class="text-success" href="https://www.facebook.com/Apiseshop-100961622072243/" target="_blank"><i class="mdi mdi-facebook"></i> Apise.shop</a></li>
                        <li><a class="text-success" href="https://api.whatsapp.com/send?phone=<?php  echo "$whatsapp_number"; ?>" target="_blank"><i class="mdi mdi-whatsapp"></i> <?php echo "$whatsapp_number"; ?></a></li>
                        <li><a class="text-success" href="https://www.instagram.com/apise.shop/"><i class="mdi mdi-instagram" target="_blank"></i> apise.shop</a></li>
                        <li><a class="text-success" href="https://twitter.com/ApiseShop/"><i class="mdi mdi-twitter" target="_blank"></i> @ApiseShop</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <h4 class="mb-0 mt-0"><a class="logo" href="<?php echo "$home"; ?>"><img src="<?php echo "$logo"; ?>" width='120px'></a></h4>
            </div>
        </div>
    </div>
</section>
<section class="pt-4 pb-4 footer-bottom">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-10 pull-right text-center">
                <p class="mt-1 mb-0"><strong class="text-dark">enfield zimbabwe</strong><br> <i class="vmware"></i>
                    <small class="mt-0 mb-0">
                        Powered by <a href="mailto:websites@tysla.co.zw" target="_blank" class="text-primary">Tysla Solutions</a>
                    </small>
                </p>
            </div>
        </div>
    </div>
</section>
<div class="cart-sidebar">
    <div class="cart-sidebar-header">
        <h5>
            My Cart | <span class="text-success cart-amount"> $<?php global $total; echo mari($total); ?></span>
            <a data-toggle="offcanvas" class="float-right" href="#"><i class="mdi mdi-close"></i>
            </a>
        </h5>
    </div>
    <div class="cart-sidebar-body" style="background-color: #f5fffa;">
        <div class="makpranto">
            <?php include 'the.cart.php'; ?>
        </div>
    </div>

    <div class="cart-sidebar-footer">
        <div class="cart-store-details">
            <p>Sub Total <strong class="float-right cart-amount">$<?php echo mari($total); ?></strong></p>
            <p>Delivery Charges <strong class="float-right text-danger">+ $<d class="delivery_charges"></d></strong></p>
            <h6>................................................................. <strong class="float-right text-danger"></strong></h6>
        </div>
        <a href="checkout.html"><button class="btn btn-secondary btn-lg btn-block text-left" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span
            class="float-right"><strong class="slimons">$<?php echo mari($total + ($total*$delivery_charges)); ?></strong> <span class="mdi mdi-chevron-right"></span></span></button></a>
        </div>
    </div>
