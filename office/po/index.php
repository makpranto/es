<?php
include '../heart/a.php';
secure('start_purchase_order');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Start Purchase Order"; ?> </title>
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
                        <div class="col-sm-3 b-r"><h3 class="m-t-none m-b">Start Purchase Order</h3>
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
                                            <input type="text" name="order_number" placeholder="Enter Order Number" class="form-control order-numbers" autocomplete="off">
                                        </div>
                                        <div class="form-group col-md-12"><button class="btn btn-sm btn-primary m-t-n-xs pull-right" onclick="return pull_order();"><strong>Find Order</strong></button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9" style="overflow-y: scroll; height:500px;">
                            <div class="ibox">
                                <div class="ibox-content">
                                    <p id="edit"></p>
                                    <div class="ibox-content product-box table-responsive">
                                        <tell id='success'>
                                            <?php //include 'atb.php'; ?>
                                        </tell>
                                    </div>
                                </div>
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
    $('.order-numbers').typeahead({
        source: function(query, result) {
            $.ajax({
                items: 20,
                url: "orders.php",
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
