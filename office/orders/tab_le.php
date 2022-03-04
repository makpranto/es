<table class="table table-striped table-bordered table-hover dataTables-example" >
    <thead>
        <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>City</th>
            <th>Coupon's Value</th>
            <th>Order Total</th>
            <th>Decline</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        $as = r("SELECT * FROM `basket` WHERE `status` = 'Order Received'  GROUP BY `uid` ORDER BY `id` ASC");
        while ($a = get($as)) {
            $cid = $a['user_id'];
            $uid = $a['uid'];
            $count++;
            $coupon = $a['coupon'];
            if ($coupon == '') {
                $coupon = '0.00';
            }else {
                $coupon = pull('amount', 'coupons', "`id` = '$coupon'");
                $coupon .= ' ('.pull('coupon', 'coupons', "`id` = '$coupon'").')';
            }
            $jin = hide('e', $a['uid']);
            echo "<tr id='$jin'>\n";
            echo "<td>".$count."</td> \n";
            echo "<td>".$a['uid']."</td> \n";
            $phone = hide('d', pull('phone', 'customers', "`id` = '$cid'"));
            $email = hide('d', pull('email_address', 'customers', "`id` = '$cid'"));
            echo "<td>";word(hide('d', pull('name', 'customers', "`id` = '$cid'"))); echo' '; echo word(hide('d', pull('surname', 'customers', "`id` = '$cid'")));echo "</td> \n";
            $cred = get(r("SELECT (SUM(`unit_price`)-SUM('discount')) AS `i` FROM `basket` WHERE `uid` = '$uid' AND `status` = 'Order Received'"));
            echo "<td><a href='mailto:$email'>$email</a></td> \n";
            echo "<td><a href='tel:$phone'>$phone</a></td> \n";
            echo "<td>".hide('d', pull('street_address', 'customers', "`id` = '$cid'"))."</td> \n";
            echo "<td>".hide('d', pull('town', 'customers', "`id` = '$cid'"))."</td> \n";
            echo "<td><strong>$$coupon</strong></td> \n";
            $ad = r("SELECT `qty`, `discount`, `unit_price` FROM `basket` WHERE `uid` = '$uid' AND `status` = 'Order Received'");
            $amount = 0;
            while ($d = get($ad)) {
                $amount += ($d['qty'] * $d['unit_price']) - ($d['qty'] * $d['discount']);
            }
            echo "<td>$".amount($amount)."</td> \n";
            echo "<td><input type='text' placeholder='Type your rejection reason.' class='form-control col-md-12' onblur='return decline(\"$jin\", this.value);'></td> \n";
            echo "<td><center><a data-role='view_order' data-id='$jin'>View</a></center></td> \n";
            echo "</tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>City</th>
            <th>Coupon's Value</th>
            <th>Order Total</th>
            <th>Decline</th>
            <th>View</th>
        </tr>
    </tfoot>
</table>
