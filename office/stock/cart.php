<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Buying Price</th>
            <th>Selling Price</th>
            <?php if (access($user_id, 'adjust_static')): ?>
                <th>Counted</th>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $get = r("SELECT * FROM `zvinhu` ORDER BY `id` DESC");
        while ($a = mysqli_fetch_array($get)) {
            $cat = $a['main_cat'];
            $count++;
            $jin = hide('e', $a['id']);
            $id = $a['id'];
            if (mysqli_num_rows(r("SELECT `id` FROM `stock_taking` WHERE `product_id` = '$id' AND `status` = 'in_cart'"))>0) {

            }else {
                $qty = $a['on_hand'];
                echo "<tr id='$jin'>\n";
                echo "<td>$count</td> \n";
                echo "<td>".$a['product_name']."</td> \n";
                echo "<td><center>".$a['on_hand']."</center></td> \n";
                echo "<td><center>$".mari($a['buying_price'])."</center></td> \n";
                echo "<td><center>$".mari($a['selling_price'])."</center></td> \n";
                if (access($user_id, 'adjust_static')) {
                    $key = str_shuffle("HOsodfnbnxcuiIUY89ehuiasvUSUasdjhASLJDSBDuhiwqduyVAKSHDUSKHSADVUSVADGUIUsdvkSADIHKHSADVKHVHSUADVHKASDBVKHSVDK").time();
                    echo "<td><center><input name='$jin' id='".str_replace('=', '', hide('e', $key))."' type='number' value='$qty' min='0' class='form-control'></center></td> \n";
                    echo "<td><button type='button' id='$key' class='btn btn-sm btn-active m-t-n-xs' onclick='return add_to_stock_take(\"".hide('e',hide('e',  $id))."\", \"".str_replace('=', '', hide('e', $key))."\")'>Commit</button></td>";
                }
                echo " </tr>";
            }

        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <!-- <input onkeyup='return add_to_stock_take_(\"".hide('e',hide('e',  $id))."\", \"".str_replace('=', '', hide('e', $key))' name="" value=""> -->
            <th>#</th>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Buying Price</th>
            <th>Selling Price</th>
            <?php if (access($user_id, 'adjust_static')): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </tfoot>
</table>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
<script>
$(document).ready(function(){
    // Get the input field
// var input = document.getElementById("myInput");
//
// // Execute a function when the user releases a key on the keyboard
// input.addEventListener("keyup", function(event) {
//   // Number 13 is the "Enter" key on the keyboard
//   if (event.keyCode === 13) {
//     // Cancel the default action, if needed
//     event.preventDefault();
//     // Trigger the button element with a click
//     document.getElementById("myBtn").click();
//   }
// });
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
