<?php
include 'a/fun.php';
$url = url();
if (isset($_GET['q'])) {
    $keyword = strval($_GET['q']);
	$keyword = clean($keyword);
	$search_param = "%{$keyword}%";
    $bn = "SELECT * FROM `zvinhu` WHERE (`description` LIKE '$search_param' OR `selling_price` LIKE '$search_param' OR `product_name` LIKE '$search_param') AND `status` = 1";
    $df = r($bn);
    if (mysqli_num_rows($df) == 1) {
        $a = get($df);
        $id = $a['id'];
        $product_name = $a['product_name'];
        $link = $home.'product/'.linker('o', $product_name);
        header("location: $link/");
    }elseif (mysqli_num_rows($df)>0) {
        $wild = $_GET['q'];
        include 'stray.php';
        exit;
    }else {
        $lost = 'product/pages';
        include 'not_.php';
        exit;
    }
}else {
    include 'a/fi.php';
    exit;
}
?>
