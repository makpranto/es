<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'quotation');
if (isset($_SESSION['quotation'])) {
    $file = $_SESSION['quotation'];
    header("location: $file");
    unset($_SESSION['quotation']);
}
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Quotations"; ?> </title>
    <?php include '../heart/styles.php'; ?>
</head>
<body>
    <div id="wrapper">
        <?php include '../heart/main_nav.php'; ?>
        <div class="wrapper wrapper-content">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-4 b-r">
                        <form role="form" id="frmBox" method="post" action="sell.php">
                            <div class="form-group"><label>Product Quantity</label> <input type="text"  placeholder="Product Quantity" name='product_quantity' class="form-control"></div>
                            <div class="form-group"><label>Product Name</label> <input type="text" placeholder="Product Name"  id="txtCountry" name="product_name" class="typeahead_2 form-control" /></div>
                            <div class="form-group">
                                <center>
                                    <button class="btn btn-sm btn-primary m-t-n-xs" onclick="return teal();" type="submit"><strong>Add to Basket</strong></button>
                                </center>
                            </div>
                            <?php include 'ksjhdksjhdyYTS.php' ?>
                        </div>
                        <tell id="dream"></tell>
                        <tell id="success">
                            <?php if (!isset($dream)  && mysqli_num_rows($db->query("SELECT `id` FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'sale'")) >0): ?>
                                <?php include 'Hikkjshjshdjsdb.php' ?>
                            <?php else: ?>
                                <?php include 'Hikkjshjshdjsdb.php' ?>
                            <?php endif; ?>
                        </tell>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include '../heart/footer.php'; ?>
    </div>
        </div>
        <?php include '../heart/scripts.php'; ?>
        <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
        <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
        <script type="text/javascript">
            function teal(){
                $.ajax({
        type: 'POST',
        url: 'quote.php',
        data: $('#frmBox').serialize(),
        success:function(response){
            $('#success').html(response);
        }
    });
    return false;
    }
    </script>
    <script type="text/javascript">
    function sformSubmit(){
        $.ajax({
        type: 'POST',
        url: 'shubter.php',
        <?php if (cleared($company_id, 'save_client_details')): ?>
            data: $('#sfrmBox').serialize(),
        <?php else: ?>
            data: $('#frmBox').serialize(),
        <?php endif; ?>
        success: function(data) {
    if (data == "success")
        window.location = "./";
    else
        $('#success').html(data);
    }
    });
    return false;
    }
    </script>
    <script>
        $(document).ready(function () {
            $('#txtCountry').typeahead({
                source: function (query, result) {
                    $.ajax({
                        items:20,
                        url: "../pos/products.php",
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
            $('.customer').typeahead({
                source: function (query, result) {
                    $.ajax({
                        items:20,
                        url: "clients.php",
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
    </script>

    <script>
    function invoice(){
        $.ajax({
        type: 'POST',
        url: 'sdoijnsvniUOYSADhiuewohasbduuiUTASRDjewuyuOSIHjgkegku.php',
        <?php if (access($user_id, 'quotation')): ?>
            data: $('#sfrmBox').serialize(),
        <?php endif; ?>
        success: function(data) {
    if (data == "success")
        window.location = "./";
    else
        $('#dream').html(data);
    }
    });
    return false;
    }
    </script>
</body>
</html>
