<?php
include '../heart/a.php';
secure('receive');
$now = date('Y-m-d H:i:s');
$get_basket = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'new'");
if (mysqli_num_rows($get_basket)>0) {
    while ($a = mysqli_fetch_array($get_basket)) {
        $on_hand_2 = $a['qty'];
        $product_id = $a['product_id'];
        $unit_price = $a['unit_price'];
        $sp = $a['buying_price'];
        $id = $a['id'];
        $on_hand_1 = pull('on_hand', 'zvinhu', "`id` = '$product_id'");
        $selling_price = pull('selling_price', 'zvinhu', "`id` = '$product_id'");
        $buying_price = pull('buying_price', 'zvinhu', "`id` = '$product_id'");
        $status = pull('status', 'zvinhu', "`id` = '$product_id'");
        if ($status != 1) {
            r("UPDATE `zvinhu` SET `status` = '1', `date_added` = '$now'  WHERE `id` = '$product_id'");
        }
        $mop = 'groc';
        $tab = 'zvinhu';
        r("UPDATE `zvinhu` SET `on_hand` = (`on_hand`+$on_hand_2), `selling_price` = '$sp', `last_received_on` = '$now', `buying_price` = '$unit_price' WHERE `id` = '$product_id'");
        r("INSERT INTO `changes`(`user_id`, `product_id`, `on_hand_1`, `on_hand_2`, `buying_price_1`, `buying_price_2`, `selling_price_1`, `selling_price_2`, `type`, `time_of_change`)
        VALUES ('$user_id','$product_id','$on_hand_1','$on_hand_2','$buying_price','$unit_price','$selling_price','$sp','auto','$now')");
            r("DELETE FROM `basket` WHERE `id`= '$id'");
        }
        success('Goods were successfully added to the database.');
}else {
    error('Your basket is currently empty.');
}
