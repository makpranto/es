<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'mops');
if (!isset($_POST['name']) || !isset($_POST['rate'])) {
   block($user_id);
}else {
    $name = mb_strtoupper(clean($_POST['name']));
    $rate = mb_strtoupper(clean($_POST['rate']));
    if ($name == '') {
        error("Submit the method\'s name.");
    }elseif (!ls($name)) {
        error("Submit a valid method name with only letters and spaces.");
    }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `company_mop` WHERE `name`='$name' AND `company_id` = '$company_id'")) != 0) {
        error('The method is already registered.');
    }elseif (empty($rate)) {
        error('What is the exchange rate?');
    }elseif (!figure($rate)) {
        error("Please submit a valid exchange rate.");
    }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `company_mop` WHERE `name`='$name' AND `company_id` = '$company_id'")) != 0) {
        error('The method is already registered.');
    }else{
        $rate = amount($rate);
        $now = date('Y-m-d H:i:s');
        $dba = ("INSERT INTO `company_mop`(`company_id`, `name`, `exchange_rate_to_us`, `status`) VALUES ('$company_id', '$name', '$rate', '1')");
        if (r($dba)) {
            success("Method of payment has been added successfully.");
        }else {
            block($user_id);
        }
    }
}
include 'tab_le.php';
?>
