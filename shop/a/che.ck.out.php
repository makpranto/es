<?php
include 'fun.php';
if ($total_cart< 0.01) {
    error('Your cart is currently empty. Add items to it first.');
}else {
    if (!there('name') || !there('surname') || !there('buyer_email') || !there('street_address') || !there('town') || !there('code')  || !there('payment_method') || !there('phone')) {
        error("Bad practice has been detected.");
    }else {
        $r = "INSERT INTO `sales`(`id`, `uid`, `date_of_sale`, `payment_method`, `customer_id`, `amount`, `order_status`) VALUES ()";
        $buyer_email = mb_strtolower($_POST['buyer_email']);
        $buyer_name = word(clean($_POST['name']));
        $buyer_surname = word(clean($_POST['surname']));
        $street_address = word(clean($_POST['street_address']));
        $town = word(clean($_POST['town']));
        $code = mb_strtolower(clean($_POST['code']));
        $payment_method = mb_strtolower(clean($_POST['payment_method']));
        $phone = clean($_POST['phone']);
        $phone = preg_replace('/\D/', '', $phone);
        $phone = strrev(substr($phone, -9));
        $phone = strrev($phone);
        $s = 0;
        if (empty($buyer_name)) {
            error("Please submit your name so that we will be able to identify you.");
            $s = 2;
        }elseif (!ls($buyer_name)) {
            error("Name should contain only letters and spaces.");
            $s = 2;
        }
        if (empty($buyer_surname)) {
            error("Surname cannot be empty.");
            $s = 2;
        }elseif (!ls($buyer_surname)) {
            error("Surname should contain only letters and spaces.");
            $s = 2;
        }
        if (empty($buyer_email)) {
            error("Please submit your email.");
            $s = 2;
        }elseif(!valid_email($buyer_email)) {
            error("Submit a valid email.");
            $s = 2;
        }
        if (empty($street_address)) {
            error("Please submit the delivery address.");
            $s = 2;
        }
        if (empty($town)) {
            error("You did not submit your town/city.");
            $s = 2;
        }
        if ($code != 'zw' AND $code != 'za') {
            cry(1);
            $s = 2;
        }elseif (empty($phone)) {
            error("Submit your phone number.");
            $s = 2;
        }elseif ($code == 'zw') {
            if (!zim($phone)) {
                error("The number your have submitted is not a valid Zimbabwean number.");
                $s = 2;
            }
        }elseif ($code == 'za') {
            if (strlen($phone) != 9 || ($phone[0] != 6 && $phone[0] != 7 && $phone[0] != 8) || ($phone[0] == 6 && $phone[1] == 0 && ($phone[2]<3))) {
                error("The number your have submitted is not a valid South African number.");
                $s = 2;
            }
        }
        if ($payment_method == 'payment') {
            error("Select the payment method.");
            $s = 2;
        }elseif ($payment_method != 'cash' AND $payment_method != 'transfer') {
            cry(2);
            $s = 2;
        }
        if ($s == 0) {
            if ($code == 'zw') {
                $code = '+263';
            }elseif ($code == 'za') {
                $code = '+27';
            }
            $rand = str_shuffle('OIDFJ7R87SDFBJ83Y9DSHKWVEASI48DSAF1356687DS987SD7FDF5SKMFGKE63267SYITVJSDBVZXCJI6367WE685QWJGKDSDVCXTWQ6276S97921521354682930GNZcVMXCXLSASPIYEUYWQTRYA1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');
            $first_code = substr($rand, 0, (3));
            $order_id = mb_strtoupper($first_code).time().$user_id;
            $order_id = chunk_split($order_id, 4, ' ');
            $buyer_name = hide('e', $buyer_name);
            $buyer_surname = hide('e', $buyer_surname);
            $street_address = hide('e', $street_address);
            $buyer_email = hide('e', $buyer_email);
            $town = hide('e', $town);
            $full_phone = hide('e', "$code$phone");
            $df = "UPDATE `customers` SET `name` = '$buyer_name',`surname`= '$buyer_surname',`street_address`='$street_address',`email_address` ='$buyer_email',`phone` = '$full_phone',`town` = '$town' WHERE `id` = '$user_id'";
            r($df);
            $buyer_name = hide('d', $buyer_name);
            $buyer_surname = hide('d', $buyer_surname);
            $buyer_email = hide('d', $buyer_email);
            $street_address = hide('d', $street_address);
            $town = hide('d', $town);
            $payment_method = ucwords($payment_method);
            include 'em.php';
        }
    }
}
