<?php
include '../a/fun.php';
$totalPages = ceil(mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `status` = '1'"))/$items_per_page);
$d = get(r("SELECT COUNT(`id`) AS `d` FROM `zvinhu` WHERE `status` = 1"));
$count = $d['d'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>apise.shop | market</title>
    <?php style(); ?>
</head>
<body>
    <?php nav(); ?>
    <section class="pt-3 pb-3 page-info section-padding border-bottom bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="<?php echo "$home"; ?>"><strong><span class="mdi mdi-home"></span> Home</strong></a> <span class="mdi mdi-chevron-right"></span> <a href="./">All Products (<?php echo "$count"; ?>)</a>
                </div>
            </div>
        </div>
    </section>
    <section class="shop-list section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row no-gutters" id="content"></div>
                    <nav>
                        <ul class="pagination justify-content-center mt-4">
                            <div id="pagination"></div>
                            <input type="hidden" id="totalPages" value="<?php echo $totalPages; ?>">
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
        <?php foot();script(); ?>
        <script src="<?php echo "$home"; ?>js/simple-bootstrap-paginator.js"></script>
        <script>
        $(document).ready(function(){
            var totalPage = parseInt($('#totalPages').val());
            var n = '';
            var pag = $('#pagination').simplePaginator({
                totalPages: totalPage,
                maxButtonsVisible: 4,
                currentPage: 1,
                nextLabel: 'Next',
                prevLabel: 'Prev',
                firstLabel: 'First',
                lastLabel: 'Last',
                clickCurrentPage: true,
                pageChange: function(page) {
                    $.ajax({
                        url:'all.php',
                        method:'POST',
                        dataType: 'json',
                        data:{page:	page, n:n},
                        success:function(responseData){
                            $('#content').html(responseData.html);
                        }
                    });
                }
            });
        });
        </script>
    </body>
    </html>
