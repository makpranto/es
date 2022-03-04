<?php
include '../heart/a.php';
secure('sell');
$mops = [];
$mo =[];
$worth = 0.00;
$co = 0;
$basket = r("SELECT `qty`, `selling_price`, `basket`.`discount` AS `sed` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
while ($ba = mysqli_fetch_array($basket) ) {
    $co += $ba['qty'];
    $worth = $worth+(($ba['qty']*$ba['selling_price']));
    $worth = $worth - ($ba['sed']* $ba['qty']);
}
$worth = amount($worth);
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
if (isset($c)) {
    error("Something went wrong.");
    $er = 20;
}else {
    $red = 0;
    $to = 0;
    while ($red != count($mo)) {
        $method_name = hide('d', $mops[$red]);
        if (!empty($_POST[$mops[$red]]) && $_POST[$mops[$red]][0] != '.') {
            if (figure($_POST[$mops[$red]])) {
                $to = $to+($_POST[$mops[$red]]/$mo[$red]);
            }else {
                error("Sumbit a valid $method_name value.");
                $er = 20;
            }
        }
        $red++;
    }
    $to = amount($to);
    $balance = $worth-$to;
    if ($balance < 0) {
        $balance = $to - $worth;
        echo "<h2 class='text-navy'> US$".mari($balance). " | BOND".mari((($balance*pull('rate', 'payment_methods', "`name` = 'BOND'"))))." | RTGS $".mari((($balance*pull('rate', 'payment_methods', "`name` = 'RTGS'")))).'</h2>';
    }else {
        if ($balance == 0) {
            echo "<h2 class='text-navy'> US$".mari($balance). " | BOND".mari((($balance*pull('rate', 'payment_methods', "`name` = 'BOND'"))))." | RTGS $".mari((($balance*pull('rate', 'payment_methods', "`name` = 'RTGS'")))).'</h2>';
        }else {
            echo "<h2 class='text-danger'> US$".mari($balance). " | BOND".mari((($balance*pull('rate', 'payment_methods', "`name` = 'BOND'"))))." | RTGS $".mari((($balance*pull('rate', 'payment_methods', "`name` = 'RTGS'")))).'</h2>';
        }
    }
}
?>
