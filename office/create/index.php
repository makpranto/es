<?php
include '../heart/a.php';
secure('add_new_stock');
if (isset($_SERVER["CONTENT_LENGTH"])) {
    if ($_SERVER["CONTENT_LENGTH"] > ((int)ini_get('post_max_size') * 1024 * 1024)) {
        $_SESSION['JIsY77*0neY7Y77*07*fkgnjOInfgjUd8njdfjsdkdsjf*00(*7)'] = "<a href='$project_root_folder"."/create/' class='btn btn-success waves-effect waves-light'><i class='fa fa-arrow-left mr-2'></i> Go Back</a>";
        header("location: ../error");
        exit;
    }
}
$product_name = '';
$main_cat = '';
$description = '';
$brand = '';
$uom = '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Create  A New Product"; ?> </title>
    <?php style(); ?>
    <?php scripts(); ?>
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
                        if (isset($_POST['upload'])) {
                            if (!empty($_FILES['file'])) {
                                if($_FILES['file']["size"] > 0){
                                    if ($_FILES["file"]["size"] > MB) {
                                        error("The image should be less than or equal to 1MB. Compress it first then try again.");
                                    }else {
                                        if (!there('product_name') || !there('main_cat') || !there('sub_cat') || !there('description') || !there('brand') || !there('uom')) {
                                            error("Bad practice has been detected.");
                                        }else {
                                            $s = 0;
                                            $product_name = mb_strtoupper(clean($_POST['product_name']));
                                            $brand = mb_strtoupper(clean($_POST['brand']));
                                            $uom = clean(hide('d', $_POST['uom']));
                                            $description = cleaned($_POST['description']);
                                            $main_cat = ucwords(mb_strtolower(clean(hide('d', $_POST['main_cat']))));
                                            $sub_cat = ucwords(mb_strtolower(clean(hide('d', $_POST['sub_cat']))));
                                            $filename = $_FILES['file']['name'];
                                            $ext = mb_strtolower(clean(pathinfo($filename, PATHINFO_EXTENSION)));
                                            $extensions = ['png', 'jpg', 'jpeg'];
                                            if (!in_array($ext, $extensions)) {
                                                error("<b>$ext</b> files are not allowed.");
                                                $s = 20;
                                            }
                                            if ($main_cat == 'Null') {
                                                error('Please select the main category for this product.');
                                                $s= 20;
                                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `categories` WHERE `id` = '$main_cat'")) != 1) {
                                                error('Bad practice has been detected.');
                                                $s= 20;
                                            }
                                            if ($s == 0) {
                                                if (stand_alone($main_cat)) {
                                                    $sub_cat = '';
                                                }else {
                                                    if ($sub_cat == 'Null') {
                                                        error('Please select the sub-category for this product.');
                                                        $s = 20;
                                                    }elseif (mysqli_num_rows(r("SELECT `id` FROM `sub_categories` WHERE `id` = '$sub_cat' AND `main_cat` = '$main_cat'")) != 1) {
                                                        error('Bad practice has been detected.');
                                                        $s= 20;
                                                    }
                                                }
                                            }
                                            if (!empty($brand)) {
                                                if (mysqli_num_rows(r("SELECT `id` FROM `brands` WHERE `name` = '$brand'")) != 1) {
                                                    error('The brand you submitted was not found.');
                                                    $s= 20;
                                                }
                                            }
                                            if ($uom == 'Null') {
                                                error('What is the unit of measurement?');
                                                $s= 20;
                                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `uom` WHERE `id` = '$uom'")) != 1) {
                                                error('Bad practice has been detected.');
                                                $s= 20;
                                            }
                                            if (empty($product_name)) {
                                                error("Submit the product\'s name.");
                                                $s = 20;
                                            }elseif (strlen($product_name) < 3) {
                                                error("The product\'s name has to be greater than 3 characters in length.");
                                                $s = 20;
                                            }elseif (!pname($product_name)){
                                                error("The product\'s name can only have letters, spaces, &, % and numbers.");
                                                $s = 20;
                                            }elseif (strlen($product_name) > $c_name_length) {
                                                error("The product\'s name has to be less than $c_name_length characters in length.");
                                                $s = 20;
                                            }elseif (mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `product_name` = '$product_name'")) != 0) {
                                                $name = ucwords(mb_strtolower($product_name));
                                                error("$name is already there.");
                                                $s = 20;
                                            }

                                            if (empty($description)) {
                                                error('Product description is mandotory.');
                                                $s = 200;
                                            }elseif (strlen($_POST['description']) < 20) {
                                                error('Description length should not be below 20 characters.');
                                                $s = 200;
                                            }elseif (strlen($_POST['description']) > 200) {
                                                error('Description length should not be greater than 200 characters.');
                                                $s = 200;
                                            }
                                            if ($s == 0) {
                                                $path = "../../shop/i/p/";
                                                $paths = "../../shop/i/p/";
                                                $rand = ('OIDFJ67SYITVJSDBVZXCJI6367WE685QWJGKDSDVCXTWQ6276S979215213546829jddshfjkhjBgdfg830GNZcVMXCXLSA7R87SDFBJ83Y9DSHKWVEASI48DSAF1356687DS987SD7FDF5SKMFGKE632SPIYEUYWQTRYA1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                                                $rename = substr(str_shuffle($rand), 0, (2)). date("Y").substr(str_shuffle($rand), 0, (2)). date("m").substr(str_shuffle($rand), 0, (2)). date("d").substr(str_shuffle($rand), 0, (2)). date("h").substr(str_shuffle($rand), 0, (2)). date("i").substr(str_shuffle($rand), 0, (2)). date("s").".$ext";
                                                $path = $path .$rename;
                                                if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                                                    $code = time();
                                                    $name = ucwords(mb_strtolower($product_name));
                                                    $n = date('Y-m-d H:i:s');
                                                    $brand = pull('id', 'brands', "`name` = '$brand'");
                                                    $product_name = space($product_name);
                                                    $description = space($description);
                                                    $df = "INSERT INTO `zvinhu`(`uom`,`product_name`, `product_code`, `description`, `user_id`,`image`, `main_cat`, `sub_cat`, `date_added`, `brand`) VALUES ('$uom','$product_name', '$code', '$description', '$user_id', '$rename', '$main_cat','$sub_cat', '$n', '$brand')";
                                                    if (r($df)) {
                                                        success("$name has been added successfully.");
                                                    }else {
                                                        error("Something went wrong.");
                                                        unlink($path);
                                                    }
                                                }else {
                                                    error("The was an eror whilst uploading the image.");
                                                }
                                            }
                                            $product_name = mb_strtoupper($_POST['product_name']);
                                            $brand = word($_POST['brand']);
                                            $main_cat = ucwords(mb_strtolower(hide('d', $_POST['main_cat'])));
                                        }
                                    }
                                }else {
                                    error("Submit the image for the product.");
                                }
                            }else {
                                error("Bad practice has been detected");
                            }
                        }
                        ?>
                        <div class="col-sm-3 b-r"><h3 class="m-t-none m-b">Submit Product Details</h3>
                            <div class="ibox" id="ibox1">
                                <div class="ibox-content">
                                    <div class="sk-spinner sk-spinner-wave">
                                        <div class="sk-rect1"></div>
                                        <div class="sk-rect2"></div>
                                        <div class="sk-rect3"></div>
                                        <div class="sk-rect4"></div>
                                        <div class="sk-rect5"></div>
                                    </div>
                                    <form role="form" method="post" enctype="multipart/form-data" id="new_product_form">
                                        <div class="form-group">
                                            <select name="main_cat" class="form-control" onchange="return sub_cat_();">
                                                <option value="<?php echo hide('e', 'null'); ?>">Select main category</option>
                                                <?php
                                                main_cat_dd($main_cat);
                                                ?>
                                            </select>
                                        </div>
                                        <div id="sub_cat">
                                            <div class="form-group">
                                                <select name="sub_cat" class="form-control">
                                                    <option value="<?php echo hide('e', 'null'); ?>">Select sub-category</option>
                                                    <?php
                                                    if (mysqli_num_rows(r("SELECT `id` FROM `categories` WHERE `id` = '$main_cat'"))>0) {
                                                        $as = r("SELECT `name`, `id` FROM `sub_categories` WHERE `main_cat` = '$main_cat'");
                                                        while ($a = get($as)) {
                                                            if ($sub_cat == $a['id']) {
                                                                echo "<option value='". hide('e', $a['id'])."' selected>". $a['name']. '</option>';
                                                            }else {
                                                                echo "<option value='". hide('e', $a['id'])."'>". $a['name']. '</option>';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="brand" placeholder="Brand" class="form-control apise-brand" autocomplete="off" value="<?php echo $brand ?>">
                                        </div>
                                        <div class="form-group">
                                            <select name="uom" class="form-control">
                                                <option value="<?php echo hide('e', 'null'); ?>">Unit of Measurement</option>
                                                <?php
                                                echo "$uom sdfdsjkf";
                                                $as = r("SELECT `name`, `id` FROM `uom`");
                                                while ($a = get($as)) {
                                                    if ($uom == $a['id']) {
                                                        echo "<option value='". hide('e', $a['id'])."' selected>". $a['name']. '</option>';
                                                    }else {
                                                        echo "<option value='". hide('e', $a['id'])."'>". $a['name']. '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" class="form-control" name="file" required accept=".jpg, .png, .jpeg"/>
                                        </div>
                                        <div class="form-group"><input type="text" required placeholder="Product Name" value="<?php echo  $product_name; ?>" autocomplete="off" name="product_name" class="form-control" /></div>
                                        <div class="form-group"><textarea  placeholder="Description" name='description' required class="form-control"><?php echo  $description; ?></textarea></div>
                                        <div class="form-group col-md-6"><button class="btn btn-sm btn-primary m-t-n-xs" name='upload' type="submit"><strong>Add to Stocklist</strong></button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                        $as = r("SELECT * FROM `zvinhu` WHERE `user_id` = '$user_id' ORDER BY `id` DESC LIMIT 1");
                        $a = get($as);
                        if (mysqli_num_rows($as)>0): $pro_id = hide('e', $a['id']);?>
                        <div class="col-sm-2">
                            <div class="ibox">
                                <p>Preview</p>
                                <div class="ibox-content product-box">
                                    <div class="product-imitation" style="background-image: url('<?php echo $main.'i/p/'. $a['image']; ?>');height:120px !important; background-size: contain;background-repeat: no-repeat;background-position:center !important;"></div>
                                    <div class="product-desc">
                                        <d class="product-price">
                                            $<?php echo mari($a['selling_price']); ?>
                                        </d>
                                        <b><?php echo word($a['product_name']); ?></b>
                                        <hr>
                                        <p><?php echo ($a['description']); ?> </p>
                                        <div class="m-t text-right">
                                            <a target="_blank" href="<?php echo "../stocklist/?edit=". hide('e', $a['id']); ?>" class="btn btn-xs btn-outline btn-primary">Edit product <i class="fa fa-edit"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7" style="overflow-y: scroll; height:500px;">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <div class="m-t">
                                        <button class="btn btn-xs btn-outline btn-primary" data-toggle="modal" data-target="#add_attribute">Add new attribute <i class="fa fa-plus"></i> </a>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="modal inmodal" id="add_attribute" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="ibox" id="boxering">
                                                                <div class="ibox-content">
                                                                    <div class="sk-spinner sk-spinner-wave">
                                                                        <div class="sk-rect1"></div>
                                                                        <div class="sk-rect2"></div>
                                                                        <div class="sk-rect3"></div>
                                                                        <div class="sk-rect4"></div>
                                                                        <div class="sk-rect5"></div>
                                                                    </div>
                                                                    <form role="form" id="nijh" method="post" onsubmit="return add_att('<?php echo $pro_id; ?>');">
                                                                        <div class="form-group">
                                                                            <input type="text" name="att_name" id="att_name" class="form-control" placeholder="Attribute name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <textarea type="text" name="attribute" id="attribute" class="form-control" placeholder="Description"></textarea>
                                                                        </div>
                                                                        <span class="ladda-button ladda-button-demo btn btn-primary" onclick="return add_att('<?php echo $pro_id; ?>');"  data-style="expand-right">Submit</span>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p id="edit"></p>
                                        <div class="ibox-content product-box table-responsive">
                                            <tell id='success'>
                                                <?php include 'atb.php'; ?>
                                            </tell>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php foot(); ?>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script>
    function sub_cat_(){
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            url: 'sub_cat.php',
            method: 'post',
            data: $('#new_product_form').serialize(),
            success:function(response){
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                $('#sub_cat').html(response);
            }
        });
    };
    function edit(s){
        $.ajax({
            url: 'edit.att.php',
            method: 'post',
            data: {s:s},
            success:function(response){
                $('#edit').html(response);
            }
        });
    }
    function del(s){
        $.ajax({
            url: 'del.att.php',
            method: 'post',
            data: {s:s},
            success:function(response){
                $('#success').html(response);
            }
        });
    }
    function add_att(s){
        $('#boxering').children('.ibox-content').toggleClass('sk-loading');
        var att_name = document.getElementById('att_name').value;
        var attribute = document.getElementById('attribute').value;
        $.ajax({
            url: 'add.att.php',
            method: 'post',
            data:{s:s, att_name:att_name, attribute:attribute},
            success:function(response){
                $('#boxering').children('.ibox-content').toggleClass('sk-loading');
                $('#success').html(response);
            }
        });
    };
    $('.apise-brand').typeahead({
        source: function(query, result) {
            $.ajax({
                items: 20,
                url: "brand.php",
                data: 'query=' + query,
                dataType: "json",
                autoSelect: false,
                type: "POST",
                success: function(data) {
                    result($.map(data, function(item) {
                        return item;
                    }));
                },
            });
        }
    });
</script>
</body>
</html>
