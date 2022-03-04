<?php
include '../heart/a.php';
secure('receive');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Receive New Stock"; ?> </title>
    <?php style();?>
</head>
<body>
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-4 b-r">
                            <form role="form" id="frmBox"  method="post">
                                <div class="form-group"><input type="text" autocomplete='off' placeholder="Product Quantity" name='product_quantity' class="form-control"></div>
                                <div class="form-group"><input type="text" autocomplete='off' placeholder="Product Name"  id="txtCountry" name="product_name" class="typeahead_2 form-control" /></div>
                                <div class="form-group"><input type="text" autocomplete='off' placeholder="Unit Buying Price"   name="unit_price" class=" form-control" /></div>
                                <div class="form-group"><input type="text" autocomplete='off' placeholder="Unit Selling Price"   name="selling_price" class=" form-control" /></div>
                                <div class="form-group col-sm-6"><button class="btn btn-sm btn-primary m-t-n-xs" onclick="return teal();" type="submit"><strong>Add to Basket</strong></button></div>
                                <div class="form-group col-sm-6"><button class="btn btn-sm btn-primary m-t-n-xs" onclick="return save();" type='sumbit'><strong>Add to Current Stock</strong></button></div>
                            </form>
                        </div>
                        <span id="success">
                            <?php if (!isset($dream)  || mysqli_num_rows($db->query("SELECT `id` FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'new'")) >1): ?>
                                <?php include 'UdfghvscfJpoury.php' ?>
                            <?php endif; ?>
                        </span>
                    </div>
                    <div class="col-md-12" id="save"></div>
                </div>
            </div>
            <?php foot(); ?>
        </div>
    </div>
    <?php scripts(); ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="KirUo09.js"></script>
</body>
</html>
