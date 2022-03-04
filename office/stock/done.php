<?php
include '../heart/a.php';
secure('stock');
$mops = [];
$mo = [];
$worth = 0.00;
$co = 0;

if (!isset($_GET['finish']) || mysqli_num_rows(r("SELECT `id` FROM `zvinhu`")) != mysqli_num_rows(r("SELECT `id` FROM `stock_taking` WHERE `status` = 'in_cart'"))) {
    error("Bad practice has been detected.");
    $er = 20;
}elseif (!there('name')  || !there('pas')) {
    error("Bad practice has been detected.");
    $er = 20;
}else {
    $username = clean($_POST['name']);
    $pass = $_POST['pas'];
    if (empty($username)) {
        error("Submit your username." );
    }elseif (empty($pass)) {
        error("Submit your password.");
    }else {
        $get_user_details = r("SELECT * from `chikwata` WHERE `email` = '$username'");
        if (mysqli_num_rows($get_user_details) == 1) {
            $teal  = mysqli_fetch_array($get_user_details);
            $user_status = $teal['status'];
            $user_ids = $teal['id'];
            $trol = $teal['company_id'];
            $status_message = $teal['status_message'];
            $password = $teal['password'];
            if (!password_verify($pass, $password)) {
                error("Please verify your credentials");
            }elseif ($user_status !=  "ACTIVE") {
                error("$status_message");
            }else {
                if (mysqli_num_rows(r("SELECT `id` FROM `access_level` WHERE `user_id` = '$user_ids' and `stock` = 1")) ==1) {
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
                    // $now = now();
                    // $sale_id = generate_coupon().generate_coupon();
                    // r("INSERT INTO `cashout`(`user_id`, `date_of_co`, `managed_by`, `currency`, `rate`, `amount`, `status`, `code`) VALUES ('$user_id', '$now', '$user_ids', '1', '1.00', '$usd', 'done', '$sale_id')");
                    // r("INSERT INTO `cashout`(`user_id`, `date_of_co`, `managed_by`, `currency`, `rate`, `amount`, `status`, `code`) VALUES ('$user_id', '$now', '$user_ids', '2', '$bond_rate', '$bond', 'done', '$sale_id')");
                    // r("INSERT INTO `cashout`(`user_id`, `date_of_co`, `managed_by`, `currency`, `rate`, `amount`, `status`, `code`) VALUES ('$user_id', '$now', '$user_ids', '3', '$rtgs_rate', '$rtgs', 'done', '$sale_id')");
                    echo "<script type='text/javascript'>
                    $('#myModal2').modal('toggle');
                    setTimeout(function() {
                        toastr.options = {
                            'closeButton': true,
                            'debug': true,
                            'progressBar': true,
                            'preventDuplicates': false,
                            'positionClass': 'toast-top-center',
                            'onclick': null,
                            'showDuration': '3000',
                            'hideDuration': '1000',
                            'timeOut': '4000',
                            'extendedTimeOut': '1000',
                            'showEasing': 'swing',
                            'hideEasing': 'linear',
                            'showMethod': 'fadeIn',
                            'hideMethod': 'fadeOut'
                        };
                        toastr.success('The withdrawal was a success.');
                        window.setTimeout(function(){
                            window.location.href = './';
                        }, 3000);
                    }, 0);
                    </script>";
                }else {
                    error("You do not have the rights.");
                }
            }
        }else {
            error("Please verify your credentials");
        }
    }
}
