<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'orders');
if (!there('id')) {
    error("You cannot be doing that.");
}else {
    $uid = clean(hide('d', $_POST['id']));
    if (empty($uid)) {
        error("You cannot be doing that.");
    }else {
        $as = r("SELECT * FROM `basket` WHERE `uid` = '$uid' AND `status` = 'Order Received'");
        if (mysqli_num_rows($as)<1) {
            error("Error");
        }else {
            $a = get($as);
            $ddd = '';
        }
    }
}
if (isset($ddd)): ?>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="ibox" id="ibox2">
            <div class="ibox-content">
                <div class="sk-spinner sk-spinner-wave">
                    <div class="sk-rect1"></div>
                    <div class="sk-rect2"></div>
                    <div class="sk-rect3"></div>
                    <div class="sk-rect4"></div>
                    <div class="sk-rect5"></div>
                </div>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Order by <?php $cid = $a['user_id']; echo hide('d',pull('name', 'customers', "`id` = '$cid'"));?></h4>
                    <p><?php echo date('d F, Y H:i:s', strtotime($a['time_of_insert'])); ?> (<?php echo ago($a['time_of_insert']); ?>)</p>
                </div>
                <div class="modal-body" style="overflow-y: scroll; height:500px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            $ass = r("SELECT * FROM `basket` WHERE `uid` = '$uid' AND `status` = 'Order Received'");
                            while ($as = get($ass) ) {
                                $count++;
                                echo "<tr class='text-navy'> \n";
                                echo "<td> $count</td> \n";
                                $product_id = $as['product_id'];
                                echo "<td>".pull('product_name', 'zvinhu', "`id` = '$product_id'")." </td> \n";
                                echo "<td>".$as['qty']." </td> \n";
                                echo "<td>$".pull('selling_price', 'zvinhu', "`id` = '$product_id'")." </td> \n";
                                echo "<td>$".amount(amount(pull('selling_price', 'zvinhu', "`id` = '$product_id'"))*$as['qty'])." </td> \n";
                                echo "</tr> \n";
                            }
                            $coupon = $a['coupon'];
                            if ($coupon == '') {
                                $coupon = '0.00';
                            }else {
                                $coupon = pull('amount', 'coupons', "`id` = '$coupon'");
                                $coupon .= ' ('.pull('coupon', 'coupons', "`id` = '$coupon'").')';
                                echo "<tr class='text-primary'> \n";
                                echo "<td> $count</td> \n";
                                echo "<td></td> \n";
                                echo "<td></td> \n";
                                echo "<td></td> \n";
                                echo "<td>$$coupon</td> \n";
                                echo "</tr> \n";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" class="form-control" id="user-id">
                <div class="modal-footer">
                    <a onclick="return accept('<?php echo hide('e', $uid); ?>')" class="btn btn-primary pull-right">Accept Order</a>
                    <button class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#myModal').modal('toggle');
</script>
<?php endif; ?>
