<?php
include '../heart/a.php';
secure('start_order');
$all = r("SELECT `id` FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'pricing' AND `status` = 'in_cart'");
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
                        $basket = r("SELECT `qty`, `product_id`, `buying_price`, `discount` AS `sed` FROM `basket`  WHERE `user_id` = '$user_id' AND `type` = 'pricing' AND `status` = 'in_cart'");
                        while ($ba = get($basket) ) {
                            $co = $ba['qty'];
                            $pid = $ba['product_id'];
                            $worth = $worth+(($ba['qty']*$ba['buying_price']));
                            $worth = $worth - ($ba['sed']);
                        }
                        ?>
                        <h2>RTGS $<?php echo mari($worth); ?> | US$<?php echo mari((($worth*pull('rate', 'payment_methods', "`name` = 'USD'")))); ?> | BOND $<?php echo mari((($worth*pull('rate', 'payment_methods', "`name` = 'BOND'")))); ?></h2>
                        <form role="form" method="post" id="akunda"  enctype="multipart/form-data" >
                            <span id="shubter"></span>
                            <div class="form-group"><input type="text" placeholder="Client's Name" name="client_name" autocomplete='off' class="form-control" id="clients" class="form-control"></div>
                            <div class="form-group"><input type="text" placeholder="Phone Number" name="phone" autocomplete='off' class="form-control"></div>
                            <div class="form-group"><input type="email" placeholder="Email Address" name="email_address" autocomplete='off' class="form-control"></div>
                            <div class="form-group"><input type="number" min='25' max='30' placeholder="Markup %" name="markup" autocomplete='off' class="form-control"></div>
                            <div class="form-group col-md-6"><input type="text" placeholder='Supplier #1' name="supp_one" autocomplete='off' class="form-control supplier"></div>
                            <div class="form-group col-md-6">
                                <input type="file" class="form-control" name="quote_one"  accept=".jpg, .png, .jpeg, .pdf"/>
                            </div>
                            <div class="form-group col-md-6"><input type="text" placeholder='Supplier #2' name="supp_two" autocomplete='off' class="form-control supplier"></div>
                            <div class="form-group col-md-6">
                                <input type="file" class="form-control" name="quote_two"  accept=".jpg, .png, .jpeg, .pdf"/>
                            </div>
                            <div class="form-group col-md-6"><input type="text" placeholder='Supplier #3' name="supp_three" autocomplete='off' class="form-control supplier"></div>
                            <div class="form-group col-md-6">
                                <input type="file" class="form-control" name="quote_three"  accept=".jpg, .png, .jpeg, .pdf"/>
                            </div>
                            <div id="res"></div>
                            <div class="text-center">
                                <button type="submit" name="upload" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('.supplier').typeahead({
        source: function (query, result) {
            $.ajax({
                items:20,
                url: "supplier.php",
                data: 'query=' + query,
                dataType: "json",
                type: "POST",
                success: function (data) {
                    result($.map(data, function (item) {
                        return item;
                    }));
                }
            });
        }
    });
    $('#clients').typeahead({
        source: function (query, result) {
            $.ajax({
                items:20,
                url: "clients.php",
                data: 'query=' + query,
                dataType: "json",
                type: "POST",
                success: function (data) {
                    result($.map(data, function (item) {
                        return item;
                    }));
                }
            });
        }
    });
});
</script>
<?php
else:
    error("Your basket is currently empty.");
endif; ?>
