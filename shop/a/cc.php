<?php
include 'fun.php';
global $user_id;
$total = 0;
$z = get(r("SELECT SUM(`qty`) AS `fg` FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order'"));
if ($z['fg'] == '') {
    echo '0';
}else {
    echo $z['fg'];
}
