<?php
include 'a.php';
if (isset($_SESSION[$project_main_session_name])) {
    $base_currency = pull('base_currency', 'chikwata', "`id` = '$user_id'");
    if ($base_currency == 1) {
        $base_currency = 3;
    }else {
        $base_currency = 1;
    }
    r("UPDATE `chikwata` SET `base_currency` = '$base_currency' WHERE `id` = '$user_id'");
}
?>
<a href="#" onclick="return change_currency();">
    <i class="fa fa-money"></i><?php echo pull('name', 'payment_methods', "`id` = '$base_currency'"); ?>
</a>
