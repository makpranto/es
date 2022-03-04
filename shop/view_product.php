<?php
include 'a/fun.php';
$url = url();
if (strpos($url, '/product/') !== false) {
    $product_name = substr($url, strpos($url, 'product/'));
    $product_name = mb_strtoupper($product_name);
    $product_name = str_replace('PRODUCT/', '', $product_name);
    $product_name = str_replace('/', '', $product_name);
    $product_name = clean($product_name);
    $product_name = linker('i', $product_name);
    $pd = str_replace(' ', '-', $product_name);
    $d = r("SELECT * FROM `zvinhu` WHERE `product_name` = '$product_name' OR `product_name` = '$pd' AND `status` = 1");
    if (mysqli_num_rows($d) == 1) {
        $a = get($d);
        $id = $a['id'];
        $product_name = pname($a['product_name']);
        $description = $a['description'];
        $brand = pull('name', 'brands', "`id` = '".$a['brand']. "'");
        $product_price = $a['selling_price'];
        $img = $home.'i/p/'.$a['image'];
        $category = pull('name', 'categories', "`id` = '".$a['main_cat']. "'");
        $clink = pull('id', 'categories', "`id` = '".$a['main_cat']. "'");
        $brand = pull('name', 'brands', "`id` = '".$a['brand']. "'");
        $main_cat = $a['main_cat'];
        $sub_cat = $a['sub_cat'];
    }else {
        http_response_code(404);
        $lost = 'product/page';
        include 'tysla_solutions_alt.php';
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:image" content="<?php echo $img; ?>" />
    <meta name="description" content="<?php echo "Buy $product_name on "; ?>www.apise.shop | <?php echo "$description";?>"/>
    <title><?php echo "Buy $product_name on "; ?> www.apise.shop</title>
    <?php style(); ?>
</head>
<body>
    <?php nav(); ?>
    <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo "$home"; ?>"><strong><span class="mdi mdi-home"></span> Home</strong></a>
                    <span class="mdi mdi-chevron-right"></span>
                    <a href="<?php echo $home.'categories/'. mb_strtolower(str_replace(' ', '-', pull('name', 'categories', "`id` = '$main_cat'")));?>/"><?php echo pull('name', 'categories', "`id` = '$main_cat'"); ?></a>
                    <span class="mdi mdi-chevron-right"></span> <a href="<?php echo $home.'categories/'. mb_strtolower(str_replace(' ', '-', pull('name', 'sub_categories', "`id` = '$sub_cat'")));?>/"><?php echo pull('name', 'sub_categories', "`id` = '$sub_cat'")?></a>
                    <span class="mdi mdi-chevron-right"></span> <a href="<?php echo url(); ?>"><?php echo pname($product_name);?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="shop-single">
        <div class="container">
            <div class="row">
                <div class="col-md-6" style="width:100%">
                    <div class="shop-detail-left">
                        <div class="shop-detail-slider">
                            <div class="item">
                                <div class="col-md-12 marko" style="background-image: url('<?php echo $img; ?>')"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="shop-detail-right">
                        <?php
                        if (!empty($brand)){
                            echo "<span class='badge badge-success text-right'>".word($brand)."</span>";
                        }
                        ?>
                        <h2><?php echo pname($product_name); ?></h2>
                        <h5 class="text-success"><strong><span class="mdi mdi-approval mb-50"></span>$<?php echo mari($product_price); ?></strong></h5>
                        <?php
                        $key = str_shuffle("HOsodfnbnxcuiIUY89ehuiasvUSUasdjhASLJDSBDuhiwqduyVAKSHDUSKHSADVUSVADGUIUsdvkSADIHKHSADVKHVHSUADVHKASDBVKHSVDK").time();
                        $kids = hide('e', $key.$key);
                        echo "
                        <div class='quantity'>
                        <button class='minus-btn btns' value='-' type='button' name='button'>-
                        </button>
                        <input type='text' id='".str_replace('=', '', hide('e', $key))."'  min='1' value='1'  name='quantity'>

                        <button class='plus-btn btns' value='-' type='button' name='button'>
                        +
                        </button>
                        <button type='button' title='Add to your Cart' id='$key' class='btns btn-secondary btn-sm' onclick='return add_to_basket(\"".hide('e',hide('e',  $id))."\", \"".str_replace('=', '', hide('e', $key))."\")'><i class='mdi mdi-cart-outline'></i>Add To Cart</button>
                        </div>";
                        ?>
                        <div class="short-description tm-20">
                            <h6>
                                Description
                            </h6>
                            <p class="mb-0"><?php echo "$description"; ?></p>
                            <div class="ibox-content product-box">
                                <table class="table table-striped">
                                    <thead>

                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 0;
                                        $basket = r("SELECT * FROM `att` WHERE `pro_id` = '$id'");
                                        while ($ba = get($basket)) {
                                            $count++;
                                            $pid = $ba['id'];
                                            echo "<tr> \n";
                                            echo "<td><b>".$ba['att_name']."</b></td> \n";
                                            echo "<td>".$ba['att_text']."</td></tr> \n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <h6 class="mb-3 mt-4">Share on social media </h6>
                        <div class="row">
                            <div class="footer-social">
                                <a class="btn-whatsapp w79" href="https://api.whatsapp.com/send?text=Hello there. Check out the <?php  echo word($product_name). ' on '.url(); ?>" target="_blank"><i class="mdi mdi-whatsapp"></i></a>
                                <a class="btn-facebook w79" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo url(); ?>&quote=Hello there. Check out the <?php echo word($product_name); ?> on <?php echo url(); ?>" target="_blank"><i class="mdi mdi-facebook"></i></a>
                                <a class="btn-twitter w79" href="http://twitter.com/share?text=Hello there. Check out the <?php  echo word($product_name). ' on apise.shop&url='.url().""; ?>&hashtags=apisestore,onlineshopping" target="_blank"><i class="mdi mdi-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding bg-white border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-truck-fast"></i>
                        <h6>Cheap same day Delivery</h6>
                        <p>Delivering in 24hrs at the rate of <?php echo $delivery_rate*100; ?>% of total purchase.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-basket"></i>
                        <h6>100% Satisfaction</h6>
                        <p>We make sure that we exceed your expectation.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="feature-box">
                        <i class="mdi mdi-tag-heart"></i>
                        <h6>Great Daily Deals Discount</h6>
                        <p>Be on the lookout for our promotions.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php foot(); script(); ?>
</body>
</html>
