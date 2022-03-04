<?php
if (isset($_POST['login'])) {
    if (!isset($_POST['username']) || !isset($_POST['pass'])) {
        array_push($errors, "Bad practice detected.");
    }else {
        $username = clean($_POST['username']);
        $pass = $_POST['pass'];
        if (empty($username)) {
            array_push($errors, "Submit your username." );
        }elseif (empty($pass)) {
            array_push($errors, "Submit your password.");
        }else {
            $get_user_details =r("SELECT * from `chikwata` WHERE `email` = '$username'");
            if (mysqli_num_rows($get_user_details) == 1) {
                $teal  = mysqli_fetch_array($get_user_details);
                $user_status = $teal['status'];
                $user_id = $teal['id'];
                $trol = $teal['company_id'];
                $status_message = $teal['status_message'];
                $password = $teal['password'];
                if (!password_verify($pass, $password)) {
                    array_push($errors, "Please verify your credentials");
                }elseif ($user_status !=  "ACTIVE") {
                    array_push($errors, "$status_message");
                }else {
                    $_SESSION[$project_main_session_name] = $user_id;
                   r("DELETE FROM `basket` WHERE `user_id`='$user_id' AND `company_id`= '$trol'");
                   r("UPDATE `chikwata` SET `logins`= (`logins`+1) WHERE `id` = '$user_id'");
                   if (isset($_SESSION['url'])) {
                       header('location: '.$_SESSION['url']);
                       exit;
                   }
                }
            }else {
                array_push($errors, "Please verify your credentials");
            }
        }
    }
}

if (isset($_SESSION[$project_main_session_name])) {
    $this_mwedzi = date('Y-m');
    $user_id = $_SESSION[$project_main_session_name];
    $get_user_details = r("SELECT `company_name`, `password`, `vat`,`display_name`,`company_address`,`phone_number_1`, `min_markup`, `max_markup`,`phone_number_2`,`email_1`,`email_2`,`logo`, `base_currency`,
         `name`, `surname`, `company_id`  FROM `chikwata` JOIN `company_data` ON `company_data`.`id` = `chikwata`.`company_id` where `chikwata`.`id` = '$user_id'");
    while ($till1 = mysqli_fetch_array($get_user_details)) {
        $user_name = $till1['name'];
        $company_id = $till1['company_id'];
        $user_surnane = $till1['surname'];
        $company_name = $till1['display_name'];
        $company_address = $till1['company_address'];
        $company_phone_1 = $till1['phone_number_1'];
        $company_phone_2 = $till1['phone_number_2'];
        $company_email = $till1['email_1'];
        $user_password = $till1['password'];
        $base_currency = $till1['base_currency'];
        $min_markup = $till1['min_markup'];
        $max_markup = $till1['max_markup'];
        $vat = $till1['vat'];
    }
    include 'company_metrics.php';
    $bim = r("SELECT ((`selling_price` * `product_quantity`) - `discount`) AS `sales`,  `discount` FROM `sales` WHERE `user_id`= '$user_id' AND `company_id` = '$company_id' AND `time_of_sale` LIKE '$this_mwedzi%'");
    $total_discount = 0.00;
    $total_revenue = 0.00;
}
