<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Coupon</th>
            <th>Value</th>
            <th>Minimum</th>
            <th>Status</th>
            <th>Creator</th>
            <th>User</th>
            <th>Total Purchase</th>
            <!-- <th>View Sale</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $get = r("SELECT * FROM `coupons`");
        while ($a = mysqli_fetch_array($get)) {
            $count++;
            $jin = hide('e', $a['id']);
            $u = $a['user_id'];
            $c = $a['customer_id'];
            if ($c == '') {
                $c = '<i>none</i>';
            }else {
                $c = pull('email_address', 'customers', "`id` = '$c'");
                $c = hide('d', $c);
            }
            $coup = $a['id'];
            echo "<tr id='$jin'>\n";
            echo "<td>$count</td> \n";
            echo "<td>".$a['coupon']."</td> \n";
            echo "<td>$".$a['amount']."</td> \n";
            echo "<td>$".$a['minimum']."</td> \n";
            echo "<td>".$a['status']."</td> \n";
            echo "<td>".pull('name', 'chikwata', "`id` = '$u'")."</td> \n";
            echo "<td>$c</td> \n";
            if ($a['status'] == 'USED') {
                $ad = r("SELECT `qty`, `discount`, `unit_price` FROM `basket` WHERE `coupon` = '$coup' AND `status` != 'order'");
                $amount = 0;
                while ($d = get($ad)) {
                    $amount += ($d['qty'] * $d['unit_price']) - ($d['qty'] * $d['discount']);
                }
                echo "<td>$".amount($amount)."</td> \n";
            }else {
                echo "<td></td> \n";
            }
            // echo "<td><center><a data-role='view_order' data-id='$jin'>View</a></center></td> \n";
            echo " </tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Coupon</th>
            <th>Value</th>
            <th>Minimum</th>
            <th>Status</th>
            <th>Creator</th>
            <th>User</th>
            <th>Total Purchase</th>
            <!-- <th>View Sale</th> -->
        </tr>
    </tfoot>
</table>
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
        {extend: 'csv',  title: '<?php echo "All Coupons" ; ?>'},
        {extend: 'excel', title: '<?php echo "All Coupons" ; ?>'},
        {extend: 'pdf', title: '<?php echo "All Coupons" ; ?>'},
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
