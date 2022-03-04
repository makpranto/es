<?php
include '../heart/a.php';
secure('start_order');
if (!there('id')) {
    error("Bad practice detected.");
}else {
    $id = clean(hide('d', $_POST['id']));
    $order_id = $id;
    $df = r("SELECT * FROM `basket` WHERE `price_check_id` = '$id' AND  `status` = 'pending_int_approval'");
    if (mysqli_num_rows($df) < 1) {
    }else {
        $ids = [];
        $now = now();
        while ($s = get($df)) {
            $ids[] = $s['id'];
        }
        $customer = $s['customer_id'];
        foreach ($ids as $key) {
            r("UPDATE `basket` SET `status` = 'quotation_approved', `checked_by` = '$user_id', `checked_at` = '$now' WHERE `id` = '$key'");
        }

        // $buyer_name = pull('name', 'walk_in_clients', "`id` = '$customer'");
        // $buyer_email = pull('email', 'walk_in_clients', "`id` = '$customer'")

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
window.location.replace("./");
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
