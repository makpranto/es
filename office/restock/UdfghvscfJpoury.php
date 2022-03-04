<div class="col-sm-8" style="overflow-y: scroll; height:500px;">
    <div class="ibox-title">
        <?php
        $items = 0;
        $total = 0.00;
        $baskets = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'new'");
        while ($a = get($baskets)) {
            $items += $a['qty'];
            $total += amount($a['unit_price']*$a['qty']);
        }
        ?>
        <h3>You have <?php echo "$items"; $ref = 'items' ?> <?php if ($items == 1) {
            $ref = 'item';
        }elseif ($items> 1) {
            $ref = 'items';
        } echo " $ref";?> worth $<?php echo number_format($total, 2); ?> in your cart </h3>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
                <th>Do</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 0;
            $basket = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'new'");
            while ($ba = get($basket)) {
                $count++;
                $pid = $ba['product_id'];
                if ($ba['mop'] == 'gadg') {
                    $product_name = pull('product_name', 'phones', "`id` = '$pid'");
                    $product_code = pull('product_code', 'phones', "`id` = '$pid'");
                    echo "<tr class='text-navy'> \n";
                    echo "<td> $count</td> \n";
                    echo "<td>$product_code</td> \n";
                    echo "<td>$product_name</td> \n";
                    echo "<td>".$ba['qty']." </td> \n";
                    echo "<td>".$ba['unit_price']." </td> \n";
                    echo "<td>$".amount(($ba['qty']*$ba['unit_price']))." </td> \n";
                    $line_id = $ba['id'];
                    $lmn = hide('e', $line_id);
                    echo "<td><a data-role='delete' data-id='$lmn'>Delete <i class='fa fa-trash'></i></a></td></tr> \n";

                }else {
                    $product_name = pull('product_name', 'zvinhu', "`id` = '$pid'");
                    $product_code = pull('product_code', 'zvinhu', "`id` = '$pid'");
                    echo "<tr class='text-navy'> \n";
                    echo "<td> $count</td> \n";
                    echo "<td>$product_code</td> \n";
                    echo "<td>$product_name</td> \n";
                    echo "<td>".$ba['qty']." </td> \n";
                    echo "<td>".$ba['unit_price']." </td> \n";
                    echo "<td>$".amount(($ba['qty']*$ba['unit_price']))." </td> \n";
                    $line_id = $ba['id'];
                    $lmn = hide('e', $line_id);
                    echo "<td><a data-role='delete' data-id='$lmn'>Delete <i class='fa fa-trash'></i></a></td></tr> \n";
                }
            }
            ?>
        </tbody>
    </table>
</div>
