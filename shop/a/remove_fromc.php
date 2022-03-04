<?php
include 'fun.php';
if (!there('item')) {
    cry(1);
}else {
    $product_id = clean(hide('d', $_POST['item']));
    if (!empty($product_id)) {
        $get = r("SELECT `id` FROM `basket` WHERE `id` = '$product_id' AND `user_id` = '$user_id' AND `status` = 'order'");
        if (mysqli_num_rows($get) == 1) {
            r("DELETE FROM `basket` WHERE `id` = '$product_id'");
        }
    }
}
$total_cart = total_cart();
include 'the.cart.php';
if (isset($_SESSION[$coupon_session])) {
    $co = $_SESSION[$coupon_session];
    $a = get(r("SELECT `minimum` FROM `coupons` WHERE `id` = '$co'"));
    $minimun = $a['minimum'];
    if ($minimun > $total_cart) {
        echo "<script>uncoupon();</script>";
    }
}
?>
