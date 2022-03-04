<?php
include 'fun.php';
global $user_id;
$items = 0;
$total = 0;
$ge = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order'");
$gets = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order' ORDER BY `id` DESC");
while ($z = get($ge)) {
    $p = $z['product_id'];
    $items = $items + $z['qty'];
    $total = $total + (pull('selling_price', 'zvinhu', "`id` = '$p'")*$z['qty']);
}
$total = amount($total);
while ($a = get($gets)):
    $id = $a['product_id'];
    $ids = $a['id'];
    $img = $home.'i/p/'.pull('image', 'zvinhu', "`id` = '$id'");
    $key = str_shuffle("*dfhj**0ew98sdsdsdsdsd98ew^&ege!`e3`").time();
    ?>
    <div class="cart-list-product">
        <a class="float-right" href="#" onclick="return un__cart('<?php echo hide('e', $ids); ?>');"><i class="mdi mdi-close"></i></a>
        <img class="img-fluid" src="<?php echo $img; ?>" alt="">
        <div class="cart-store-details">
            <p> <a class="text-success" href="<?php echo $home.'product/'.str_replace(' ', '-', mb_strtolower(pull('product_name', 'zvinhu', "`id` = '$id'"))); ?>"><?php echo word(pull('product_name', 'zvinhu', "`id` = '$id'")); ?></a> </p>
            <p>$<?php echo mari(pull('selling_price', 'zvinhu', "`id` = '$id'")* $a['qty']); ?></p>
            <?php
            echo "
            <input type='number' id='".hide('e', $key)."'  min='0' value='".$a['qty']."'  name='quantity' class='ghj' onchange='return edit_basket(\"".hide('e',hide('e',  $ids))."\", \"".hide('e', $key)."\")'>
            ";
            ?>
        </div>
    </div>
<?php endwhile; ?>
