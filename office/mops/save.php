<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'mops');
if (!isset($_POST['name']) || !isset($_POST['rate']) || !isset($_POST['status'])) {
    error('Oops, that didn\'t work.');
}else {
    $id = clean(hide('d', $_POST['id']));
    $name = mb_strtoupper(clean($_POST['name']));
    $rate = clean($_POST['rate']);
    $sta = mb_strtoupper(clean($_POST['status']));
    if (empty($id)) {
        block($user_id);
    }elseif (mysqli_num_rows(r("SELECT `id` FROM `company_mop` WHERE `id` = '$id' AND `company_id` = '$company_id'")) != 1) {
        block($user_id);
    }elseif (empty($name)) {
        error("Please submit the method\'s name.");
    }elseif (!ls($name)) {
        error("Please submit a valid method name that has only letters and numbers.");
    }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `company_mop` WHERE `name`='$name'  AND `company_id` = '$company_id' AND `id` != '$id'")) != 0) {
        error("Another method exists with the same name as you submitted.");
    }elseif ($sta != 'YES' AND $sta != 'NO') {
        error('For Status, type YES or No.');
    }else {
        if ($sta == 'YES') {
            $s = 1;
        }else {
            $s = 0;
        }
        $rate = amount($rate);
        if ($db->query("UPDATE `company_mop`  SET `name` = '$name', `exchange_rate_to_us` = '$rate', `status` = '$s' WHERE `id` = '$id'")) {
            if (mysqli_affected_rows($db) == 1) {
                success('Changes were saved successfully.');
            }else {
                warn("No changes were made.");
            }
        }else {
            block($user_id);
        }
    }
}
include 'tab_le.php';
?>
