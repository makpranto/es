<?php
include '../heart/a.php';
secure('stock');
if (!there('file')) {
    error("Bad practice has been detected.");
}else {
    $file = hide('d', $_POST['file']);
    if (mysqli_num_rows(r("SELECT `id` FROM `stock_taking` WHERE `stock_id` = '$file' LIMIT 1")) != 1) {
        error("Bad practice has been detected.");
    }else {
        r("DELETE FROM `stock_taking` WHERE `status` = 'in_cart'");
        echo "t";
    }
}
