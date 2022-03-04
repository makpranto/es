
<section class="product-items-slider section-padding">
    <?php
    $as = r("SELECT * FROM `sub_categories` WHERE `status` = '1' ORDER BY RAND() LIMIT 1");
    $a = get($as);
    $cat_id = $a['id'];
    $dr = r("SELECT `id` FROM `zvinhu` WHERE `status` = '1' AND `sub_cat` = '$cat_id'");
    while (mysqli_num_rows($dr) < 1) {
        $as = r("SELECT * FROM `sub_categories` WHERE `status` = '1' ORDER BY RAND() LIMIT 1");
        $a = get($as);
        $cat_id = $a['id'];
        $dr = r("SELECT `id` FROM `zvinhu` WHERE `status` = '1' AND `sub_cat` = '$cat_id'");
    }
    $cat_name = $a['name'];
    global $home;
    ?>
    <div class="container">
        <div class="section-header">
            <h5 class="heading-design-h5"><?php echo word($cat_name); ?>
                <a class="float-right text-secondary" href="<?php echo $home.'categories/'.linker('o', $cat_name).'/';?>">View All</a>
            </h5>
        </div>
        <div class="owl-carousel owl-carousel-featured">
            <?php
            $as = r("SELECT * FROM `zvinhu` WHERE `status` = '1' AND `sub_cat` = '$cat_id' ORDER BY RAND() LIMIT 20");
            while ($a = get($as)):
                show_grocery_item($a['id']);
            endwhile; ?>
        </div>
    </div>
</section>
