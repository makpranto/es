<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
if (isset($_SESSION[$project_main_session_name])) {
	if (isset($_GET['dflhuoyGASDO78otsad7t8Sfkysvdksyufp8gsdgyuy']) && strlen($_GET['dflhuoyGASDO78otsad7t8Sfkysvdksyufp8gsdgyuy']) > 10) {

		$idg = hide('d',$_GET['dflhuoyGASDO78otsad7t8Sfkysvdksyufp8gsdgyuy']);
        if (strlen($idg)>0) {
            $idg = clean($idg);
            $db->query("DELETE FROM `basket` WHERE `user_id` ='$user_id' AND `company_id`='$company_id' AND `id` = '$idg' AND `type` = 'quote'");
            header('Location: ./');
        }else {
            header('Location: ./');
        }
    }else {
        header('Location: ./');
    }
}else {
	header('Location: ./');
}
?>
