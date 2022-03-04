<?php
include '../heart/a.php';
secure('orders');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | All Customers"; ?> </title>
    <?php style(); ?>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-content">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Orders Total</th>
                                        <th>Declined</th>
                                        <th>Accepted</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 0;
                                    $db = mysqli_connect('localhost', 'apise_tysla_solutions', 'SPzGitZ1qidQ', 'apise_tysla_solutions');
                                    $as = $db->query("SELECT * FROM `customers`");
                                    while ($a = get($as)) {
                                        $phone = hide('d', $a['phone']);
                                        if (!empty($phone)) {
                                            $count++;
                                            $uid = $a['id'];
                                            echo "<tr>\n";
                                            echo "<td>".$count."</td> \n";
                                            $email = hide('d', $a['email_address']);
                                            echo "<td>".(hide('d', $a['name']).' '.hide('d', $a['surname']))."</td> \n";
                                            // // $cred = get(r("SELECT (SUM(`unit_price`)-SUM('discount')) AS `i` FROM `basket` WHERE `uid` = '$uid' AND `status` = 'Order Received'"));
                                            echo "<td><a href='mailto:$email'>$email</a></td> \n";
                                            echo "<td><a href='tel:$phone'>$phone</a></td> \n";
                                            echo "<td>";word(hide('d', $a['street_address']));echo "</td> \n";
                                            echo "<td>".hide('d', $a['town'])."</td> \n";
                                            $ad = r("SELECT `qty`, `discount`, `unit_price` FROM `basket` WHERE `uid` = '$uid' AND `status` = 'Order Received'");
                                            $amount = 0;
                                            while ($d = get($ad)) {
                                                $amount += ($d['qty'] * $d['unit_price']) - ($d['qty'] * $d['discount']);
                                            }
                                            echo "<td>$".amount($amount)."</td> \n";
                                            $ad = r("SELECT `qty`, `discount`, `unit_price` FROM `basket` WHERE `uid` = '$uid' AND `status` = 'Order Rejected'");
                                            $amount = 0;
                                            while ($d = get($ad)) {
                                                $amount += ($d['qty'] * $d['unit_price']) - ($d['qty'] * $d['discount']);
                                            }
                                            echo "<td>$".amount($amount)."</td> \n";
                                            $ad = r("SELECT `qty`, `discount`, `unit_price` FROM `basket` WHERE `uid` = '$uid' AND `status` = 'Order Accepted. Pending Delivery'");
                                            $amount = 0;
                                            while ($d = get($ad)) {
                                                $amount += ($d['qty'] * $d['unit_price']) - ($d['qty'] * $d['discount']);
                                            }
                                            echo "<td>$".amount($amount)."</td> \n";
                                            echo "</tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th>Orders Total</th>
                                        <th>Declined</th>
                                        <th>Accepted</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                </div>
                <?php foot(); ?>
            </div>
        </div>
    </div>
    <?php scripts(); ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
    <script type="text/javascript">
    $('.dataTables-example').DataTable({
        pageLength: 10,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            { extend: 'copy'},
            {extend: 'csv', title: '<?php echo "$company_name All Customers"; ?>'},
            {extend: 'excel', title: '<?php echo "$company_name All Customers"; ?>'},
            {extend: 'pdf', title: '<?php echo "$company_name All Customers"; ?>'},
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
</script>
</body>
</html>
