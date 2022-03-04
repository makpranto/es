<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Total</th>
            <th>Markup %</th>
            <th>Revenue</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $as = r("SELECT * FROM `basket` WHERE `status` = 'pending_int_approval'  GROUP BY `price_check_id` ORDER BY `id` ASC");
        while ($a = get($as)) {
            $cid = $a['customer_id'];
            $uid = $a['price_check_id'];
            $count++;
            $jin = hide('e', $a['price_check_id']);
            echo "<tr id='$jin'>\n";
            echo "<td>".$count."</td> \n";
            echo "<td>".pull('full_name', 'walk_in_clients', "`id` = '$cid'")."</td> \n";
            $ad = r("SELECT * FROM `basket` WHERE `price_check_id` = '$uid' AND `status` = 'pending_int_approval'");
            $amount = 0;
            while ($d = get($ad)) {
                $amount += ($d['qty']  * $d['buying_price']);
            }
            echo "<td>".mari($amount)."</td> \n";
            echo "<td>".mari($a['markup']*100)."</td> \n";
            echo "<td>".mari(($amount * $a['markup']))."</td> \n";
            // echo "<td><input type='text' placeholder='Type your rejection reason.' class='form-control col-md-12' onblur='return decline(\"$jin\", this.value);'></td> \n";
            echo "<td><center><a data-role='view_order' data-id='$jin'>View</a></center></td> \n";
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Total</th>
            <th>Markup %</th>
            <th>Revenue</th>
            <th>View</th>
        </tr>
    </tfoot>
</table>
