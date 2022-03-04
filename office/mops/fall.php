<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'stock');
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | All $company_name's Stock"; ?> </title>
    <?php include '../heart/styles.php'; ?>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php include '../heart/main_nav.php'; ?>
        <div class="wrapper wrapper-content">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5><?php echo "All $company_name's Products"; ?></h5>
                            </div>
                            
                        </div>
                        <div class="table-responsive" id="oil">
                            <?php include 'tab_le.php'; ?>
                        </div>
                        <?php if (access($user_id, 'adjust_static')): ?>
                            <div class="modal fade"id='myModal' role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Update Product Details for <?php echo $company_name; ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Product Code</label>
                                                <input type="text" id="product_code" placeholder="Product Code" name='product_code' class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="text" placeholder="Product Name" name="product_name" id="product_name" class="typeahead_2 form-control" />
                                            </div>
                                            <?php if (access($user_id, 'buying_price')): ?>
                                                <div class="form-group">
                                                    <label>Buying Price</label>
                                                    <input type="text" placeholder="Buying Price" name="buying_price" id="buying_price" class="form-control" />
                                                </div>
                                            <?php endif; ?>
                                            <?php if (access($user_id, 'dis')): ?>
                                                <div class="form-group">
                                                    <label>Discount</label>
                                                    <input type="text" placeholder="Discount" name="discount" id="discount" class="form-control" />
                                                </div>
                                            <?php endif; ?>
                                            <?php if (access($user_id, 'selling_price')): ?>
                                                <div class="form-group">
                                                    <label>Selling Price</label>
                                                    <input type="text" placeholder="Selling Price" name="selling_price" id="selling_price" class="form-control" />
                                                </div>
                                            <?php endif; ?>
                                            <?php if (access($user_id, 'stock_quantity')): ?>
                                                <div class="form-group">
                                                    <label>On Hand</label>
                                                    <input type="text" placeholder="On Hand" name="on_hand" id="on_hand" class="form-control" />
                                                </div>
                                            <?php endif; ?>

                                            <div class="form-group"><label>Product Category</label> <input type="text" placeholder="Product Category"  id="category" name="product_category" class="typeahead_2 form-control" /></div>
                                        </div>
                                        <input type="hidden" class="form-control" id="user-id">
                                        <div class="modal-footer">
                                            <a id="save" class="btn btn-primary pull-right">Update</a>
                                            <button class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../heart/footer.php'; ?>
    </div>
    </div>
        <?php include '../heart/scripts.php'; ?>
        <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
        <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
        <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#category').typeahead({
                source: function (query, result) {
                    $.ajax({
                        items:20,
                        url: "category.php",
                        data: 'query=' + query,
                        dataType: "json",
                        type: "POST",
                        success: function (data) {
                            result($.map(data, function (item) {
                                return item;
                            }));
                        }
                    });
                }
            });
        });
    </script>
    <?php if (access($user_id, 'add_new_stock')): ?>
        <script type="text/javascript">
            function teal(){
                $.ajax({
                type: 'POST',
                url: 'add.php',
                data: $('#frmBox').serialize(),
                success:function(response){
                    $('#success').html(response);
                }
            });
            return false;
            }
        </script>
    <?php endif; ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', 'a[data-role=update]', function(){
                var id = $(this).data('id');
                var product_code = $('#'+id).children('td[data-target=product_code]').text();
                var product_name = $('#'+id).children('td[data-target=product_name]').text();
                var on_hand = $('#'+id).children('td[data-target=on_hand]').text();
                var category = $('#'+id).children('td[data-target=category]').text();
                var discount = $('#'+id).children('td[data-target=discount]').text();
                var buying_price = $('#'+id).children('td[data-target=buying_price]').text();
                var selling_price = $('#'+id).children('td[data-target=selling_price]').text();
                $('#product_code').val(product_code);
                $('#product_name').val(product_name);
                $('#on_hand').val(on_hand);
                $('#buying_price').val(buying_price);
                $('#selling_price').val(selling_price);
                $('#category').val(category);
                $('#discount').val(discount);
                $('#user-id').val(id);
                $('#myModal').modal('toggle');
            });
            $('#save').click(function(){
                var id = $('#user-id').val();
                var product_code = $('#product_code').val();
                var product_name = $('#product_name').val();
                var on_hand = $('#on_hand').val();
                var buying_price = $('#buying_price').val();
                var selling_price = $('#selling_price').val();
                var category =  $('#category').val();
                var discount =  $('#discount').val();
                $.ajax({
                    url: 'send.php',
                    method: 'post',
                    data: { id : id, product_code : product_code, product_name : product_name, on_hand : on_hand, buying_price : buying_price, selling_price : selling_price, category : category,  discount : discount},
                    success: function(response){
                        $('#oil').html(response);
                        $('#myModal').modal('toggle');
                    }
                });
            })
        });
    </script>
</body>
</html>
