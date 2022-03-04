<?php
if (!isset($db)) {
    include 'a/fun.php';
}
if (url() == $home.'sub.php.php') {
    http_response_code(404);
    $lost = 'file';
    include 'tysla_solutions_alt.php';
    exit;
}else {
    $a = get($g);

}


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>apise.shop | <?php echo $cat_name; ?></title>
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
                    <a href="<?php echo "$home"; ?>categories/">Categories</a>
                    <span class="mdi mdi-chevron-right"></span>
                    <a href="<?php echo "$home"; ?>categories/<?php echo str_replace(' ', '-', mb_strtolower($cat_name)); ?>/"><?php echo word($cat_name); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="shop-list section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row no-gutters">
                        <?php
                        $df = r("SELECT * FROM `sub_categories` WHERE `status` = 1 AND `main_cat`= '$id' ORDER BY `name`");
                        while ($a = get($df)):
                            $img = $home."img/subc/".$a['image'];
                            $name = $a['name'];
                            $id = $a['id'];
                            ?>
                            <div class='item col-lg-2 col-md-6' title="<?php echo word($name); ?>">
                                <div class='category-item'>
                                    <a href='<?php echo $home ?>categories/<?php echo linker('o', $name) ?>/'>
                                        <img class='img-fluid' src='<?php echo "$img"; ?>'>
                                        <h6><?php echo "$name"; ?></h6>
                                        <?php
                                        $z = get(r("SELECT COUNT(`id`) AS `sa` FROM `zvinhu` WHERE `sub_cat` = '$id' AND `status` = 1"));
                                        echo "<p>".$z['sa'];
                                        if ($z['sa'] == 1) {
                                            echo " item </p>";
                                        }else {
                                            echo " items </p>";
                                        }
                                        ?>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php foot();script(); ?>
</body>
</html>
