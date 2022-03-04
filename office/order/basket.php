<div class="col-sm-8" style="overflow-y: scroll; height:500px;">
    <div class="ibox-title">
        <?php
        $worth = 0.00;
        $co = 0;
        $basket = r("SELECT `qty`, `basket`.`buying_price` AS `buying_price`, `basket`.`discount` AS `sed` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'pricing' AND `basket`.`status` = 'in_cart'");
        while ($ba = mysqli_fetch_array($basket) ) {
            $co += $ba['qty'];
            $worth = $worth+(($ba['qty']*$ba['buying_price']));
            $worth = $worth - ($ba['sed']* $ba['qty']);
        }
        $worth = amount($worth);
        ?>
        <h2>RTGS $<?php echo mari($worth); ?> | US$<?php echo mari((($worth*pull('rate', 'payment_methods', "`name` = 'USD'")))); ?> | BOND $<?php echo mari((($worth*pull('rate', 'payment_methods', "`name` = 'BOND'")))); ?></h2>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>RTGS</th>
                <th>USD</th>
                <th>BOND</th>

                <th>Do</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $basket = r("SELECT `product_name`, `basket`.`buying_price` AS `buying_price`, `basket`.`id` AS `we`, `qty`, `basket`.`discount` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'pricing' AND `basket`.`status` = 'in_cart'");
            $count = 0;
            while ($ba = mysqli_fetch_array($basket) ) {
                $count++;
                echo "<tr class='text-navy'> \n";
                echo "<td> $count</td> \n";
                echo "<td>".$ba['product_name']." </td> \n";
                echo "<td>".$ba['qty']." </td> \n";
                echo "<td>".mari($ba['buying_price'])."</td> \n";
                echo "<td>".mari((($ba['qty']*$ba['buying_price'])*pull('rate', 'payment_methods', "`name` = 'RTGS'")))." </td> \n";
                echo "<td>".mari((($ba['qty']*$ba['buying_price'])*pull('rate', 'payment_methods', "`name` = 'USD'")))." </td> \n";
                echo "<td>".mari((($ba['qty']*$ba['buying_price'])*pull('rate', 'payment_methods', "`name` = 'BOND'")))." </td> \n";
                $line_id = $ba['we'];
                $lmn = hide('e', $line_id);
                echo "<td><a data-role='delete' data-id='$lmn'>Delete <i class='fa fa-trash'></i></a></td> \n";
            }
            ?>
        </tbody>
    </table>
</div>
