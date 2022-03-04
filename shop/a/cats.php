<section class="top-category section-padding">
    <div class="container">
        <div class="owl-carousel owl-carousel-category">
            <?php
            $df = r("SELECT * FROM `sub_categories` WHERE `status` = 1");
            ?>
            <?php
            while ($a = get($df)):
                $img = $home."img/subc/".$a['image'];
                $name = $a['name'];
                $id = $a['id'];
            ?>
<div class='item'>
                <div class='category-item'>
                    <a href="<?php echo $home.'categories/'.linker('o', $name).'/';?>">
                        <img class='img-fluid' src='<?php echo "$img"; ?>'>
                        <h6><?php echo "$name"; ?></h6>
                        <?php
                        $z = get(r("SELECT COUNT(`id`) AS `sa` FROM `zvinhu` WHERE `sub_cat` = '$id' AND `status` = '1'"));
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
</section>
