<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'orders');
if (!there('id') || !there('reason')) {
    error("Bad practice detected.");
}else {
    $id = clean(hide('d', $_POST['id']));
    $reason = clean($_POST['reason']);
    $order_id = $id;
    $df = r("SELECT `id`, `user_id`, `mop` FROM `basket` WHERE `uid` = '$id' AND  `status` = 'Order Received'");
    if (mysqli_num_rows($df) < 1) {
    }else {
        if (empty($reason)) {
            error("Please submit a reason for decline.");
        }else {
            $s = hide('e', $id);
            $ids = [];
            $now = date('Y-m-d H:i:s');
            while ($s = get($df)) {
                $ids[] = $s['id'];
                $customer = $s['user_id'];
                $payment_method = $s['mop'];
            }
            foreach ($ids as $key) {
                r("UPDATE `basket` SET `status` = 'Order Rejected', `checked_by` = '$user_id', `checked_at` = '$now', `reason` = '$reason' WHERE `id` = '$key'");
            }

            $a = get(r("SELECT * FROM `customers` WHERE `id` = '$customer'"));
            $phone = hide('d', $a['phone']);
            $buyer_name = hide('d', $a['name']).' '. hide('d',$a['surname']);
            $buyer_email = hide('d', $a['email_address']);
            $town = hide('d', $a['town']);
            $street_address = hide('d', $a['street_address']);
            $r = trim(htmlentities($_POST['reason']));
            include '../../bin/reject.php';
        }
    }
}
?>


<div class="table-responsive">
    <?php include 'tab_le.php'; ?>
</div>
<?php include '../heart/scripts.php'; ?>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
<script>
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
