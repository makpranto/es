<?php
include '../heart/a.php';
secure('sell');
if (isset($_SESSION['file'])) {
    $file = $_SESSION['file'];
    echo "<script>
    window.setTimeout(function() {
        window.location.href = '$file';
    }, 500);
    </script>";
    unset($_SESSION['file']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Point of Sale"; ?> </title>
    <?php include '../heart/styles.php'; ?>
</head>
<body class="mini-navbar">
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-content">
                    <div class="row">
                        <?php
                        if (isset($_POST['finish'])) {
                            $co = 0;
                            $worth = 0;
                            $ese = r("SELECT `qty`, `selling_price`, `zvinhu`.`buying_price` AS `buying_price`, `basket`.`discount` AS `sed` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
                            if (mysqli_num_rows($ese) > 0) {
                                while ($ba = mysqli_fetch_array($ese) ) {
                                    $co += $ba['qty'];
                                    $worth = $worth+(($ba['qty']*$ba['selling_price']));
                                    $worth = $worth - ($ba['sed']* $ba['qty']);
                                }
                                $worth = amount($worth);
                                $mops = [];
                                $mo =[];
                                $rpl = r("SELECT `name`, `rate` FROM `payment_methods` WHERE `status` = 'ACTIVE'");
                                while ($m = get($rpl)) {
                                    $ha = hide('e', $m['name']);
                                    array_push($mops, $ha);
                                    array_push($mo, $m['rate']);
                                }
                                foreach ($mops as $ey) {
                                    if (!isset($_POST["$ey"])) {
                                        $c = 20;
                                    }
                                }
                                $er = 0;
                                if (!isset($c)) {
                                    $red = 0;
                                    $to = 0;
                                    while ($red != count($mo)) {
                                        $method_name = hide('d', $mops[$red]);
                                        if (!empty($_POST[$mops[$red]])) {
                                            if (figure($_POST[$mops[$red]])) {
                                                $to = $to+($_POST[$mops[$red]]/$mo[$red]);
                                            }else {
                                                error("Sumbit a valid $method_name value.");
                                                $er = 20;
                                            }
                                        }
                                        $red++;
                                    }
                                    $to = amount($to);
                                    $balance = $worth-$to;
                                    $worth = amount($worth);
                                    $now = now();
                                    $sale_id = generate_coupon().generate_coupon();
                                    if (count($mo)> 0 && $to == 0) {
                                        error('Please submit the amount.');
                                    }elseif ($to<$worth) {
                                        $diff = amount($worth - $to);
                                        error("You need USD$$diff more.");
                                    }else {
                                        $eses = r("SELECT `zvinhu`.`id` AS `product_id`, `zvinhu`.`buying_price` AS `buying_price`, `selling_price`, `basket`.`id` AS `id`, `basket`.`qty` `qty`, `basket`.`discount` AS `disco` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
                                        while ($a = get($eses)) {
                                            $product_id = $a['product_id'];
                                            $id = $a['id'];
                                            $qty = $a['qty'];
                                            $buying_price = amount($a['buying_price']);
                                            $selling_price = amount($a['selling_price']);
                                            $rtgs_rate = pull('rate', 'payment_methods', "`name` = 'RTGS'");
                                            $bond_rate = pull('rate', 'payment_methods', "`name` = 'BOND'");
                                            $usd = clean(amount($_POST[hide('e', 'USD')]));
                                            $bond = clean(amount($_POST[hide('e', 'BOND')]));
                                            $rtgs = clean(amount($_POST[hide('e', 'RTGS')]));
                                            $total_usd = amount($worth);
                                            $total_bond = amount($bond_rate*$worth);
                                            $total_rtgs = amount($rtgs_rate*$worth);
                                            $done = "INSERT INTO `sales`(`product_id`, `qty`, `bought_at`, `sold_at`, `user_id`, `processed_at`, `rtgs_rate`, `bond_rate`, `usd`, `rtgs`, `bond`, `sale_id`, `total_usd`,`total_bond`, `total_rtgs`)
                                            VALUES ('$product_id', '$qty', '$buying_price', '$selling_price', '$user_id', '$now', '$rtgs_rate', '$bond_rate', '$usd', '$rtgs', '$bond', '$sale_id', '$total_usd', '$total_bond', '$total_rtgs')";
                                            if (r($done)) {
                                                r("DELETE FROM `basket` WHERE `id`= '$id'");
                                                r("UPDATE `zvinhu` SET `on_hand`= (`on_hand` - $qty) WHERE `id` = '$product_id'");
                                            }else {
                                                error("Something went wrong.");
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        ?>
                        <form role="form" id="frmBox" method="post">
                            <div class="col-sm-4 b-r">
                                <div class="form-group"><label>Product Quantity</label> <input type="text" autocomplete='off' value='1'  placeholder="Product Quantity" name='product_quantity' class="form-control"></div>
                                <div class="form-group"><label>Product Name</label> <input type="text" placeholder="Product Name"  id="txtCountry" name="product_name" autocomplete='off' class="typeahead_2 form-control" /></div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary m-t-n-xs" onclick="return teal();"><strong>Add to Basket</strong></button>
                                    <button class="btn btn-sm btn-primary m-t-n-xs" onclick="return sell();"><strong>Pay</strong></button>
                                </div>
                            </div>
                            <div id='payment'></div>
                            <tell id="success">
                                <?php if (!isset($dream)  && mysqli_num_rows(r("SELECT `id` FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'sale'")) >0): ?>
                                    <?php include 'basket.php' ?>
                                <?php else: ?>
                                    <?php include 'basket.php' ?>
                                <?php endif; ?>
                            </tell>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../heart/footer.php'; ?>
    </div>
    <?php include '../heart/scripts.php'; ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
    function teal(){
        $.ajax({
            type: 'POST',
            url: 'sell.php',
            data: $('#frmBox').serialize(),
            success:function(response){
                $('#success').html(response);
            }
        });
        return false;
    }
    function pay(){
        $.ajax({
            type: 'POST',
            url: 'pay_.php',
            data: $('#frmBox').serialize(),
            success:function(response){
                $('#rel').html(response);
            }
        });
        return false;
    }
    $(document).ready(function () {
        $('#txtCountry').typeahead({
            source: function (query, result) {
                $.ajax({
                    items:20,
                    url: "products.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }
        });
    });
    function sell(){
        $.ajax({
            type: 'POST',
            url: 'payment.php',
            success: function(data) {
                $('#payment').html(data);
            }
        });
        return false;
    }
    function money(currency, value){
        var  currency = currency;
        var  value = value;
        $.ajax({
            type: 'POST',
            url: 'monies.php',
            data: $('#akunda').serialize(),
            success: function(data) {
                $('#bag').html(data);
            }
        });
        return false;
    }
    function save(){
        $.ajax({
            type: 'POST',
            url: 'save.php',
            data: $('#akunda').serialize(),
            success:function(response){
                $('#res').html(response);
            }
        });
        return false;
    }
    $(document).on('click', 'a[data-role=delete]', function(){
        var id = $(this).data('id');
        $.ajax({
            url: 'delete.php',
            method: 'post',
            data: { id : id},
            success:function(response){
                $('#success').html(response);
            }
        });
    });
    </script>
</body>
</html>
