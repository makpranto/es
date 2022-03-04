<?php
include '../heart/a.php';
$filo = 0;
secure('sell');
if (!isset($_POST['product_quantity']) || !isset($_POST['product_name']) || (access($user_id, 'discount') AND !isset($_POST['discount'])) ) {
    error('Bad practice detected.');
    $filo = 20;
}else {
    $product_name = (clean($_POST['product_name']));
    $product_quantity = clean($_POST['product_quantity']);
    if (!empty($_POST['discount']) && access($user_id, 'discount')) {
        $discount = clean($_POST['discount']);
        if (!figure($discount)) {
            error("Discount has to be an amount.");
            $filo = 20;
        }
    }else {
        $discount = '0.00';
    }
    if (empty($product_quantity)) {
        error("Submit the product\'s quantity.");
        $filo = 20;
    }elseif (!number($product_quantity, 3)) {
    // }elseif (!number($product_quantity, 5) && !breakable()) {

        error("Product quantity has to be a whole number.");
        $filo = 20;
    }elseif (empty($product_name)) {
        error("Submit product name.");
        $filo = 20;
    }elseif (mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE  `product_name`='$product_name'")) != 1) {
        error("$product_name is not yet on the database.");
        $filo = 20;
    }elseif (mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE  `product_name`='$product_name' AND `status` != '1'")) == 1) {
        error("$product_name is not active.");
        $filo = 20;
    }else {
        $product_details = r("SELECT * FROM `zvinhu` WHERE `product_name`='$product_name'");
        $a = get($product_details);
        $product_id = $a['id'];
        $main_get_product_details = r("SELECT `on_hand`, `selling_price`, `zvinhu`.`discount` ,`product_name`, sum(`qty`) as `qty` FROM `zvinhu` JOIN `basket` ON `basket`.product_id = `zvinhu`.id
        WHERE `basket`.`product_id` = '$product_id' AND basket.`type`='sale'");
        if (mysqli_num_rows($main_get_product_details)>=1) {
            while ($z = get($main_get_product_details)) {
                $on_hand = $z['on_hand'];
                $qty = $z['qty'];
                $product_name = $z['product_name'];
                $disc = $z['discount'];
                $selling_price = $z['selling_price'];
            }
            if ($on_hand == '') {
                $main_get_product_detailss = r("SELECT `on_hand`, `selling_price`, `zvinhu`.`discount`, `product_name` FROM `zvinhu` WHERE `id` = '$product_id'");
                if (mysqli_num_rows($main_get_product_detailss)>=1) {
                    while ($zs = get($main_get_product_detailss)) {
                        $on_hand = $zs['on_hand'];
                        $product_name = $zs['product_name'];
                        $disc = $zs['discount'];
                        $selling_price = $zs['selling_price'];
                    }
                }
            }
            if ($selling_price == 0) {
                error('Please set the price of the product first.');
                $filo = 20;
            }
        }
    }
    if ($filo == 0) {
        $discount = $discount/$product_quantity;
        $disc = 0;
        if ($discount > ($disc * $selling_price)) {
            $loop = amount($disc* $selling_price);
            error("Maximum discount for this product is $$loop");
        }else {
            $discount = amount($discount);
            $now = date('Y-m-d H:i:s');
            if ($on_hand <($product_quantity+$qty)) {
                error("You currently have $on_hand available in stock.");
            }else {
                if (r("INSERT INTO `basket`( `discount`,`product_id`, `qty`, `user_id`, `type`, `time_of_insert`) VALUES ('$discount','$product_id','$product_quantity','$user_id','sale','$now')")) {
                    $dream = "chil";
                }else {
                    error('An error occured. Please contact Tysla Solutions. Error code is <b>pos_112_</b>');
                }
            }
        }
    }
}
include 'basket.php'; ?>
