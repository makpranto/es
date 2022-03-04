<?php
include '../heart/a.php';
secure('stock');
$f = r("SELECT COUNT(`id`) AS `fg`, `stock_id` FROM `stock_taking` WHERE `status` = 'in_cart'");
$a = get($f);
if ($a['fg']>0) {
    $id = hide('e', $a['stock_id']);
    echo $a['fg'] .' out of '.  mysqli_num_rows(r("SELECT `id` FROM `zvinhu`")). ' products.';

    if ($a['fg'] == mysqli_num_rows(r("SELECT `id` FROM `zvinhu`"))) {
        echo "<a href='?finish=true'><button type='submit' class='btn btn-primary pull-right' name='finish'>Finish</button></a>";
    }else {
        echo "<button type='button' class='btn btn-danger pull-right' onclick='return reset(\"$id\");'>Reset</button>";
    }
}
?>
