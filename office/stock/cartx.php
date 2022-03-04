<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Value</th>
            <th>Buying Price</th>
            <?php if (access($user_id, 'adjust_static')): ?>
                <th>Counted</th>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $get = r("SELECT * FROM `stock_taking` ORDER BY `id` DESC");
        while ($a = mysqli_fetch_array($get)) {
            $count++;
            $jin = hide('e', $a['id']);
            $id = $a['id'];
            $qty = $a['variance'];

            echo "<tr id='$jin' >\n";
            echo "<td>$count</td> \n";
            echo "<td>".pn($a['product_id'])."</td> \n";
            if ($qty == 0) {
                echo "<td class='navy-bg'><center>".str_replace('+', '', $a['variance'])."</center></td> \n";
            }else {
                echo "<td class='bg-danger'><center>".str_replace('+', '', $a['variance'])."</center></td> \n";
            }
            if ($a['buying_price'] != 0) {
                echo "<td><center>".str_replace('$-', '-$', '$'.mari($a['buying_price']*str_replace('+', '', $a['variance'])))."</center></td> \n";
            }else {
                echo "<td><center>$0.00</center></td> \n";
            }

            echo "<td><center>$".mari($a['buying_price'])."</center></td> \n";
            if (access($user_id, 'adjust_static')) {
                $key = str_shuffle("HOsodfnbnxcuiIUY89ehuiasvUSUasdjhASLJDSBDuhiwqduyVAKSHDUSKHSADVUSVADGUIUsdvkSADIHKHSADVKHVHSUADVHKASDBVKHSVDK").time();
                echo "<td><center><input name='$jin' id='".str_replace('=', '', hide('e', $key))."' type='number' value='$qty' min='0' class='form-control'></center></td> \n";
                echo "<td><button type='button' id='$key' class='btn btn-sm btn-active m-t-n-xs' onclick='return adjust(\"".hide('e',hide('e',  $id))."\", \"".str_replace('=', '', hide('e', $key))."\")'>Commit</button></td>";
            }
            echo " </tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Buying Price</th>
            <th>Buying Price</th>
            <?php if (access($user_id, 'adjust_static')): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </tfoot>
</table>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        pageLength: 100,
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
