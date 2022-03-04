<?php
include 'fun.php';
if (!there('product') || !there('quant') || !there('quantity')) {
    cry(1);
}else {
    $product_id = clean(hide('d', hide('d', $_POST['product'])));
    $quantity = number(clean($_POST['quant']));
    $get = r("SELECT * FROM `zvinhu` WHERE `id` = '$product_id'");
    if (mysqli_num_rows($get) == 1) {
        if ($quantity < 1) {
            error("Submit the quantity.");
        }elseif (!quant($quantity)) {
            cry(1);
        }else {
            $product_name = pname(pull('product_name', 'zvinhu', "`id` = '$product_id'"));
            $buying_price = pull('buying_price', 'zvinhu', "`id` = '$product_id'");
            $selling_price = pull('selling_price', 'zvinhu', "`id` = '$product_id'");
            $now = now();
            $basket = "INSERT INTO `basket`(`discount`, `unit_price`, `product_id`, `buying_price`,`qty`, `user_id`, `type`, `time_of_insert`, `status`) VALUES ('0.00','$selling_price','$product_id', '$buying_price', '$quantity', '$user_id', 'out', '$now', 'order')";
            r($basket);
            success("$product_name was added to cart.");
        }
    }else {
        cry(1);
    }
    include 'file.php';
}
include 'the.cart.php';
?>
