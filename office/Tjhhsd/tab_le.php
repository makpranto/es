<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>On Hand</th>
            <th>Counted</th>

        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $get = $db->query("SELECT `zvinhu`.`id` AS `id`, `zvinhu`.`discount`  AS `discount`, `product_code`,`buying_price`, `selling_price`, `product_name`, `on_hand`, `type`, `product_code`, `name` FROM `zvinhu` JOIN `categories` ON
             `categories`.`id` = `type` WHERE `zvinhu`.`company_id` = '$company_id' ORDER BY `zvinhu`.`id`");
        while ($a = mysqli_fetch_array($get)) {
            $count++;
            $jin = hide('e', $a['id']);
            echo "<tr id='$jin'>\n";
            echo "<td>$count</td> \n";
            echo "<td data-target='product_code'>".$a['product_code']."</td> \n";
            echo "<td data-target='product_name'>".$a['product_name']."</td> \n";
            echo "<td data-target='on_hand'><center>".$a['on_hand']."</center></td> \n";
            echo "<td><input type='text' class='form-control' onblur='return stock(\"$jin\", this.value);' name=' value='></td> \n";
            echo " </tr>";
            }
        ?>
    </tbody>
    <tfoot>

        <tr>
            <th>#</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>On Hand</th>


             <th>Counted</th>

        </tr>
    </tfoot>
</table>
<script>
$(document).ready(function(){
    $('.dataTables-example').DataTable({
        pageLength: 100,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv',  title: '<?php echo "$company_name Stocklist" ; ?>'},
            {extend: 'excel', title: '<?php echo "$company_name Stocklist" ; ?>'},
            {extend: 'pdf', title: '<?php echo "$company_name Stocklist" ; ?>'},
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
