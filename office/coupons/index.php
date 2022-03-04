<?php
include '../heart/a.php';
secure('coupons');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Coupons</title>
    <?php style(); ?>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox" id="ibox1">
                    <div class="ibox-content">
                        <div class="sk-spinner sk-spinner-wave">
                            <div class="sk-rect1"></div>
                            <div class="sk-rect2"></div>
                            <div class="sk-rect3"></div>
                            <div class="sk-rect4"></div>
                            <div class="sk-rect5"></div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-4 b-r">
                                    <form role="form" method="post" id="makpranto">
                                        <div class="form-group"><input type="text" autocomplete='off' placeholder="Number of Coupons" name='coupons_quantity' class="form-control"></div>
                                        <div class="form-group"><input type="text" autocomplete='off' placeholder="Coupon's Value" name="value" class="form-control" /></div>
                                        <div class="form-group"><input type="text" autocomplete='off' placeholder="Minimum purchase"   name="minimum" class=" form-control" /></div>
                                        <div class="form-group">
                                            <input class="btn btn-sm btn-primary pull-right" onclick="return generate();" type="button" value="Generate">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive" id="hunter">
                            <?php include 'table__.php'; ?>
                        </div>
                    </div>
                </div>
                <?php foot(); ?>
            </div>
        </div>
        </div>
        <?php scripts(); ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
    <script>
    function generate() {
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            type: 'POST',
            url: 'coupon.php',
            data: $('#makpranto').serialize(),
            success: function(response) {
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                $('#hunter').html(response);
            }
        });
    }
    $(document).on('click', 'a[data-role=view_order]', function(){
        var id = $(this).data('id');
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');

        $.ajax({
            url: 'order.php',
            method: 'post',
            data: { id : id},
            success:function(response){
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                $('#myModal').html(response);
            }
        });

    });
    </script>
</body>
</html>
