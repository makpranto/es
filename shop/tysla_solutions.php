<?php
include 'a/fun.php';
// $url = url();
// if (strpos($url, '/product/') !== false) {
//     $product_name = substr($url, strpos($url, 'product/'));
//     $product_name = mb_strtoupper($product_name);
//     $product_name = str_replace('PRODUCT/', '', $product_name);
//     $product_name = str_replace('/', '', $product_name);
//     $product_name = str_replace('-', ' ', $product_name);
//     $product_name = clean($product_name);
//     $d = r("SELECT * FROM `zvinhu` WHERE `product_name` = '$product_name'");
//     if (mysqli_num_rows($d) == 1) {
//         $a = get($d);
//         $id = $a['id'];
//         $product_name = $a['product_name'];
//         $description = $a['description'];
//         $brand = pull('name', 'brands', "`id` = '".$a['brand']. "'");
//         $product_price = $a['selling_price'];
//         $img = $home.'i/p/'.$a['image'];
//         $category = pull('name', 'main_categories', "`id` = '".$a['main_cat']. "'");
//         $clink = pull('id', 'main_categories', "`id` = '".$a['main_cat']. "'");
//         $pid = $a['main_cat'];
//         include 'view_product.php';
//         exit;
//     }
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>apise.shop - Page not found</title>
    <?php style(); ?>
</head>

<body>
    <?php nav(); ?>
    <section class="not-found-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center  pt-4 pb-5">
                    <h1>404</h1>
                    <h1>Sorry! Page not found.</h1>
                    <p class="land">Unfortunately the page you are looking for has been moved or deleted.</p>
                    <div class="mt-5">
                        <a href="<?php echo "$home"; ?>" class="btn btn-success btn-lg"><i class="mdi mdi-home"></i> GO TO HOME PAGE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php foot(); script(); ?>
</body>
</html>
