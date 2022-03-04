<?php
include '../heart/a.php';
secure('add_new_stock');
if (!there('att_name') || !there('attribute') || !there('s')) {
    error("Bad practice has been detected.");
}else {
    $att_name = clean($_POST['att_name']);
    $attribute = cleaned($_POST['attribute']);
    $pro_id = clean(hide('d', $_POST['s']));
    if (mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `id` = '$pro_id'")) == 1) {
        if (mysqli_num_rows(r("SELECT `id` FROM `att` WHERE `pro_id` = '$pro_id'")) < 20) {
            if (empty($att_name) || empty($attribute)) {
                error("All fields are required.");
            }elseif (strlen(trim($_POST['att_name'])) < 3) {
                error("Attribute\'s name has to be greater than 3 characters.");
            }elseif (strlen(trim($_POST['att_name'])) > 15) {
                error("Attribute\'s name has to be less than 15 characters.");
            }elseif (mysqli_num_rows(r("SELECT `id` FROM `att` WHERE `att_name` = '$att_name' AND `pro_id` = '$pro_id'")) > 0) {
                error("$att_name is already there for this prooduct.");
            }elseif (strlen(trim($_POST['attribute'])) <= 2) {
                error("Attribute has to be greater than 2 characters.");
            }elseif (strlen(trim($_POST['attribute'])) > 100) {
                error("Attribute has to be less than 100 characters.");
            }else {
                $f = "INSERT INTO `att`(`att_name`, `att_text`, `status`, `pro_id`, `added_by`) VALUES ('$att_name', '$attribute', '1', '$pro_id', '$user_id')";
                if (r($f)) {
                    success("$att_name has been added successfully.");
                    echo "<script>$('#add_attribute').modal('toggle');</script>";

                }
            }
        }else {
            error("You cannot add more than 20 attributes to a single product.");
        }
    }else {
        error("Product has not been found.");
    }
    $pro_id =  $_POST['s'];
    include 'atb.php';
}
 ?>
