<?php
include 'a/fun.php';
$items = 0;
$total = 0;
$ge = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order'");
$gets = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order' ORDER BY `id` DESC");
while ($z = get($ge)) {
    $p = $z['product_id'];
    $items = $items + $z['qty'];
    $total = $total + (pull('selling_price', 'zvinhu', "`id` = '$p'")*$z['qty']);
}
$total = amount($total);
if ($total< 0.01) {
    $_SESSION['error'] = 'Your cart is currently empty. Add items to it first.';
    header("location: $home");
    exit;
}
$name = '';
$sur = '';
$mail = '';
$add = '';
$cit = '';
$ph = '';
$code = '';
$pay = '';
if (!empty($phone)) {
    $a = get(r("SELECT * FROM `customers` WHERE `id` = '$user_id'"));
    $name = hide('d', $a['name']);
    $sur = hide('d', $a['surname']);
    $mail = hide('d', $a['email_address']);
    $add = hide('d', $a['street_address']);
    $cit = hide('d', $a['town']);
    $ph = hide('d', $a['phone']);
    $ph = preg_replace('/\D/', '', $ph);
    $ph = strrev(substr($ph, -9));
    $ph = strrev($ph);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>apise.shop | Checkout</title>
    <?php style(); ?>
</head>
<body>
    <?php nav(); ?>
    <section class="checkout-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="checkout-step">
                        <div class="accordion" id="accordionExample">
                            <div class="card checkout-step-one">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        Enter your details
                                        <p>Your data is safe with us. <a href="<?php echo "$home"; ?>privacy" class="text-success">Find out more here.</a></p>
                                    </h5>
                                </div>
                                    <div class="card-body">
                                        <div class="ibox" id="ibox1">
                                            <div class="ibox-content">
                                                <div class="sk-spinner sk-spinner-wave">
                                                    <div class="sk-rect1"></div>
                                                    <div class="sk-rect2"></div>
                                                    <div class="sk-rect3"></div>
                                                    <div class="sk-rect4"></div>
                                                    <div class="sk-rect5"></div>
                                                </div>
                                                <form method="post" id="ninjaz" onsubmit="return checkout();">
                                                    <div class="address-fieldset">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <input name="name" type="text" placeholder="Name" value="<?php echo "$name"; ?>" class="form-control input-md" required="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-12">
                                                                <div class="form-group">
                                                                    <input name="surname" type="text" placeholder="Surname" value="<?php echo "$sur"; ?>" class="form-control input-md" required="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <input name="buyer_email" type="email" placeholder="Email" value="<?php echo "$mail"; ?>" class="form-control input-md" required="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <input name="street_address" type="text" placeholder="Street Address" value="<?php echo "$add"; ?>" class="form-control input-md" required="">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12">
                                                                <div class="form-group">
                                                                    <input  name="town" type="text" placeholder="Town/City" value="<?php echo "$cit"; ?>" class="form-control input-md">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-md-4 col-lg-4">
                                                                <div class="input-group-btn" >
                                                                    <select class="form-control" name="code" >
                                                                        <option value="zw">ZW +263</option>
                                                                        <option value="za">SA +27</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class='form-group col-lg-8 col-md-8>'><input type="text" placeholder="Phone Number" name="phone" value="<?php echo $ph; ?>" class="form-control" /></div>
                                                            <div class="form-group col-md-6 col-lg-12">
                                                                <select class="form-control col-md-6" name="payment_method" >
                                                                    <option value="payment">Select Payment Method</option>
                                                                    <option value="cash">Cash on Delivery</option>
                                                                    <option value="transfer">Transfer</option>
                                                                </select>
                                                            </div>
                                                            <center class="text-center">
                                                                <div class="form-group col-md-6 col-lg-12">
                                                                    <button id='st' onclick="return checkout();" class="btn btn-secondary">Place Order</button>
                                                                </div>
                                                            </center>
                                                        </div>
                                                    </div>
                                                    <div id="res"></div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">My Cart <span class="text-secondary float-right">(<d class='cvbv'></d>)</span></h5>
                        <div class="card-header">
                            <p>Sub Total <strong class="float-right cart-amount">$<?php echo mari($total); ?></strong></p>
                            <p>Delivery Charges <strong class="float-right text-danger">+ $<d class="delivery_charges"></d></strong></p>
                            <div class="coupon">
                                <?php if (isset($_SESSION[$coupon_session])): ?>
                                    Discount Code (<?php $cpid = $_SESSION[$coupon_session]; echo pull('coupon', 'coupons', "`id` = '$cpid'"); ?>)
                                    <strong class="float-right text-success">
                                        - $<?php echo amount(pull('amount', 'coupons', "`id` = '$cpid'")); ?>
                                        <a class="float-right" href="#" onclick="return uncoupon();"><i class="mdi mdi-close"></i></a>
                                    </strong>
                                <?php else: ?>
                                    <td class="col-md-4">
                                        <sss class="form-inline float-right">
                                            <div class="form-group">
                                                <input type="text" placeholder="Enter discount code" class="form-control border-form-control form-control-sm" id="coupon">
                                            </div>
                                            &nbsp;
                                            <button class="btn btn-success float-left btn-sm" onclick="return coupon();">Apply</button>
                                        </sss>
                                    </td>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="btn btn-secondary btn-lg btn-block text-left">
                            <span class="float-left">Total </span>
                            <span class="float-right"><strong class='slimon'>$<?php echo mari($total + ($total*$delivery_charges)); ?></strong></span> </span>
                        </p>
                        <div class="card-body pt-0 pr-0 pl-0 pb-0 makprantos"  style="overflow-y: scroll; height:500px;">
                            <?php
                            $gets = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order' ORDER BY `id` DESC");
                            while ($a = get($gets)):
                                $id = $a['product_id'];
                                $ids = $a['id'];
                                $img = $home.'i/p/'.pull('image', 'zvinhu', "`id` = '$id'");
                                $key = str_shuffle("*dfhj**0ew9898ew^&ege!`e3`").time();
                                ?>
                                <div class="cart-list-product">
                                    <a class="float-right" href="#" onclick="return un__cart('<?php echo hide('e', $ids); ?>');"><i class="mdi mdi-close"></i></a>
                                    <img class="img-fluid" src="<?php echo $img; ?>" alt="">
                                    <div class="cart-store-details">
                                        <p> <a class="text-success" href="<?php echo $home.'product/'.str_replace(' ', '-', mb_strtolower(pull('product_name', 'zvinhu', "`id` = '$id'"))); ?>"><?php echo word(pull('product_name', 'zvinhu', "`id` = '$id'")); ?></a> </p>
                                        <p>$<?php echo mari(pull('selling_price', 'zvinhu', "`id` = '$id'")* $a['qty']); ?></p>
                                        <?php
                                        echo "
                                        <input type='number' id='".hide('e', $key)."'  min='0' value='".$a['qty']."'  name='quantity' class='ghj' onchange='return edit_basket(\"".hide('e',hide('e',  $ids))."\", \"".hide('e', $key)."\")'>
                                        ";
                                        ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <?php foot(); script(); ?>
    <script type="text/javascript">
    function checkout(){
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            type: 'POST',
            url: '<?php echo "$home"; ?>checkout',
            data: $('#ninjaz').serialize(),
            success: function(response) {
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                $('#res').html(response);
            }
        });
        return false;
    }
    </script>
</body>
</html>
