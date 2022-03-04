<?php
include '../heart/a.php';
secure('sell');
$co = 0;
$worth = 0;
$ese = r("SELECT `qty`, `selling_price`, `zvinhu`.`buying_price` AS `buying_price`, `basket`.`discount` AS `sed` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
while ($ba = mysqli_fetch_array($ese) ) {
    $co += $ba['qty'];
    $worth = $worth+(($ba['qty']*$ba['selling_price']));
    $worth = $worth - ($ba['sed']* $ba['qty']);
}
$worth = amount($worth);
$mops = [];
$mo =[];
$rpl = r("SELECT `name`, `rate` FROM `payment_methods` WHERE `status` = 'ACTIVE'");
while ($m = get($rpl)) {
    $ha = hide('e', $m['name']);
    array_push($mops, $ha);
    array_push($mo, $m['rate']);
}
foreach ($mops as $ey) {
    if (!isset($_POST["$ey"])) {
        $c = 20;
    }
}
$er = 0;
if (!isset($c)) {
    $red = 0;
    $to = 0;
    while ($red != count($mo)) {
        $method_name = hide('d', $mops[$red]);
        if (!empty($_POST[$mops[$red]])) {
            if (figure($_POST[$mops[$red]])) {
                $to = $to+($_POST[$mops[$red]]/$mo[$red]);
            }else {
                error("Sumbit a valid $method_name value.");
                $er = 20;
            }
        }
        $red++;
    }
}
$to = amount($to);
$balance = $worth-$to;
$worth = amount($worth);
$now = now();
$sale_id = generate_coupon().generate_coupon();
if (count($mo)> 0 && $to == 0) {
    error('Please submit the amount.');
}elseif ($to<$worth) {
    $diff = amount($worth - $to);
    error("You need USD$$diff more.");
}elseif (!there('client_name') || !there('phone') || !there('email_address')) {
    error('Bad practice detected.');
}elseif (mysqli_num_rows(r("SELECT `id` FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'sale'")) == 0) {
    error("Add items to the cart.");
}else {
    $client_name = mb_strtoupper(clean($_POST['client_name']));
    $phone = clean(str_replace(' ', '', $_POST['phone']));
    $email_address = mb_strtolower(clean($_POST['email_address']));

    if (empty($client_name)) {
        error("Submit the client\'s name.");
    }elseif (mysqli_num_rows(r("SELECT `id` FROM `walk_in_clients` WHERE `full_name` = '$client_name'")) > 0) {
        $now = date('Y-m-d H:i:s');
        r("INSERT INTO `walk_in_clients` (`full_name`, `email`, `phone`, `added_by`, `added_on`, `kind`) VALUES ('$client_name', '$email_address', '$phone', '$user_id', '$now', 'sale' )");
        $customer_id = pull('id', 'walk_in_clients', "`full_name` = '$client_name'");
        $_SESSION['tysla_retail customer SESSIONS name'] = $customer_id;
        $dpo = 20;
        $eses = r("SELECT `zvinhu`.`id` AS `product_id`, `zvinhu`.`buying_price` AS `buying_price`, `selling_price`, `basket`.`id` AS `id`, `basket`.`qty` `qty`, `basket`.`discount` AS `disco` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
        while ($a = get($eses)) {
            $product_id = $a['product_id'];
            $id = $a['id'];
            $qty = $a['qty'];
            $buying_price = amount($a['buying_price']);
            $selling_price = amount($a['selling_price']);
            $rtgs_rate = pull('rate', 'payment_methods', "`name` = 'RTGS'");
            $bond_rate = pull('rate', 'payment_methods', "`name` = 'BOND'");
            $usd = clean(amount($_POST[hide('e', 'USD')]));
            $bond = clean(amount($_POST[hide('e', 'BOND')]));
            $rtgs = clean(amount($_POST[hide('e', 'RTGS')]));
            $total_usd = amount($worth);
            $total_bond = amount($bond_rate*$worth);
            $total_rtgs = amount($rtgs_rate*$worth);
            $done = "INSERT INTO `sales`(`product_id`, `qty`, `bought_at`, `sold_at`, `user_id`, `processed_at`, `rtgs_rate`, `bond_rate`, `usd`, `rtgs`, `bond`, `sale_id`, `total_usd`,`total_bond`, `total_rtgs`, `customer_id`)
            VALUES ('$product_id', '$qty', '$buying_price', '$selling_price', '$user_id', '$now', '$rtgs_rate', '$bond_rate', '$usd', '$rtgs', '$bond', '$sale_id', '$total_usd', '$total_bond', '$total_rtgs', '$customer_id')";
            if (r($done)) {
                // r("DELETE FROM `basket` WHERE `id`= '$id'");
                // r("UPDATE `zvinhu` SET `on_hand`= (`on_hand` - $qty) WHERE `id` = '$product_id'");
            }else {
                error("Something went wrong.");
            }
        }
        include 'save_client_details_both.php';
    }elseif (strlen($client_name)< 3) {
        error('Please submit a valid customer\'s name.');
    }elseif (empty($phone)) {
        error("Phone number is required.");
    }elseif (!preg_match("/^[\+]?[0-9]{5,13}$/", $phone)) {
        error('Please submit a valid phone number.');
    }elseif (!empty($email_address) && !valid_email($email_address)) {
        error('Please submit a valid email address.');
    }else {
        $now = date('Y-m-d H:i:s');
        r("INSERT INTO `walk_in_clients` (`full_name`, `email`, `phone`, `added_by`, `added_on`, `kind`) VALUES ('$client_name', '$email_address', '$phone', '$user_id', '$now', 'sale' )");
        $customer_id = pull('id', 'walk_in_clients', "`full_name` = '$client_name'");
        $_SESSION['tysla_retail customer SESSIONS name'] = $customer_id;
        $dpo = 20;
        $eses = r("SELECT `zvinhu`.`id` AS `product_id`, `zvinhu`.`buying_price` AS `buying_price`, `selling_price`, `basket`.`id` AS `id`, `basket`.`qty` `qty`, `basket`.`discount` AS `disco` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
        while ($a = get($eses)) {
            $product_id = $a['product_id'];
            $id = $a['id'];
            $qty = $a['qty'];
            $buying_price = amount($a['buying_price']);
            $selling_price = amount($a['selling_price']);
            $rtgs_rate = pull('rate', 'payment_methods', "`name` = 'RTGS'");
            $bond_rate = pull('rate', 'payment_methods', "`name` = 'BOND'");
            $usd = clean(amount($_POST[hide('e', 'USD')]));
            $bond = clean(amount($_POST[hide('e', 'BOND')]));
            $rtgs = clean(amount($_POST[hide('e', 'RTGS')]));
            $total_usd = amount($worth);
            $total_bond = amount($bond_rate*$worth);
            $total_rtgs = amount($rtgs_rate*$worth);
            $done = "INSERT INTO `sales`(`product_id`, `qty`, `bought_at`, `sold_at`, `user_id`, `processed_at`, `rtgs_rate`, `bond_rate`, `usd`, `rtgs`, `bond`, `sale_id`, `total_usd`,`total_bond`, `total_rtgs`, `customer_id`)
            VALUES ('$product_id', '$qty', '$buying_price', '$selling_price', '$user_id', '$now', '$rtgs_rate', '$bond_rate', '$usd', '$rtgs', '$bond', '$sale_id', '$total_usd', '$total_bond', '$total_rtgs', '$customer_id')";
            if (r($done)) {
                // r("DELETE FROM `basket` WHERE `id`= '$id'");
                // r("UPDATE `zvinhu` SET `on_hand`= (`on_hand` - $qty) WHERE `id` = '$product_id'");
            }else {
                error("Something went wrong.");
            }
        }
        include 'save_client_details_both.php';

    }
}
