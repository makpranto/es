<?php
include '../heart/a.php';
secure('add_new_stock');
if (!there('att_name') || !there('attribute') || !there('s')) {
    error("Bad practice has been detected.");
}else {
    $att_name = clean($_POST['att_name']);
    $attribute = cleaned($_POST['attribute']);
    $att_id = clean(hide('d', $_POST['s']));
    if (mysqli_num_rows(r("SELECT `id` FROM `att` WHERE `id` = '$att_id'")) > 0) {
        $pro_id =  hide('e', pull('pro_id', 'att', "`id` = '$att_id'"));
        $pro_ids =  pull('pro_id', 'att', "`id` = '$att_id'");
        if (empty($att_name) || empty($attribute)) {
            error("All fields are required.");
        }elseif (strlen(trim($_POST['att_name'])) < 3) {
            error("Attribute\'s name has to be greater than 3 characters.");
        }elseif (strlen(trim($_POST['att_name'])) > 15) {
            error("Attribute\'s name has to be less than 15 characters.");
        }elseif (mysqli_num_rows(r("SELECT `id` FROM `att` WHERE `att_name` = '$att_name'  AND `id` != '$att_id' AND `pro_id` = '$pro_ids'")) > 0) {
            error("$att_name is already there for this prooduct.");
        }elseif (strlen(trim($_POST['attribute'])) <= 2) {
            error("Attribute has to be greater than 2 characters.");
        }elseif (strlen(trim($_POST['attribute'])) > 100) {
            error("Attribute has to be less than 100 characters.");
        }else {
            $time = now();
            $dfh = "UPDATE `att` SET `att_name` = '$att_name', `att_text` = '$attribute', `status` = '1' WHERE `id` = '$att_id'";
            if ($db->query($dfh)) {
                if ($db->affected_rows == 1) {
                    r("UPDATE `att` SET `last_edited_on` = '$time',`last_edited_by`='$user_id' WHERE `id` = '$att_id'");
                    success("Changes have been saved.");
                    echo "<script>$('#edit_attribute_modal').modal('toggle');</script>";
                }else {
                    error("No changes have were made.");
                    echo "<script>$('#edit_attribute_modal').modal('toggle');</script>";
                }
            }else {
                error("Something went wrong.");
                echo "<script>$('#edit_attribute_modal').modal('toggle');</script>";
            }
        }
        include 'atb.php';
    }else {
        error("You cannot add more than 20 attributes to a single product.");
    }
}
?>
