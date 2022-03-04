<?php
include '../heart/a.php';
$filo = 0;
$discount = '0.00';
secure('start_order');
if (!isset($_POST['product_quantity']) || !isset($_POST['product_name']) || !there('buying_price')) {
    error('Bad practice detected.');
    $filo = 20;
}else {
    $product_name = (clean($_POST['product_name']));
    $product_quantity = clean($_POST['product_quantity']);
    $buying_price = clean($_POST['buying_price']);
    if (empty($product_quantity)) {
        error("Submit the product\'s quantity.");
        $filo = 20;
    }elseif (!number($product_quantity, 3)) {
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
    }elseif (empty($buying_price)) {
        error('Submit the unit buying price.');
        $filo = 200;
    }elseif (!figure($buying_price)) {
        error('Please submit a valid unit buying price.');
        $filo = 200;
    }
    if ($filo == 0) {
        $now = date('Y-m-d H:i:s');
        $product_id = pull('id', 'zvinhu', "`product_name` = '$product_name'");
        if ($base_currency == 3) {
            $buying_price = $buying_price/pull('rate', 'payment_methods', "`id` = '$base_currency'");
        }
        if (r("INSERT INTO `basket`(`currency`,`product_id`, `qty`, `user_id`, `type`, `time_of_insert`, `buying_price`, `status`, `discount`) VALUES ('3', '$product_id','$product_quantity','$user_id','pricing','$now', '$buying_price', 'in_cart', '0')")) {
        }else {
            error('An error occured. Please contact Tysla Solutions. Error code is <b>pos_112_</b>');
        }
    }
}
include 'basket.php'; ?>
