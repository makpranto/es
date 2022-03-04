<?php
include '../heart/a.php';
secure('verify_quotations');
if (!there('id')) {
    error("You cannot be doing that.");
}else {
    $uid = clean(hide('d', $_POST['id']));
    if (empty($uid)) {
        error("You cannot be doing that.");
    }else {
        $as = r("SELECT * FROM `basket` WHERE `price_check_id` = '$uid' AND `status` = 'pending_int_approval'");
        if (mysqli_num_rows($as)<1) {
            error("Error");
        }else {
            $a = get($as);
            $ddd = '';
        }
    }
}
if (isset($ddd)): ?>
<div class="modal-dialog" style="width: 800px">
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
                    <h4 class="modal-title">Price Confirmation Request by <?php echo "$user_name";?></h4>
                    <p><?php echo date('d F, Y H:i:s', strtotime($a['time_of_insert'])); ?> (<?php echo ago($a['time_of_insert']); ?>)</p>
                    <table class="table  mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Customer Name</th>
                                <th>Supplier #1</th>
                                <th>Supplier #2</th>
                                <th>Supplier #3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                $client_id = $a['customer_id'];
                                echo "<td>".pull('full_name', 'walk_in_clients', "`id` = '$client_id'")."</td> \n";
                                $g = get(r("SELECT * FROM `price_quotes` WHERE `quote_id` = '$uid'"));
                                if (!empty($g['supp_one'])) {
                                    $supp_one = $g['supp_one'];
                                    $file = "../files/".$g['quote_one'];
                                    echo "<td><a href='$file' download>".pull('name', 'suppliers', "`id` = '$supp_one'")."</a></td> \n";
                                }else {
                                    echo "<td><i>none</i></td> \n";
                                }
                                if (!empty($g['supp_two'])) {
                                    $supp_two = $g['supp_two'];
                                    $file = "../files/".$g['quote_two'];
                                    echo "<td><a href='$file' download>".pull('name', 'suppliers', "`id` = '$supp_two'")."</a></td> \n";
                                }else {
                                    echo "<td><i>none</i></td> \n";
                                }
                                if (!empty($g['supp_three'])) {
                                    $supp_three = $g['supp_three'];
                                    $file = "../files/".$g['quote_three'];
                                    echo "<td><a href='$file' download>".pull('name', 'suppliers', "`id` = '$supp_three'")."</a></td> \n";
                                }else {
                                    echo "<td><i>none</i></td> \n";
                                }

                                // echo "<td><b>".pull('ec_number', 'civil_servants', "`id` = '$client_id'")."</b></td> \n";
                                // echo "<td><b>".pull('id_number', 'civil_servants', "`id` = '$client_id'")."</b></td> \n";
                                // echo "<td><b>$active/$all_loans</b></td> \n";
                                // echo "<td><b>$".number_format($instal, 2)."</b></td> \n";
                                // echo "<td><b>$".number_format($bal, 2)."</b></td> \n";
                                // echo "<td><b>$".number_format($gross_settlement, 2)."</b></td> \n";
                                // echo "<td><a href='#' onclick='return rep(\"$jin\");'><i class='fa fa-print'></i> Print Full Statement</a></td> \n";
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-body" style="overflow-y: scroll; height:400px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Description</th>
                                <th>u.o.m</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Markup</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = $qty = $total = 0;
                            $ass = r("SELECT * FROM `basket` WHERE `price_check_id` = '$uid' AND `status` = 'pending_int_approval'");
                            while ($as = get($ass) ) {
                                $count++;
                                echo "<tr class='text-dark'> \n";
                                echo "<td> $count</td> \n";
                                $product_id = $as['product_id'];
                                $uom = pull('uom', 'zvinhu', "`id` = '$product_id'");
                                $up = $as['buying_price']*$as['markup'];
                                echo "<td>".pull('product_name', 'zvinhu', "`id` = '$product_id'")." </td> \n";
                                echo "<td>".pull('name', 'uom', "`id` = '$uom'")." </td> \n";
                                echo "<td>".$as['qty']." </td> \n";
                                $qty += $as['qty'];
                                $total += (($as['qty']*$as['buying_price'])*(1+($as['markup'])));
                                echo "<td>".mari($as['buying_price'])." </td> \n";
                                echo "<td>".(($as['markup'])*100)."%</td> \n";
                                echo "<td class='r'>".mari(($as['qty']*$as['buying_price'])*(1+($as['markup'])))."</td> \n";
                                echo "</tr> \n";
                            }

                            echo "<tr class='text-primary'> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "</tr> \n";
                            echo "<tr class='text-primary'> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "</tr> \n";
                            echo "<tr class='text-navy'> \n";
                            echo "<td></td> \n";
                            echo "<td><b>Total</b></td> \n";
                            echo "<td></td> \n";
                            echo "<td><b>$qty</b></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td class='r'><b>".mari($total)."</b></td> \n";
                            echo "</tr> \n";
                            echo "</tr> \n";
                            echo "<tr class='text-navy'> \n";
                            echo "<td></td> \n";
                            echo "<td><b>VAT</b></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td><b>$vat%</b></td> \n";
                            echo "<td  class='r'><b>".mari($total*($vat/100))."</b></td> \n";
                            echo "</tr> \n";
                            echo "</tr> \n";
                            echo "<tr> \n";
                            echo "<td></td> \n";
                            echo "<td><b>TOTAL VAT INCL</b></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td></td> \n";
                            echo "<td class='r'><b>$".mari(($total*($vat/100))+$total)."</b></td> \n";
                            echo "</tr> \n";
                            ?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" class="form-control" id="user-id">
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-4">
                            <a onclick="return accept('<?php echo hide('e', $uid); ?>')" class="btn btn-primary pull-right">Accept Order</a>
                        </div>
                        <div class="col-md-4 form-group">
                            <center><input class="form-control" type="text" onblur='return decline("<?php echo hide('e', $uid); ?>", this.value);' placeholder="Type rejection reason"></center>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#myModal').modal('toggle');
</script>
<?php endif; ?>
