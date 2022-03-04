<?php
include '../heart/a.php';
secure('start_order');
if (there('id')) {
	$idg = hide('d',$_POST['id']);
    if (strlen($idg)>0) {
        $idg = clean($idg);
        r("DELETE FROM `basket` WHERE `user_id` ='$user_id' AND `id` = '$idg' AND `status` = 'in_cart' AND `type` = 'pricing'");
    }else {
        header('Location: ./');
    }
}
include 'basket.php'  ?>
