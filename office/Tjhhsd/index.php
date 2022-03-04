<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'stock_take');
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
                        <div id="oil">
                            <?php include 'stock_file.php'; ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../heart/footer.php'; ?>
    </div>
    <?php include '../heart/scripts.php'; ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#ps_category').typeahead({
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
        $(document).ready(function () {
            $('#p_category').typeahead({
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
    <script type="text/javascript">
        // function stock(test, value){
        //     alert(test + '=' + value);
        // }
    </script>
    <?php if (access($user_id, 'add_new_stock')): ?>
        <script type="text/javascript">
            function teal(){
                $.ajax({
                type: 'POST',
                url: 'add.php',
                data: $('#frmBox').serialize(),
                success:function(response){
                    $('#oil').html(response);
                    $('#myModal2').modal('toggle');
                }
            });
            return false;
            }
        </script>
    <?php endif; ?>
    <script>
           $(document).ready(function(){
               $('.dataTables-example').DataTable({
                   pageLength: 1000,
                   responsive: true,
                   dom: '<"html5buttons"B>lTfgitp',
                   buttons: [
                       { extend: 'copy'},
                       {extend: 'csv', title: '<?php echo "$company_name All Stock"; ?>'},
                       {extend: 'excel', title: '<?php echo "$company_name All Stock"; ?>'},
                       {extend: 'pdf', title: '<?php echo "$company_name All Stock"; ?>'},

                       {extend: 'print',
                        customize: function (win){
                               $(win.document.body).addClass('white-bg');
                               $(win.document.body).css('font-size', '10px');
                               $(win.document.body).find('table')
                                       .addClass('compact')
                                       .css('font-size', 'inherit');
                       }
                       }
                   ]

               });



           });

       </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', 'a[data-role=update]', function(){
                var id = $(this).data('id');
                var product_code = $('#'+id).children('td[data-target=product_code]').text();
                var product_name = $('#'+id).children('td[data-target=product_name]').text();
                var on_hand = $('#'+id).children('td[data-target=on_hand]').text();
                var p_category = $('#'+id).children('td[data-target=p_category]').text();
                var discount = $('#'+id).children('td[data-target=discount]').text();
                var buying_price = $('#'+id).children('td[data-target=buying_price]').text();
                var selling_price = $('#'+id).children('td[data-target=selling_price]').text();

                $('#product_code').val(product_code);
                $('#product_name').val(product_name);
                $('#on_hand').val(on_hand);
                $('#buying_price').val(buying_price);
                $('#selling_price').val(selling_price);
                $('#p_category').val(p_category);
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
                var p_category =  $('#p_category').val();
                var discount =  $('#discount').val();
                $.ajax({
                    url: 'send.php',
                    method: 'post',
                    data: { id : id, product_code : product_code, product_name : product_name, on_hand : on_hand, buying_price : buying_price, selling_price : selling_price, p_category : p_category,  discount : discount},
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
