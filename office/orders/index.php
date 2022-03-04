<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'orders');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | $company_name Orders"; ?> </title>
    <?php include '../heart/styles.php'; ?>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5><?php echo "All $company_name's Orders"; ?></h5>
                                </div>
                            </div>
                            <div class="ibox float-e-margins">
                                <div class="ibox" id="ibox1">
                                    <div class="ibox-content">
                                        <div class="sk-spinner sk-spinner-wave">
                                            <div class="sk-rect1"></div>
                                            <div class="sk-rect2"></div>
                                            <div class="sk-rect3"></div>
                                            <div class="sk-rect4"></div>
                                            <div class="sk-rect5"></div>
                                        </div>
                                        <tell id="oil">
                                            <div class="table-responsive">
                                                <?php include 'tab_le.php'; ?>
                                            </div>
                                        </tell>
                                        <tell id='order'>
                                            <div class="modal fade" id='myModal' role="dialog">

                                            </div>
                                        </tell>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../heart/footer.php'; ?>
    </div>
    <?php include '../heart/scripts.php'; ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
    <script>
    function decline(test, value){
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            url: 'decline.php',
            method: 'post',
            data: { id : test, reason:value},
            success:function(response){
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                $('#oil').html(response);
            }
        });
    };
    function accept(id){
        $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            url: 'accept.php',
            method: 'post',
            data: { id : id},
            success:function(response){
                $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
                $('#oil').html(response);
            }
        });
    };
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
    $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv', title: '<?php echo "$company_name All Orders"; ?>'},
            {extend: 'excel', title: '<?php echo "$company_name All Orders"; ?>'},
            {extend: 'pdf', title: '<?php echo "$company_name All Orders"; ?>'},
            {extend: 'print',
            customize: function (win){
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');
                $(win.document.body).find('table')
                .addClass('compact')
                .css('font-size', 'inherit');
            }
        }
    ]
});
</script>

</body>
</html>
