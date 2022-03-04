<?php
secure('stock');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Finish Stock Take"; ?> </title>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <?php style(); ?>
    <?php scripts(); ?>
</head>
<body class="mini-navbar">
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox" id="ibox1">
                                    <div class="ibox-content">
                                        <div class="sk-spinner sk-spinner-wave">
                                            <div class="sk-rect1"></div>
                                            <div class="sk-rect2"></div>
                                            <div class="sk-rect3"></div>
                                            <div class="sk-rect4"></div>
                                            <div class="sk-rect5"></div>
                                        </div>
                                        <p id='life'></p>
                                        <center>
                                            <table class="table  mb-0">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Excess Items</th>
                                                        <th>Value</th>
                                                        <th>Missing Items</th>
                                                        <th>Value</th>
                                                        <th>Total</th>
                                                        <th>Reset</th>
                                                        <th>Finish</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php
                                                        $all = r("SELECT * FROM `stock_taking`");
                                                        $ex = 0;
                                                        $exv = 0;
                                                        $mi = 0;
                                                        $miv = 0;
                                                        while ($a = get($all)) {
                                                            $variance = $a['variance'];
                                                            if ($variance[0] == '-') {
                                                                $mi += str_replace('-', '', $variance);
                                                                if ($a['buying_price'] != 0) {
                                                                    $miv += $a['buying_price']*str_replace('-', '', $a['variance']);
                                                                }
                                                            }else {
                                                                $ex += str_replace('+', '', $variance);
                                                                if ($a['buying_price'] != 0) {
                                                                    $exv += $a['buying_price']*str_replace('+', '', $a['variance']);
                                                                }
                                                            }
                                                            $id = hide('e', $a['stock_id']);
                                                        }
                                                        echo "<td><b>$ex</b></td> \n";
                                                        echo "<td><b>$".mari($exv)."</b></td> \n";
                                                        echo "<td><b>$mi</b></td> \n";
                                                        echo "<td><b>$".mari($miv)."</b></td> \n";
                                                        echo "<td><b>$".mari($miv+$exv)."</b></td> \n";
                                                        echo "<td><button type='button' class='btn btn-danger btn-sm' onclick='return reset(\"$id\");'>Reset</button></td>";
                                                        echo "<td><button type='submit' class='btn btn-sm btn-primary' onclick='return finish();'>Save Changes</button></td>";

                                                    ?>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </center>
                                        <hr>
                                        <div class="table-responsive" id="oil">
                                            <?php include 'cartx.php'; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php foot(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
    <script>
    function m(){
        $.ajax({
            type: 'POST',
            url: 'm.php',
            success: function(response) {
                $('#magic').html(response);
            }
        });
    }
    function reset(file){
        $.ajax({
            type: 'POST',
            url: 'reset.php',
            data: {
                file: file
            },
            success: function(response) {
                if (response == 't') {
                    window.location.href='./';
                }else {
                    $('#life').html(response);
                }
            }
        });
    }
    function adjust(id, quantity) {
        m();
        var quant = document.getElementById(quantity).value;
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            type: 'POST',
            url: 'adjust.php',
            data: {
                id: id,
                quant: quant
            },
            success: function(response) {
                m();
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                $('#oil').html(response);
            }
        });
    }
    function finish() {
        $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
        $.ajax({
            type: 'POST',
            url: 'fin.php',
            data: $('#akunda').serialize(),
            success: function(response) {
                $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                $('#life').html(response);
            }
        });
    }

    </script>
    </script>
</body>
</html>
