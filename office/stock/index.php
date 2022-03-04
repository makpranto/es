<?php
include '../heart/a.php';
secure('stock');
if (isset($_GET['finish']) || mysqli_num_rows(r("SELECT `id` FROM `zvinhu`")) == mysqli_num_rows(r("SELECT `id` FROM `stock_taking` WHERE `status` = 'in_cart'"))) {
    include 'finish.php';
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Stock Take"; ?> </title>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <?php style(); ?>
    <?php scripts(); ?>
</head>
<body class="mini-navbar">
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox" id="ibox1">
                                    <div class="ibox-content">
                                        <div class="sk-spinner sk-spinner-wave">
                                            <div class="sk-rect1"></div>
                                            <div class="sk-rect2"></div>
                                            <div class="sk-rect3"></div>
                                            <div class="sk-rect4"></div>
                                            <div class="sk-rect5"></div>
                                        </div>
                                        <center>
                                            <h1 id="magic">
                                                <?php
                                                $f = r("SELECT COUNT(`id`) AS `fg`, `stock_id` FROM `stock_taking` WHERE `status` = 'in_cart'");
                                                $a = get($f);
                                                if ($a['fg']>0) {
                                                    $id = hide('e', $a['stock_id']);
                                                    echo $a['fg'] .' out of '.  mysqli_num_rows(r("SELECT `id` FROM `zvinhu`")). ' products.';
                                                    echo "<button type='button' class='btn btn-danger pull-right' onclick='return reset(\"$id\");'>Reset</button>";
                                                }
                                                ?>
                                            </h1>
                                            <p id='life'></p>

                                        </center><hr>
                                        <div class="table-responsive" id="oil">
                                            <?php include 'cart.php'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php foot(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
    <script>
    function m(){
        $.ajax({
            type: 'POST',
            url: 'm.php',
            success: function(response) {
                $('#magic').html(response);
            }
        });
    }
    function reset(file){
        $.ajax({
            type: 'POST',
            url: 'reset.php',
            data: {
                file: file
            },
            success: function(response) {
                if (response == 't') {
                    window.location.href='./';
                }else {
                    $('#life').html(response);
                }
            }
        });
    }
    function add_to_stock_take(product, quantity,) {
        m();
        var quant = document.getElementById(quantity).value;
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            type: 'POST',
            url: 'stock.php',
            data: {
                product: product,
                quantity: quantity,
                quant: quant
            },
            success: function(response) {
                m();
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                $('#oil').html(response);
            }
        });
    }
    </script>
</body>
</html>
