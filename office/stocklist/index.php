<?php
include '../heart/a.php';
secure('stock');
if (isset($_SERVER["CONTENT_LENGTH"])) {
    if ($_SERVER["CONTENT_LENGTH"] > ((int)ini_get('post_max_size') * 1024 * 1024)) {
        $_SESSION['JIsY77*0neY7Y77*07*fkgnjOInfgjUd8njdfjsdkdsjf*00(*7)'] = "<a href='$project_root_folder"."/stocklist/' class='btn btn-success waves-effect waves-light'><i class='fa fa-arrow-left mr-2'></i> Go Back</a>";
        header("location: ../error/");
        echo "exit";
        exit;
    }
}
if (isset($_GET['edit'])) {
    $product_id = mb_strtoupper(clean(hide('d', $_GET['edit'])));
    $as = r("SELECT * FROM `zvinhu` WHERE `id` = '$product_id'");
    if (mysqli_num_rows($as) != 1) {
        $_SESSION['error'] = 'That product has not been found.';
        header('location: ./');
        exit;
    }else{
        include 'edit.php';
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | All $company_name's Stock"; ?> </title>
    <?php style(); ?>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="<?php echo "$project_root_folder"; ?>/css/dropify.css" rel="stylesheet">
</head>
<body class="mini-navbar">
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-title">
                    <h5><?php echo "All $company_name's Products"; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive" id="oil">
                                <?php include 'tab_le.php'; ?>
                            </div>
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
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv',  title: '<?php echo "$company_name Stock List on ". date('d F, Y') ; ?>'},
                {extend: 'excel', title: '<?php echo "$company_name Stock List on ". date('d F, Y') ; ?>'},
                {extend: 'pdf', title: '<?php echo "$company_name Stock List on ". date('d F, Y') ; ?>'},
                {extend: 'print',
                customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');
                    $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                }
            }
        ]
    });
});
</script>
</body>
</html>
