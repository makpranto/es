<div class="col-sm-8" style="overflow-y: scroll; height:500px;">
    <div class="ibox-title">
        <?php
        $worth = 0.00;
        $co = 0;
        $basket = r("SELECT `qty`, `selling_price`, `basket`.`discount` AS `sed` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
        while ($ba = mysqli_fetch_array($basket) ) {
            $co += $ba['qty'];
            $worth = $worth+(($ba['qty']*$ba['selling_price']));
            $worth = $worth - ($ba['sed']* $ba['qty']);
        }
        $worth = amount($worth);
        ?>
        <h1>US$<?php echo mari($worth); ?> | BOND $<?php echo mari((($worth*pull('rate', 'payment_methods', "`name` = 'BOND'")))); ?> | RTGS $<?php echo mari((($worth*pull('rate', 'payment_methods', "`name` = 'RTGS'")))); ?></h1>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>BOND</th>
                <th>RTGS</th>
                <th>USD</th>
                <th>Do</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $basket = r("SELECT `product_name`, `selling_price`, `basket`.`id` AS `we`, `qty`, `basket`.`discount` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
            $count = 0;
            while ($ba = mysqli_fetch_array($basket) ) {
                $count++;
                echo "<tr class='text-navy'> \n";
                echo "<td> $count</td> \n";
                echo "<td>".$ba['product_name']." </td> \n";
                echo "<td>".$ba['qty']." </td> \n";
                echo "<td>".mari($ba['selling_price'])." </td> \n";
                echo "<td>".mari((($ba['qty']*$ba['selling_price'])*pull('rate', 'payment_methods', "`name` = 'BOND'")))." </td> \n";
                echo "<td>".mari((($ba['qty']*$ba['selling_price'])*pull('rate', 'payment_methods', "`name` = 'RTGS'")))." </td> \n";
                echo "<td>".mari($ba['selling_price']*$ba['qty'])." </td> \n";
                $line_id = $ba['we'];
                $lmn = hide('e', $line_id);
                echo "<td><a data-role='delete' data-id='$lmn'>Delete <i class='fa fa-trash'></i></a></td> \n";
            }
            ?>
        </tbody>
    </table>
</div>
