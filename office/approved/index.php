<?php
include '../heart/a.php';
secure('start_order');
if (isset($_SESSION['file'])) {
    $file = $_SESSION['file'];
    unset($_SESSION['file']);
    echo "<script>window.setTimeout(function(){

        window.location.href = '$file';

    }, 1000);</script>";
}
if (isset($_SESSION['enfield_customer_session_name'])) {
    unset($_SESSION['enfield_customer_session_name']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Aprroved Orders"; ?> </title>
    <?php include '../heart/styles.php'; ?>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<body class="mini-navbar">
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
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
                                            <div class="modal fade" id='myModal' role="dialog"></div>
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
    <?php scripts(); ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
    <script>
    function decline( value){
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
    function send_quote(){
        $('#ibox2').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            url: 'accept.php',
            method: 'post',
            data: $('#send_q').serialize(),
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
            {extend: 'csv', title: '<?php echo "$company_name Approved Quoations at ". date('d F Y'); ?>'},
            {extend: 'excel', title: '<?php echo "$company_name Approved Quoations at ". date('d F Y'); ?>'},
            {extend: 'pdf', title: '<?php echo "$company_name Approved Quoations at ". date('d F Y'); ?>'},
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
