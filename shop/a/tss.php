<?php
include 'fun.php';
$total_cart = total_cart();
if (isset($_SESSION[$coupon_session])) {
    $co = $_SESSION[$coupon_session];
    $a = get(r("SELECT `minimum` FROM `coupons` WHERE `id` = '$co'"));
    $minimun = $a['minimum'];
    if ($minimun > $total_cart) {
        echo "<script>uncoupon();</script>";
        error("This coupon works if you buy items worth $$minimun");
    }
}
