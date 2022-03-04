<?php
include '../heart/a.php';
secure('start_order');
if (isset($_SERVER["CONTENT_LENGTH"])) {
    if ($_SERVER["CONTENT_LENGTH"] > ((int)ini_get('post_max_size') * 1024 * 1024)) {
        $_SESSION['JIsY77*0neY7Y77*07*fkgnjOInfgjUd8njdfjsdkdsjf*00(*7)'] = "<a href='$project_root_folder"."/order/' class='btn btn-success waves-effect waves-light'><i class='fa fa-arrow-left mr-2'></i> Go Back</a>";
        header("location: ../error");
        exit;
    }
}

$mhosva = [];
if (isset($_POST['upload'])) {
    $extensions = ['png', 'jpg', 'jpeg', 'pdf'];
    $ese = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'pricing' AND `status` = 'in_cart'");
    if (mysqli_num_rows($ese) == 0) {
        $mhosva[] = ("Add items to the cart.");
    }elseif (!there('client_name') || !there('phone') || !there('email_address') || !there('markup') || !there('supp_one') || !there('supp_two') || !there('supp_three')) {
        $mhosva[] = ("Bad practice has been detected");
    }else {
        $client_name = mb_strtoupper(clean($_POST['client_name']));
        $supp_one = mb_strtoupper(clean($_POST['supp_one']));
        $supp_two = mb_strtoupper(clean($_POST['supp_two']));
        $supp_three = mb_strtoupper(clean($_POST['supp_three']));
        $phone = clean(str_replace(' ', '', $_POST['phone']));
        $email_address = mb_strtolower(clean($_POST['email_address']));
        $markup = (clean($_POST['markup']));
        $price_check_id = generate_coupon(4).generate_coupon(4);
        if (mysqli_num_rows(r("SELECT `id` FROM `walk_in_clients` WHERE `full_name` = '$client_name'")) > 0) {
            if (empty($markup)) {
                $mhosva[] = ("What is the markup percentage?");
            }elseif (!figure($markup)) {
                $mhosva[] = ("Submit a valid markup percentage.");
            }elseif ($markup > $max_markup || $markup < $min_markup) {
                $mhosva[] = ("The markup has to be bewtween $min_markup% and $max_markup%");
            }else {
                $files = [];
                $c = 0;
                if (!empty($_FILES['quote_one'])) {
                    if ($_FILES['quote_one']['size'] > 0) {
                        $quote_one = $_FILES['quote_one']["name"];
                        $ext = mb_strtolower(clean(pathinfo($quote_one, PATHINFO_EXTENSION)));
                        if (!in_array($ext, $extensions)) {
                            $mhosva[] = ("You cannot upload .$ext files.");
                        }else {
                            $files[] = 'quote_one';
                            if (empty($supp_one)) {
                                $mhosva[] = ("Submit the name of the first suppier.");
                                $kids = 20;
                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `suppliers` WHERE `name` = '$supp_one'")) != 1) {
                                $mhosva[] = ("$supp_one has not been found.");
                                $kids = 20;
                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `suppliers` WHERE `name` = '$supp_one' AND `status` != 'ACTIVE'")) == 1) {
                                $mhosva[] = ("$supp_one is not active.");
                                $kids = 20;
                            }
                            $c++;
                        }
                    }
                }
                if (!empty($_FILES['quote_two'])) {
                    if ($_FILES['quote_two']['size'] > 0) {
                        $quote_two = $_FILES['quote_two']["name"];
                        $ext = mb_strtolower(clean(pathinfo($quote_two, PATHINFO_EXTENSION)));
                        if (!in_array($ext, $extensions)) {
                            $mhosva[] = ("You cannot upload .$ext files.");
                        }else {
                            $files[] = 'quote_two';
                            if (empty($supp_two)) {
                                $mhosva[] = ("Submit the name of the second suppier.");
                                $kids = 20;
                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `suppliers` WHERE `name` = '$supp_two'")) != 1) {
                                $mhosva[] = ("$supp_two has not been found.");
                                $kids = 20;
                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `suppliers` WHERE `name` = '$supp_two' AND `status` != 'ACTIVE'")) == 1) {
                                $mhosva[] = ("$supp_two is not active.");
                                $kids = 20;
                            }
                            $c++;
                        }
                    }
                }
                if (!empty($_FILES['quote_three'])) {
                    if ($_FILES['quote_three']['size'] > 0) {
                        $quote_three = $_FILES['quote_three']["name"];
                        $ext = mb_strtolower(clean(pathinfo($quote_three, PATHINFO_EXTENSION)));
                        if (!in_array($ext, $extensions)) {
                            $mhosva[] = ("You cannot upload .$ext files.");
                        }else {
                            $files[] = 'quote_three';
                            if (empty($supp_three)) {
                                $mhosva[] = ("Submit the third of the first suppier.");
                                $kids = 20;
                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `suppliers` WHERE `name` = '$supp_three'")) != 1) {
                                $mhosva[] = ("$supp_three has not been found.");
                                $kids = 20;
                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `suppliers` WHERE `name` = '$supp_three' AND `status` != 'ACTIVE'")) == 1) {
                                $mhosva[] = ("$supp_three is not active.");
                                $kids = 20;
                            }
                            $c++;
                        }
                    }
                }
                if ($c < 2) {
                    $mhosva[] = ("You need to upload at least 2 quotes. You uploaded $c.");
                }elseif (isset($kids)) {
                }elseif ($supp_one == $supp_two || $supp_one == $supp_three || $supp_three == $supp_two && (!empty($supp_one) && !empty($supp_two))) {
                    $mhosva[] = ("The quotes have to be from different suppliers.");
                }else {
                    $markup = amount($markup/100);
                    $customer_id = pull('id', 'walk_in_clients', "`full_name` = '$client_name'");;
                    while ($a = get($ese)) {
                        $sid = $a['id'];
                        $selling_price = amount(($a['buying_price']*$markup)+$a['buying_price']);
                        $line = "UPDATE `basket` SET `selling_price` = '$selling_price', `status` = 'pending_int_approval', `price_check_id` = '$price_check_id', `markup` = '$markup', `customer_id` = '$customer_id' WHERE `id` = '$sid'";
                        r($line);
                    }
                    $sa = 0;
                    $supp_one = pull('id', 'suppliers', "`name` = '$supp_one'");
                    $supp_two = pull('id', 'suppliers', "`name` = '$supp_two'");
                    $supp_three = pull('id', 'suppliers', "`name` = '$supp_three'");
                    foreach ($files as $file) {
                        $path = "../files/";
                        $rand = ('Q6276S979215213546829jddshfjkhjBgdDSAF1356687DS987SD7FDF5SKMOIDFJ67SYITVJSDBVZXCJI6367WE685QWJGKDSDVfg830GNZcVMXCXLSA7R87SDFBJ83Y9DSHKWVEASI48CXTWFGKE632SPIYEUYWQTRYA1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                        $ext = mb_strtolower(clean(pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION)));
                        $rename = substr(str_shuffle($rand), 0, (2)). date("Y").substr(str_shuffle($rand), 0, (2)). date("m").substr(str_shuffle($rand), 0, (2)). date("d").substr(str_shuffle($rand), 0, (2)). date("h").substr(str_shuffle($rand), 0, (2)). date("i").substr(str_shuffle($rand), 0, (2)). date("s").".$ext";
                        $path = mb_strtolower($path.$rename);
                        if(move_uploaded_file($_FILES[$file]['tmp_name'], $path)) {
                            $sa++;
                            if ($sa == 1 ) {
                                r("INSERT INTO `price_quotes`(`quote_one`, `quote_id`, `supp_one`) VALUES ('$rename', '$price_check_id', '$supp_one')");
                            }elseif ($sa == 2) {
                                r("UPDATE `price_quotes` SET `quote_two` = '$rename', `supp_two` = '$supp_two' WHERE `quote_id` = '$price_check_id'");
                            }else {
                                r("UPDATE `price_quotes` SET `quote_three` = '$rename', `supp_three` = '$supp_three' WHERE `quote_id` = '$price_check_id'");
                            }
                        }else {
                            $mhosva[] = ("The was an eror whilst uploading the file(s).");
                        }
                    }
                    if ($sa == $c) {
                        $strength = ("Request has been submitted successfully.");
                    }
                }
            }
        }elseif (strlen($client_name) < 3) {
            $mhosva[] = ('Please submit a valid customer\'s name.');
        }elseif (empty($phone)) {
            $mhosva[] = ("Phone number is required.");
        }elseif (!preg_match("/^[\+]?[0-9]{5,13}$/", $phone)) {
            $mhosva[] = ('Please submit a valid phone number.');
        }elseif (!empty($email_address) && !valid_email($email_address)) {
            $mhosva[] = ('Please submit a valid email address.');
        }else {
            $now = date('Y-m-d H:i:s');
            r("INSERT INTO `walk_in_clients` (`full_name`, `email`, `phone`, `added_by`, `added_on`, `kind`, `status`) VALUES ('$client_name', '$email_address', '$phone', '$user_id', '$now', 'price_check', 'ACTIVE')");
            if (empty($markup)) {
                $mhosva[] = ("What is the markup percentage?");
            }elseif (!figure($markup)) {
                $mhosva[] = ("Submit a valid markup percentage.");
            }elseif ($markup > $max_markup || $markup < $min_markup) {
                $mhosva[] = ("The markup has to be bewtween $min_markup% and $max_markup%");
            }else {
                $files = [];
                $c = 0;
                if (!empty($_FILES['quote_one'])) {
                    if ($_FILES['quote_one']['size'] > 0) {
                        $quote_one = $_FILES['quote_one']["name"];
                        $ext = mb_strtolower(clean(pathinfo($quote_one, PATHINFO_EXTENSION)));
                        if (!in_array($ext, $extensions)) {
                            $mhosva[] = ("You cannot upload .$ext files.");
                        }else {
                            $files[] = 'quote_one';
                            $c++;
                        }
                    }
                }
                if (!empty($_FILES['quote_two'])) {
                    if ($_FILES['quote_two']['size'] > 0) {
                        $quote_two = $_FILES['quote_two']["name"];
                        $ext = mb_strtolower(clean(pathinfo($quote_two, PATHINFO_EXTENSION)));
                        if (!in_array($ext, $extensions)) {
                            $mhosva[] = ("You cannot upload .$ext files.");
                        }else {
                            $files[] = 'quote_two';
                            $c++;
                        }
                    }
                }
                if (!empty($_FILES['quote_three'])) {
                    if ($_FILES['quote_three']['size'] > 0) {
                        $quote_three = $_FILES['quote_three']["name"];
                        $ext = mb_strtolower(clean(pathinfo($quote_three, PATHINFO_EXTENSION)));
                        if (!in_array($ext, $extensions)) {
                            $mhosva[] = ("You cannot upload .$ext files.");
                        }else {
                            $files[] = 'quote_three';
                            $c++;
                        }
                    }
                }
                if ($c < 2) {
                    $mhosva[] = ("You need to upload at least 2 quotes. You uploaded $c.");
                }else {
                    $markup = amount($markup/100);
                    $customer_id = pull('id', 'walk_in_clients', "`full_name` = '$client_name'");;
                    while ($a = get($ese)) {
                        $sid = $a['id'];
                        $selling_price = amount(($a['buying_price']*$markup)+$a['buying_price']);
                        $line = "UPDATE `basket` SET `selling_price` = '$selling_price', `status` = 'pending_int_approval', `price_check_id` = '$price_check_id', `markup` = '$markup', `customer_id` = '$customer_id' WHERE `id` = '$sid'";
                        r($line);
                    }
                    $sa = 0;
                    $supp_one = pull('id', 'suppliers', "`name` = '$supp_one'");
                    $supp_two = pull('id', 'suppliers', "`name` = '$supp_two'");
                    $supp_three = pull('id', 'suppliers', "`name` = '$supp_three'");
                    foreach ($files as $file) {
                        $path = "../files/";
                        $rand = ('Q6276S979215213546829jddshfjkhjBgdDSAF1356687DS987SD7FDF5SKMOIDFJ67SYITVJSDBVZXCJI6367WE685QWJGKDSDVfg830GNZcVMXCXLSA7R87SDFBJ83Y9DSHKWVEASI48CXTWFGKE632SPIYEUYWQTRYA1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                        $ext = mb_strtolower(clean(pathinfo($_FILES[$file]["name"], PATHINFO_EXTENSION)));
                        $rename = substr(str_shuffle($rand), 0, (2)). date("Y").substr(str_shuffle($rand), 0, (2)). date("m").substr(str_shuffle($rand), 0, (2)). date("d").substr(str_shuffle($rand), 0, (2)). date("h").substr(str_shuffle($rand), 0, (2)). date("i").substr(str_shuffle($rand), 0, (2)). date("s").".$ext";
                        $path = mb_strtolower($path.$rename);
                        if(move_uploaded_file($_FILES[$file]['tmp_name'], $path)) {
                            $sa++;
                            if ($sa == 1 ) {
                                r("INSERT INTO `price_quotes`(`quote_one`, `quote_id`, `supp_one`) VALUES ('$rename', '$price_check_id', '$supp_one')");
                            }elseif ($sa == 2) {
                                r("UPDATE `price_quotes` SET `quote_two` = '$rename', `supp_two` = '$supp_two' WHERE `quote_id` = '$price_check_id'");
                            }else {
                                r("UPDATE `price_quotes` SET `quote_three` = '$rename', `supp_three` = '$supp_three' WHERE `quote_id` = '$price_check_id'");
                            }
                        }else {
                            $mhosva[] = ("The was an eror whilst uploading the file(s).");
                        }
                    }
                    if ($sa == $c) {
                        $strength = ("Request has been submitted successfully.");
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Create Order"; ?> </title>
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
                        <form role="form" id="frmBox" method="post">
                            <div class="col-sm-4 b-r">
                                <div class="form-group"><label>Product Quantity</label> <input type="text" autocomplete='off' value='1'  placeholder="Product Quantity" name='product_quantity' class="form-control"></div>
                                <div class="form-group"><label>Product Name</label> <input type="text" placeholder="Product Name" id="txtCountry" name="product_name" autocomplete='off' class="typeahead_2 form-control" /></div>
                                <div class="form-group"><label>Buying Price</label> <input type="text" placeholder="Buying Price" name="buying_price" autocomplete='off' class="form-control" /></div>
                                <div class="form-group">
                                    <button class="btn btn-sm btn-primary m-t-n-xs" onclick="return teal();"><strong>Add to Basket</strong></button>
                                    <button class="btn btn-sm btn-primary m-t-n-xs" onclick="return sell();"><strong>Next</strong></button>
                                </div>
                            </div>
                            <div id='payment'></div>
                            <tell id="success">
                                <?php include 'basket.php' ?>
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
    <?php
    foreach ($mhosva as $m) {
        error($m);
    }
    if (isset($strength)) {
        success($strength);
    }
    ?>
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
