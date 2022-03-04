<?php
include '../heart/a.php';
secure('sell');
if (there('id')) {
	$idg = hide('d',$_POST['id']);
    if (strlen($idg)>0) {
        $idg = clean($idg);
        r("DELETE FROM `basket` WHERE `user_id` ='$user_id' AND `id` = '$idg'");
    }else {
        header('Location: ./');
    }
}
include 'basket.php'  ?>
