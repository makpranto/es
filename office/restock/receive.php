<?php
include '../heart/a.php';
secure('receive');
$filo = 0;
if (!there('product_quantity') || !there('product_name') || !there('unit_price') || !there('selling_price')) {
    error('Bad practice detected.');
}else {
    $product_name = mb_strtoupper(clean($_POST['product_name']));
    $product_quantity = mb_strtoupper(clean($_POST['product_quantity']));
    $unit_price = clean($_POST['unit_price']);
    $selling_price = clean($_POST['selling_price']);
    if ($product_quantity == '') {
        error('Submit the product\'s quantity.');
        $filo = 20;
    }elseif (!number($product_quantity, 3)) {
        error("Product quantity has to be a whole number.");
        $filo = 20;
    }

    if (empty($product_name)) {
        error("Submit product name.");
        $filo = 20;
    }elseif (mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `product_name` = '$product_name'")) != 1) {
        error("$product_name is not yet on the database.");
        $filo = 20;
    }
    if (empty($unit_price)) {
        error('Submit the unit buying price.');
        $filo = 200;
    }elseif (figure($unit_price)) {
        $unit_price = amount($unit_price);
    }else {
        error('Please submit a valid unit buying price.');
        $filo = 200;
    }
    if (empty($selling_price)) {
        error('Submit the unit selling price.');
        $filo = 200;
    }elseif (figure($selling_price)) {
        $selling_price = amount($selling_price);
    }else {
        error('Please submit a valid unit selling price.');
        $filo = 200;
    }
    if ($filo == 0) {
        if ($selling_price<$unit_price) {
            error("Selling price cannot be lower than buying price.");
        }else {
            $a = get(r("SELECT * FROM `zvinhu` WHERE `product_name` = '$product_name'"));
            $product_id = $a['id'];
            $on_hand = $a['on_hand'];
            $product_name = $a['product_name'];
            $disc = $a['discount'];
            $now = date('Y-m-d H:i:s');
            if ($db->query("INSERT INTO `basket`(`buying_price`, `unit_price`,`product_id`, `qty`, `user_id`, `type`, `company_id`, `time_of_insert`) VALUES ('$selling_price', '$unit_price','$product_id','$product_quantity','$user_id','new','$company_id', '$now')")) {
            }else {
                error('An error occured. Please contact Tysla Solutions. Error code is <b>pos_112_</b>');
            }
        }

    }
}
include 'UdfghvscfJpoury.php' ?>
