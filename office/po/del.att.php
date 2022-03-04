<?php
include '../heart/a.php';
secure('add_new_stock');
if (!there('s')) {
    error("Bad practice has been detected.");
}else {
    $att_id = clean(hide('d', $_POST['s']));
    if (mysqli_num_rows(r("SELECT `id` FROM `att` WHERE `id` = '$att_id'")) > 0) {
        $pro_id =  hide('e', pull('pro_id', 'att', "`id` = '$att_id'"));
        r("DELETE FROM `att` WHERE `id` = '$att_id'");
        success("Attribute has been deleted.");
        include 'atb.php';
    }
}
?>
