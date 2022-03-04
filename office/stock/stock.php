<?php
include '../heart/a.php';
secure('stock');
if (!there('product') || !there('quant') || !there('quantity')) {
    error('Bad practice has been detected');
}else {
    $product_id = clean(hide('d', hide('d', $_POST['product'])));
    $quantity = (clean($_POST['quant']));
    $get = r("SELECT * FROM `zvinhu` WHERE `id` = '$product_id'");
    if (mysqli_num_rows($get) == 1) {
        if (!quant($quantity) && $quantity != 0 || !number($quantity, 3)) {
            error('Please submit a valid quantity.');
        }else {
            $variance = 0;
            $product_name = pull('product_name', 'zvinhu', "`id` = '$product_id'");
            $buying_price = pull('buying_price', 'zvinhu', "`id` = '$product_id'");
            $selling_price = pull('selling_price', 'zvinhu', "`id` = '$product_id'");
            $on_hand = pull('on_hand', 'zvinhu', "`id` = '$product_id'");
            $stock_id = pull('stock_id', 'stock_taking', "`status` = 'in_cart' LIMIT 1");
            if (empty($on_hand)) {
                $on_hand = 0;
            }
            if (empty($stock_id)) {
                $stock_id = str_shuffle("SDSKDKJBSKDISBHDIABUSYGD^GUSDGASUHSDYGSDALMKOSO").time();
            }
            if ($quantity == $on_hand) {
                // code...
            }elseif ($quantity>$on_hand) {
                $variance = "+".($quantity-$on_hand);
            }else {
                $variance = ($on_hand-$quantity);
                $variance = "-$variance";
            }
            $now = now();
            $basket = "INSERT INTO `stock_taking`(`user_id`, `product_id`, `variance`, `buying_price`, `selling_price`, `date_of_stock`, `stock_id`, `status`) VALUES ('$user_id','$product_id','$variance', '$buying_price', '$selling_price', '$now', '$stock_id', 'in_cart')";
            r($basket);
        }
    }else {
        error('Bad practice has been detected');
    }
}
include 'cart.php';?>
