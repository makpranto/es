<section class="product-items-slider section-padding">
    <div class="container">
        <div class="section-header">
            <h5 class="heading-design-h5"><?php echo "$h"; ?>
                <a class="float-right text-secondary" href="all">View All</a>
            </h5>
        </div>
        <div class="owl-carousel owl-carousel-featured">
            <?php
            $as = r("SELECT * FROM `zvinhu` WHERE `status` = '1' ORDER BY RAND() LIMIT $num");
            while ($a = get($as)):
                show_grocery_item($a['id']);
            endwhile; ?>
        </div>
    </div>
</section>
