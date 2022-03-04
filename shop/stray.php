<?php
if (!isset($wild)) {
    header("location: ./");
}
$product_name = clean($_GET['q']);
if (isset($_GET['page'])) {
    $accent = $_GET['page'];
    $accents = $_GET['page'];
} else {
    $accent = 1;
}
$accent = number(clean($accent));
$search = $_GET['q'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo word("Search results for $product_name on "); ?> www.apise.shop</title>
    <?php style(); ?>
</head>
<body>
    <?php nav(); ?>
    <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
        <div class="container">
            <div class="row align-center">
                <p>Search results for: <strong><?php echo "$product_name"; ?></strong> (<?php echo mysqli_num_rows($df); ?> results found)</p>
            </div>
        </div>
    </section>
    <section class="section-padding bg-white border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 b-r">
                    <?php
                    $no_of_records_per_page = 20;
                    $page = 0;
            		if (isset($_GET['page'])) {
            			$page  = number(clean($accent));
            		} else {
            			$page=1;
            		};
            		$startFrom = ($page-1) * 20;

                    $r = get(r("SELECT COUNT(*) AS `zw` FROM `zvinhu` WHERE (`description` LIKE '$search_param' OR `selling_price` LIKE '$search_param' OR `product_name` LIKE '$search_param') AND `status` = 1"));
                    $total_rows = $r['zw'];
                    $total_pages = ceil($total_rows / $no_of_records_per_page);
                    $q = "SELECT * FROM `zvinhu` WHERE (`description` LIKE '$search_param' OR `selling_price` LIKE '$search_param' OR `product_name` LIKE '$search_param') AND `status` = 1 LIMIT $startFrom, $no_of_records_per_page";
                    $as = r($q);
                    while ($a = get($as)):
                        $img = $home.'i/p/'.$a['image'];
                        $link = $home.'product/'.linker('o', $a['product_name']);
                        ?>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3 col-sm-6 pointer" onclick="window.location.href='<?php echo "$link"; ?>/'">
                                    <div style="width:100px;height: 100px;background-image: url(<?php echo $img; ?>); background-size: contain; background-repeat: no-repeat" ></div>
                                </div>
                                <div class="col-lg-9 col-sm-6">
                                    <h6 class="pointer" onclick="window.location.href='<?php echo "$link"; ?>/'"><?php echo pname($a['product_name']) ?></h6>
                                    <p><?php echo $a['description']; ?></p>
                                    <h5 class="text-success"><strong><span class="mdi mdi-approval mb-50"></span><?php echo mari($a['selling_price']); ?></strong></h5>
                                    <?php
                                    $key = str_shuffle("HOsodfnbnxcuiIUY89ehuiasvUSUasdjhASLJDSBDuhiwqduyVAKSHDUSKHSADVUSVADGUIUsdvkSADIHKHSADVKHVHSUADVHKASDBVKHSVDK").time();
                                    echo "<div class='input-group'>
                                    <div class='quantity'>
                                    <button class='minus-btn btns' value='-' type='button' name='button'>-
                                    </button>
                                        <input type='text' id='".str_replace('=', '', hide('e', $key))."'  min='1' value='1'  name='quantity'>
                                        <button class='plus-btn btns' value='-' type='button' name='button'>
                                        +
                                        </button>
                                        </div>
                                        <button type='button' title='Add to your Cart' id='$key' class='btns btn-secondary btn-sm' onclick='return add_to_basket(\"".hide('e',hide('e',  $a['id']))."\", \"".str_replace('=', '', hide('e', $key))."\")'><i class='mdi mdi-cart-outline'></i>Add To Cart</button>
                                    </div>"
                                     ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                    <?php
                    endwhile;
                        if ($total_pages> 1):
                            insertPaginations( "$home"."Mu3exb8o/?q=$search", $accent, $total_pages, $prev_next=false);
                    endif;
                    ?>
                </div>
                <div class="col-lg-4 col-sm-6 d-none d-lg-block">
                    <?php $main_cat = '%%';  ?>
                    <div class="shop-filters">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            All Categories</span>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body card-shop-filters">
                                        <?php
                                        $fg = r("SELECT * FROM `sub_categories` WHERE `main_cat` != '$main_cat'");
                                        while ($z = get($fg)) {
                                            $names = $z['name'];
                                            $l = $home.'categories/'.linker('o', $names).'/';
                                            echo "<div><a href='$l'>$names</a></div>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php foot(); script(); ?>
</body>
</html>
