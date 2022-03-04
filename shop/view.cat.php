<?php
include 'a/fun.php';
$url = url();
if (strpos($url, '/categories/') !== false && $url != $home.'categories/') {
    $cat_name = substr($url, strpos($url, 'categories/'));
    $cat_name = mb_strtoupper($cat_name);
    $cat_name = str_replace('CATEGORIES/', '', $cat_name);
    $cat_name = str_replace('/', '', $cat_name);
    $cat_name = linker('i', $cat_name);
    $name_cat = clean($cat_name);
    $d = r("SELECT * FROM `sub_categories` WHERE `name` = '$cat_name' OR `name` = '$name_cat'");
    $b = r("SELECT * FROM `categories` WHERE `name` = '$cat_name'");
    if (mysqli_num_rows($d) == 1) {
        $a = get($d);
        $id = $a['id'];
        $cat_name = $a['name'];
        $img = $home.'i/p/'.$a['image'];
        $category = pull('name', 'categories', "`id` = '".$a['main_cat']. "'");
        $clink = pull('id', 'categories', "`id` = '".$a['main_cat']. "'");
        $main_cat = $a['main_cat'];
    }elseif (mysqli_num_rows($b) == 1) {
        $a = get($b);
        $category_id = $a['id'];
        $id = $category_id;
        $g = r("SELECT * FROM `sub_categories` WHERE `main_cat` = '$category_id'");
        if (mysqli_num_rows($g) > 0) {
            include 'sub.php.php';
        }else {
            $cat_name = $a['name'];
            $totalPages = ceil(mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `sub_cat` = '$id' AND `status` = '1'"))/$items_per_page);
            include 'main_cat.php.php';
        }
        exit;
    }else {
        $lost = 'category/page';
        include 'tysla_solutions_alt.php';
        exit;
    }
}elseif ($url == $home.'categories/' ) {
    include 'df.php';
    exit;
}elseif (strpos($url, '/view.cat.php')) {
    $lost = 'category/page';
    include 'tysla_solutions_alt.php';
    exit;
}
$totalPages = ceil(mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `sub_cat` = '$id' AND `status` = '1'"))/$items_per_page);
$sub_cat = pull('name', 'sub_categories', "`id` = '$id'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php //<meta name="description" content=" echo word("Buy all your $cat_name on");  www.apise.shop">?>
    <title><?php echo word("Buy $cat_name on"); ?> www.apise.shop</title>
    <?php style(); ?>
    <style media="screen">
    @media screen and (prefers-reduced-motion: no-preference) {
        html {
            scroll-behavior: smooth;
        }
    }
    </style>
</head>
<body>
    <?php nav(); ?>
    <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo "$home"; ?>"><strong><span class="mdi mdi-home"></span> Home</strong></a>
                    <span class="mdi mdi-chevron-right"></span>
                    <a href="<?php echo "$home"; ?>categories/">Categories</a>
                    <span class="mdi mdi-chevron-right"></span>
                    <a href="<?php echo "$home"; ?>categories/<?php echo linker('o', $cat_name); ?>/"><?php echo word($cat_name); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="shop-list section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="shop-filters">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <?php echo pull('name', 'categories', "`id` = '$main_cat'"); ?> <span class="mdi mdi-chevron-down float-right"></span>
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body card-shop-filters">
                                        <?php
                                        $fg = r("SELECT * FROM `sub_categories` WHERE `main_cat` = '$main_cat'");
                                        while ($z = get($fg)) {
                                            $names = $z['name'];
                                            $l = $home.'categories/'.linker('o', $names).'/';
                                            if ($names == $sub_cat) {
                                                echo "<div><a href='$l'><strong class='text-dark'>$names</strong></a></div>";
                                            }else {
                                                echo "<div><a href='$l'>$names</a></div>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="shop-head">
                        <div class="btn-group mt-2">
                            <?php if (isset($_SESSION['order'])): ?>
                                <select class="form-control btn btn-dark">
                                    <option class="pointer" <?php if($_SESSION['order_tag'] == 'az'){echo 'selected';} ?> onclick="return order('az');">Name (A to Z)</option>
                                    <option class="pointer" <?php if($_SESSION['order_tag'] == 'za'){echo 'selected';} ?> onclick="return order('za');">Name (Z to A)</option>
                                    <option class="pointer" <?php if($_SESSION['order_tag'] == 'lh'){echo 'selected';} ?> onclick="return order('lh');">Price (Low to High)</option>
                                    <option class="pointer" <?php if($_SESSION['order_tag'] == 'hl'){echo 'selected';} ?> onclick="return order('hl');">Price (High to Low)</option>
                                </select>
                            <?php else: ?>
                                <select class="form-control btn btn-dark">
                                    <option class="pointer" onclick="return order('az');">Name (A to Z)</option>
                                    <option class="pointer" onclick="return order('za');">Name (Z to A)</option>
                                    <option class="pointer" onclick="return order('lh');">Price (Low to High)</option>
                                    <option class="pointer" onclick="return order('hl');">Price (High to Low)</option>
                                </select>
                            <?php endif; ?>
                        </div>
                        <h5 class="mb-3" style="color: transparent">.</h5>
                    </div>
                    <div class="row no-gutters" id="content"></div>
                    <nav>
                        <ul class="pagination justify-content-center mt-4">
                            <div id="pagination"></div>
                            <input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">
                            <input type="hidden" id="category_id" value="<?php echo hide('e', $id); ?>">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <?php foot(); script(); ?>
    <script src="<?php echo "$home"; ?>js/simple-bootstrap-paginator.js"></script>
    <script src="<?php echo "$home"; ?>pagination.js"></script>
    <script>
    function order(s){
        $.ajax({
            type: 'POST',
            url: '<?php echo "$home"; ?>o.html',
            data: {s:s},
            success: function(response) {
                $('#content').html(response);
            }
        });
    }
    </script>
</body>
</html>
