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
 check_access($user_id, 'add_new_stock');
if (!isset($_POST['product_code']) || !isset($_POST['product_name']) ||  !isset($_POST['product_category'])) {
    echo "toastr.error('Bad practice detected.');";
    $filo = 20;
}else {
    $product_name = mb_strtoupper(clean($_POST['product_name']));
    $product_code = mb_strtoupper(clean($_POST['product_code']));
    $product_category = mb_strtoupper(clean($_POST['product_category']));
    if ($product_code == '') {
        echo "toastr.error('Submit the product\'s code.');";
        $filo = 20;
    }elseif ($product_name == '') {
        echo 'toastr.error("Submit the product\'s name.");';
        $filo = 20;
    }elseif (empty($product_category)) {
        echo 'toastr.error("Submit the product\s category.");';
        $filo = 20;
    }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `zvinhu` WHERE (`ahead`='$product_code' OR `product_code`='$product_code' OR `product_name`='$product_code') AND `company_id` = '$company_id'")) != 0) {
        echo "toastr.error('$product_code is already registered on another product.');";
        $filo = 20;
    }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `zvinhu` WHERE (`ahead`='$product_name' OR `product_code`='$product_name' OR `product_name`='$product_name') AND `company_id` = '$company_id'")) != 0) {
        echo "toastr.error('$product_name is already registered on another product.');";
        $filo = 20;
    }elseif (mysqli_num_rows($db->query("SELECT `id` FROM `categories` WHERE `name` = '$product_category' AND `company_id` = '$company_id'")) != 1) {
        echo "toastr.error('$product_category is not registered as a category.');";
        $filo = 20;
    }else {
        if ($filo == 0) {
            $cat = $db->query("SELECT `id` FROM `categories` WHERE `name` = '$product_category' AND `company_id` = '$company_id'");
            $nest = mysqli_fetch_array($cat);
            $product_cat = $nest['id'];
            $db->query("INSERT INTO `zvinhu`(`status`,`product_name`, `product_code`, `on_hand`, `ahead`, `buying_price`, `selling_price`, `discount`, `company_id`, `user_id`, `last_received_on`, `last_sold_on`, `type`)
             VALUES ('1','$product_name','$product_code','0','$product_code - $product_name','0.00','0.00','0.00','$company_id','$user_id','0000-00-00 00:00:00','0000-00-00 00:00:00','$product_cat')");
            echo "toastr.success('$product_name has been added as a product under $product_category.');";
        }
    }
}
?>
}, 0);

</script>
<?php
include 'tab_le.php';


 ?>
