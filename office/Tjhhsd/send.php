<script type='text/javascript'>
setTimeout(function() {
    toastr.options = {
        'closeButton': true,
        'debug': true,
        'progressBar': true,
        'preventDuplicates': false,
        'positionClass': 'toast-top-center',
        'onclick': null,
        'showDuration': '4000',
        'hideDuration': '1000',
        'timeOut': '12000',
        'extendedTimeOut': '1000',
        'showEasing': 'swing',
        'hideEasing': 'linear',
        'showMethod': 'fadeIn',
        'hideMethod': 'fadeOut'
    };
<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'adjust_static');
if (!isset($_POST['product_code']) || !isset($_POST['product_name'])
|| !isset($_POST['p_category'])
|| (access($user_id, 'buying_price') && !isset($_POST['buying_price']))
|| (access($user_id, 'selling_price') && !isset($_POST['selling_price']))
|| (access($user_id, 'stock_quantity') && !isset($_POST['on_hand']))
|| (access($user_id, 'dis') && !isset($_POST['discount']))) {
    echo  "toastr.error('Bad practice detected');";
}else {
    $line = "UPDATE `zvinhu` SET ";
    $d = 0;
    $product_code = clean($_POST['product_code']);
    $product_name = mb_strtoupper(clean($_POST['product_name']));
    $category = clean($_POST['p_category']);
    if (access($user_id, 'buying_price')) {
        $buying_price = clean($_POST['buying_price']);
        $buying_price = str_replace('$', '', $buying_price);
    }
    if (access($user_id, 'dis')) {
        $discount = clean($_POST['discount']);
        $discount = str_replace('%', '', $discount);
    }
    if (access($user_id, 'selling_price')) {
        $selling_price = clean($_POST['selling_price']);
        $selling_price = str_replace('$', '', $selling_price);
    }
    if (access($user_id, 'stock_quantity')) {
        $on_hand = clean($_POST['on_hand']);
    }
    $product_id = hide('d', $_POST['id']);
    $product_id = clean($product_id);
    if (!number($product_id, 255)) {
        echo  "toastr.error('bad Practice detected.');";
        $d = 20;
    }else {
        if (empty($product_code)) {
            echo  "toastr.error('Submit a product code.');";
            $d = 20;
        }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `zvinhu` WHERE `product_code` = '$product_code'  AND `company_id` = '$company_id' AND `id` != '$product_id'")) != 0) {
            echo  "toastr.error('You have submitted a product code that\'s already in use.');";
            $d = 20;
        }else {
            $line .= "`product_code` = '$product_code'";
        }
        if (access($user_id, 'buying_price')) {
            if (!figure($buying_price)) {
                echo  "toastr.error('Submit a valid buying price.');";
                $d = 20;
            }else {
                $buying_price = amount($buying_price);
                $line .= ", `buying_price` = '$buying_price'";
            }
        }
        if (access($user_id, 'dis')) {
            if (!figure($discount)) {
                echo  "toastr.error('Submit a valid discount %.');";
                $d = 20;
            }elseif ($discount>20) {
                echo  "toastr.error('Discount cannot be greater than 20%.');";
                $d = 20;
            }else {
                $discount = amount($discount);
                $line .= ", `discount` = '$discount'";
            }
        }
        if (access($user_id, 'selling_price')) {
            if (!figure($selling_price)) {
                echo  "toastr.error('Submit a valid seling price.');";
                $d = 20;
            }else {
                $selling_price = amount($selling_price);
                $line .= ", `selling_price` = '$selling_price'";
            }
        }
        if (empty($product_name)) {
            echo  "toastr.error('Submit a product name.');";
            $d = 20;
        }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `zvinhu` WHERE `product_name` = '$product_name'  AND `company_id` = '$company_id' AND `id` != '$product_id'")) != 0) {
            echo  "toastr.error('You have submitted a product name that\'s already in use.');";
            $d = 20;
        }else {
            $line .= ", `product_name` = '$product_name'";

        }
        if (empty($category)) {
            echo  "toastr.error('Submit a product category.');";
            $d = 20;
        }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `categories` WHERE `name` = '$category'  AND `company_id` = '$company_id'")) != 1) {
            echo  "toastr.error('Submit a valid product category.');";
            $d = 20;
        }else {
            $fg = $db->query("SELECT `id` FROM `categories` WHERE `name` = '$category'  AND `company_id` = '$company_id'");
            $dfgl = mysqli_fetch_array($fg);
            $type =$dfgl['id'];
            $line .= ", `type` = '$type'";
        }
        if (access($user_id, 'stock_quantity')) {
            if (!number($on_hand, 4)) {
                echo  "toastr.error('Submit a valid stock quantity that is less than 9999.');";
                $d = 20;
            }else {
                $line .= ", `on_hand` = '$on_hand'";
            }
        }
        if ($d==0) {
            if (isset($selling_price) && isset($buying_price)) {
                if ($buying_price>$selling_price) {
                    echo  "toastr.error('Buying price cannot be greater than selling price.');";
                }elseif (($selling_price-($selling_price*($discount/100)))<$buying_price && access($user_id, 'dis')) {
                    echo  "toastr.error('Discount % cannot be lass than buying price.');";
                }else {
                    $line .= ", `ahead` = '$product_code - $product_name' WHERE `company_id` = '$company_id' AND `id` = '$product_id'";
                    $glue = "INSERT INTO `changes`(`id`, `user_id`, `company_id`, `product_id`, `on_hand_1`, `on_hand_2`, `buying_price_1`, `buying_price_2`, `selling_price_1`, `selling_price_2`, `type`, `time_of_change`, `invoice_number`, `supplier_id`) VALUES
                    ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14])";

                    if ($db->query($line)) {
                        if ($db->affected_rows == 1) {
                            echo  "toastr.success('Details have been updated.');";
                        }else {
                            echo  "toastr.error('No changes were made.');";

                        }
                    }else {
                        echo  "toastr.error('$product_name\'s details were not updated.');";
                    }
                }
            }else {
                $line .= ", `ahead` = '$product_code - $product_name' WHERE `company_id` = '$company_id' AND `id` = '$product_id'";
                $glue = "INSERT INTO `changes`(`id`, `user_id`, `company_id`, `product_id`, `on_hand_1`, `on_hand_2`, `buying_price_1`, `buying_price_2`, `selling_price_1`, `selling_price_2`, `type`, `time_of_change`, `invoice_number`, `supplier_id`) VALUES
                ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13],[value-14])";

                if ($db->query($line)) {
                    if ($db->affected_rows == 1) {
                        echo  "toastr.success('Details have been updated.');";
                    }else {
                        echo  "toastr.error('No changes were made.');";

                    }
                }else {
                    echo  "toastr.error('$product_name\'s details were not updated.');";
                }
            }
        }
    }
}
 ?>
}, 0);
</script>
<?php include 'tab_le.php' ?>
