<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php //<meta name="description" content=" echo word("Buy all your $cat_name on");  www.apise.shop">?>
    <title><?php echo word("Buy $cat_name on"); ?> www.apise.shop</title>
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
                    <a href="<?php echo "$home"; ?>categories">Categories</a>
                    <span class="mdi mdi-chevron-right"></span> <a href="<?php echo $home.'categories/'. mb_strtolower(str_replace(' ', '-', $cat_name));?>/"><?php echo $cat_name?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="shop-list section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shop-head">
                        <center>
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
                        </center>
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
