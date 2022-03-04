<?php
include '../heart/a.php';
secure('stock');
if (!there('id') || !there('quant')) {
    error('Bad practice has been detected');
}else {

    $id = clean(hide('d', hide('d', $_POST['id'])));
    $quantity = (clean($_POST['quant']));
    $get = r("SELECT * FROM `stock_taking` WHERE `id` = '$id'");
    if (mysqli_num_rows($get) == 1) {
        if (!quant($quantity) && $quantity != 0 || !number($quantity, 3)) {
            error('Please submit a valid quantity.');
        }else {
            $variance = 0;
            $f = get($get);
            $product_id = $f['product_id'];
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
            }elseif ($quantity>$on_hand) {
                $variance = "+".($quantity-$on_hand);
            }else {
                $variance = ($on_hand-$quantity);
                $variance = "-$variance";
            }
            $now = now();
            $basket = "UPDATE `stock_taking` SET `user_id` = '$user_id',  `variance` = '$variance', `buying_price` = '$buying_price', `selling_price` = '$selling_price', `date_of_stock` = '$now', `stock_id` = '$stock_id', `status` = 'in_cart' WHERE `id` = '$id'";
            if ($db->query($basket)) {
                if ($db->affected_rows == 1) {
                    success( 'Changes were effected.');
                }else {
                    warn('No changes were made.');
                }
            }else {
                error("Something went wrong.");
            }
        }
    }else {
        error('Bad practice has been detected');
    }
}
include 'cartx.php';?>
