<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'coupons');
if (!there('coupons_quantity') || !there('value') || !there('minimum')) {
    error("Bad practice has been detected.");
}else {
    $qua = clean($_POST['coupons_quantity']);
    $val = clean($_POST['value']);
    $min = clean($_POST['minimum']);
    $d = 0;
    if (empty($qua) || empty($val)) {
        error("Please fill in all fields.");
    }else {
        if (!quant($qua)) {
            error("The quantity of the coupons should be a whole number.");
            $d = 50;
        }
        if (!figure($val)) {
            error("Specify a valid value of the coupon.");
            $d = 50;
        }
        if (!empty($min) && !figure($min)) {
            error("Specify a valid minimum purchase value.");
            $d = 50;
        }elseif (!empty($min) && figure($min)){
            $min = amount($min);
        }else {
            $min = 0.00;
        }
        if ($d == 0) {
            $done = 0;
            $ese = $qua;
            while ($qua != 0) {
                $coupon = generate_coupon(12);
                $now = date('Y-m-d H:i:s');
                $val = amount($val);
                $min = amount($min);
                $get = "INSERT INTO `coupons`(`coupon`, `amount`, `minimum`, `created_on`, `status`, `user_id`)
                VALUES ('$coupon', '$val', '$min', '$now', 'ACTIVE', '$user_id')";
                if (r($get)) {
                    $done ++;
                }
                $qua --;
            }
            if ($done == $ese) {
                success("Successfully generated.");
            }else {
                error("$done of $ese coupon(s) were generated.");
            }
        }
    }
}
include "table__.php"
?>
