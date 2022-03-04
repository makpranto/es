<?php
include '../heart/a.php';
secure('sell');
$all = r("SELECT `product_name`, `selling_price`, `basket`.`id` AS `we`, `qty`, `basket`.`discount` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
if (mysqli_num_rows($all) > 0) {
    $proceed = 20;
}
if (isset($proceed)): ?>
<script>
$('#finalise').modal('toggle');
</script>
<div id="finalise" class="modal fade" aria-hidden="false">
    <div class="modal-dialog" style="width: 720px">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 b-r">
                        <?php
                        $agent_name = '';
                        $worth = 0.00;
                        $basket = r("SELECT `qty`, `product_id`,  `discount` AS `sed` FROM `basket`  WHERE `user_id` = '$user_id' AND `type` = 'sale'");
                        while ($ba = get($basket) ) {
                            $co = $ba['qty'];
                            $pid = $ba['product_id'];
                            $worth = $worth+(($ba['qty']*pull('selling_price', 'zvinhu', "`id` = '$pid'")));
                            $worth = $worth - ($ba['sed']);
                        }
                        $worth = amount($worth);
                        ?>
                        <div id="bag">
                            <h2 class="text-danger">US$<?php echo mari($worth); ?> | BOND $<?php echo mari((($worth*pull('rate', 'payment_methods', "`name` = 'BOND'")))); ?> | RTGS $<?php echo mari((($worth*pull('rate', 'payment_methods', "`name` = 'RTGS'")))); ?></h2>
                        </div>
                        <form role="form" method="post" id="akunda" >
                            <span id="shubter"></span>
                            <?php
                            $rpl = r("SELECT `name`, `rate`, `id` FROM `payment_methods` WHERE `status` = 'ACTIVE'");
                            while ($rvb = get($rpl)) {
                                $ha = hide('e', $rvb['name']);
                                $id = hide('e', $rvb['id']);
                                echo "<div class='form-group'><input onkeyup=\"return money();\" type='text'autocomplete='off' placeholder='".$rvb['name'].' (rate = '. $rvb['rate'].")' name='".$ha."' class='form-control'></div>";
                            }
                            ?>
                            <div class="form-group"><input type="text" placeholder="Client's Name" name="client_name" autocomplete='off' class="form-control" id="client_name" class="typeahead_2 form-control"></div>
                            <div class="form-group"><input type="text" placeholder="Phone Number" name="phone" autocomplete='off' class="form-control"></div>
                            <div class="form-group"><input type="email" placeholder="Email Address" name="email_address" autocomplete='off' class="form-control"></div>
                                <div id="res"></div>
                            <div class="text-center">
                                <a onclick="return save();" class="btn btn-primary">Submit</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
else:
    error("Your basket is currently empty.");
endif; ?>
