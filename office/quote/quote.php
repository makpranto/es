<script type="text/javascript">
setTimeout(function() {
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "progressBar": true,
        "preventDuplicates": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "4000",
        "hideDuration": "1000",
        "timeOut": "12000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
 <?php
 include '../heart/heart.php';
 include '../heart/func.php';
 include '../heart/dsfhiusdfhui.php';
 $filo = 0;
 check_access($user_id, 'sell');
if (!isset($_POST['product_quantity']) || !isset($_POST['product_name'])) {
    echo "toastr.error('Bad practice detected.');";
    $filo = 20;
}else {
    $product_name = mb_strtoupper(clean($_POST['product_name']));
    $product_quantity = mb_strtoupper(clean($_POST['product_quantity']));
    if ($product_quantity == '') {
        echo "toastr.error('Submit the product\'s quantity.');";
        $filo = 20;
    }elseif (!number($product_quantity, 3)) {
        echo 'toastr.error("Product quantity has to be a whole number.");';
        $filo = 20;
    }
    if (empty($product_name)) {
        echo 'toastr.error("Submit product name.");';
        $filo = 20;
    }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `zvinhu` WHERE (`ahead`='$product_name' OR `product_code`='$product_name' OR `product_name`='$product_name') AND `company_id` = '$company_id'")) != 1) {
        echo "toastr.error('$product_name is not yet on the database.');";
        $filo = 20;
    }else {
        $product_details = $db->query("SELECT * FROM `zvinhu` WHERE (`ahead`='$product_name' OR `product_code`='$product_name' OR `product_name`='$product_name') AND `company_id` = '$company_id'");
        $a = mysqli_fetch_array($product_details);
        $product_id = $a['id'];
        $main_get_product_details = $db->query("SELECT `on_hand`, `selling_price`, `zvinhu`.`discount` ,`product_name`, `product_code`,sum(`qty`) as `qty` FROM `zvinhu` JOIN `basket` ON `basket`.product_id = `zvinhu`.id
        WHERE `basket`.`product_id` = '$product_id'  AND basket.`company_id` = '$company_id' AND basket.`type`='quote'");
        if (mysqli_num_rows($main_get_product_details)>=1) {
            while ($z = mysqli_fetch_array($main_get_product_details)) {
                $on_hand = $z['on_hand']-$z['qty'];
                $product_name = $z['product_name'];
                $disc = $z['discount'];
                $selling_price = $z['selling_price'];
            }
            if ($on_hand == '') {
                $main_get_product_detailss = $db->query("SELECT `on_hand`, `selling_price`, `zvinhu`.`discount`, `product_name`, `product_code` FROM `zvinhu` WHERE `id` = '$product_id'");
                if (mysqli_num_rows($main_get_product_detailss)>=1) {
                    while ($zs = mysqli_fetch_array($main_get_product_detailss)) {
                        $on_hand = $zs['on_hand'];
                        $product_name = $zs['product_name'];
                        $disc = $zs['discount'];
                        $selling_price = $zs['selling_price'];
                    }
                }
            }
        }
    }
    if ($filo == 0) {
        if ($selling_price == '0.00') {
            echo "toastr.error('Please set the selling price for $product_name.');";
        }else {
            $now = date('Y-m-d H:i:s');
            if ($db->query("INSERT INTO `basket`( `discount`,`product_id`, `qty`, `user_id`, `type`, `company_id`, `time_of_insert`) VALUES ('0.00','$product_id','$product_quantity','$user_id','quote','$company_id', '$now')")) {
                $dream = "chil";
            }else {
                echo "toastr.error('An error occured. Please contact Tysla Solutions. Error code is <b>pos_112_</b>');";
            }
        }
    }
}
?>
}, 0);

</script>
<?php include 'Hikkjshjshdjsdb.php' ?>
