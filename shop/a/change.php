<?php
include 'fun.php';
if (!there('product') || !there('quant')) {
    cry(1);
}else {
    $cart = clean(hide('d', hide('d', $_POST['product'])));
    $quantity = number(clean($_POST['quant']));
    $get = r("SELECT * FROM `basket` WHERE `id` = '$cart' AND `user_id` = '$user_id' AND `status` = 'order'");
    if (mysqli_num_rows($get) == 1) {
        if (!quant($quantity) AND $quantity != 0) {
            cry(1);
        }else {
            if ($quantity == 0) {
                r("DELETE FROM `basket` WHERE `id` = '$cart'");
            }else {
                r("UPDATE `basket` SET `qty` = '$quantity' WHERE `id` = '$cart'");
            }
        }
    }else {
        cry(1);
    }
    $total_cart = total_cart();
    include 'the.cart.php';
}
if (isset($_SESSION[$coupon_session])) {
    $co = $_SESSION[$coupon_session];
    $a = get(r("SELECT `minimum` FROM `coupons` WHERE `id` = '$co'"));
    $total_cart = total_cart();
    $minimun = $a['minimum'];
    if ($minimun > $total_cart) {
        echo "<script>uncoupon();</script>";
    }
}
?>
