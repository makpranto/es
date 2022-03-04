<?php
include 'fun.php';
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
}else {
    if (there('coupon')) {
        $coupon = mb_strtoupper(clean(str_replace(' ', '', $_POST['coupon'])));
        if (empty($coupon)) {
            if (isset($_SESSION[$coupon_session])) {
                echo "<script>
                check_out();
                cart_count();
                </script>";
                unset($_SESSION[$coupon_session]);
                success("Coupon has been removed.");
            }else {
                error('Please enter the coupon.');
            }
        }elseif (mysqli_num_rows(r("SELECT `id` FROM `coupons` WHERE `coupon` = '$coupon'")) < 1) {
            error("The coupon has not been found.");
        }elseif (mysqli_num_rows(r("SELECT `id` FROM `coupons` WHERE `coupon` = '$coupon' AND `status` != 'ACTIVE'")) >= 1) {
            error("The coupon was already used.");
        }elseif (mysqli_num_rows(r("SELECT `id` FROM `coupons` WHERE `coupon` = '$coupon' AND `status` = 'ACTIVE'")) > 0) {
            $a = get(r("SELECT * FROM `coupons` WHERE `coupon` = '$coupon'"));
            $cid = $a['id'];
            $minimun = $a['minimum'];
            if ($minimun > $total) {
                error("This coupon works if you buy items worth $$minimun");
            }else {
                success('Coupon applied successfully.');
                $dfvok = 'sdfljkdf';
                $_SESSION[$coupon_session] = $cid;
                $a = get(r("SELECT * FROM `coupons` WHERE `id` = '$cid'"));
            }
        }
    }
}

?>
<?php if (isset($dfvok)): ?>
    Discount Code (<?php echo $a['coupon']; ?>)
    <strong class="float-right text-success">
        - $<?php echo amount($a['amount']); ?>
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
