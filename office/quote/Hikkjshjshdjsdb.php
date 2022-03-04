<div class="col-sm-8" style="overflow-y: scroll; height:500px;">
    <div class="ibox-title">
        <?php
        $worth = 0.00;
        $basket = $db->query("SELECT sum(`qty`)  AS `qty`, `selling_price`,  sum(`basket`.`discount`) AS `sed` FROM `basket` JOIN `zvinhu`
            ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'quote'");
            while ($ba = mysqli_fetch_array($basket) ) {
                $co = $ba['qty'];
                $worth = $worth+(($ba['qty']*$ba['selling_price']));
                $worth = $worth - $ba['sed'];

            }

            $worth = amount($worth);


        ?>
        <h5>You have <?php echo "$co"; ?> items worth <?php echo "$$worth"; ?> in your cart </h5>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <?php if (access($user_id, 'discount')): ?>
                    <th>Discount</th>
                <?php endif; ?>
                <th>Total</th>
                <th>Do</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $basket = $db->query("SELECT `product_name`, `selling_price`, `basket`.`id` AS `we`, `qty`, `product_code`, `basket`.`discount` FROM `basket` JOIN `zvinhu`
                ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'quote'");
            $count = 0;
                while ($ba = mysqli_fetch_array($basket) ) {
                    $count++;
                    echo "<tr class='text-navy'> \n";
                    echo "<td> $count</td> \n";
                    echo "<td>".$ba['product_code']." </td> \n";
                    echo "<td>".$ba['product_name']." </td> \n";
                    echo "<td>".$ba['qty']." </td> \n";
                    echo "<td>".$ba['selling_price']." </td> \n";
                    if (access($user_id, 'discount')) {
                        echo "<td>".$ba['discount']." </td> \n";
                        echo "<td>$".amount(($ba['qty']*$ba['selling_price']) - $ba['discount'])." </td> \n";
                    }else {

                        echo "<td>$".amount(($ba['qty']*$ba['selling_price']))." </td> \n";
                    }
                    $line_id = $ba['we'];
                    $lmn = hide('e', $line_id);
                    echo "<td> <a href='dgjhsdgfiHSdhjhg.php?dflhuoyGASDO78otsad7t8Sfkysvdksyufp8gsdgyuy=$lmn'> <i class='fa fa-trash'></i></a> </td> \n </tr>";
                }
             ?>
        </tbody>
    </table>
</div>
