<?php
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'mail.apise.shop';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = $tysla_email;
$mail->Password = $tysla_password;
// $mail->SMTPSecure = 'tls';
$mail->SetFrom($tysla_email, 'Apise');
$mail->AddReplyTo('orders@apise.shop', 'Apise Orders');
$mail->From = 'tysla@apise.shop';
$mail->FromName = 'Apise Orders';
$mail->AddAddress($buyer_email, $buyer_name);
$mail->IsHTML(true);
$mail->Subject = "Order Placed Successfully on Apise";
$file = "<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <style type='text/css'>
    body,
    table,
    td,
    a {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    table,
    td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
    }
    img {
        -ms-interpolation-mode: bicubic;
    }
    img {
        border: 0;
        height: auto;
        line-height: 100%;
        outline: none;
        text-decoration: none;
    }

    table {
        border-collapse: collapse !important;
    }

    body {
        height: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
    }

    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    @media screen and (max-width: 480px) {
        .mobile-hide {
            display: none !important;
        }
        .mobile-center {
            text-align: center !important;
        }
    }
    div[style*='margin: 16px 0;'] {
        margin: 0 !important;
    }
</style>

<body style='margin: 0 !important; padding: 0 !important; background-color: #eeeeee;' bgcolor='#eeeeee'>

    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
        <tr>
            <td align='center' style='background-color: #eeeeee;' bgcolor='#eeeeee'>
                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:96%;'>
                    <tr>
                        <td align='center' valign='top' style='font-size:0; padding: 10px;' bgcolor='#eeeeee'>
                            <div style='display:inline-block; max-width:50%; min-width:100px; vertical-align:top; width:100%;'>
                            <img align='center' src='$logo' height='50' width='50'>
                                <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:300px;'>
                                    <tr>
                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 36px; font-weight: 600; line-height: 48px;' class='mobile-center'>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td align='left' style='padding: 10px 35px 20px 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                            <table align='left' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:100%;'>
                                <tr>
                                    <td  style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 500; line-height: 24px; padding-top: 25px;'>
                                        <h2 style='font-size: 16px; font-weight: 500; line-height: 36px; color: #333333; margin: 0;'>Hello $buyer_name</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;'>
                                        <p style='font-size: 14px; font-weight: 400; line-height: 24px; color: #333333;'>Thank you for placing your order on APISE. We have received it and will be in touch shortly. Should there be any changes or special requests pertaining to this order, use our various communication channels. Below is your order summary.<br><br> Regards.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' style='padding-top: 20px;'>
                                        <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                        <tr>
                                            <td width='50%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;'>Order #$order_id
                                        </td>
                                            <td width='50%' align='left' bgcolor='#eeeeee' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; '>  </td>
                                        </tr>
                                            ";
                                            $free = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order' ORDER BY `id` DESC");
                                            $yese = 0;
                                            while ($a = get($free)) {
                                                $total = 0;
                                                $p = $a['product_id'];
                                                $qty = $a['qty'];
                                                $price = pull('selling_price', 'zvinhu', "`id` = '$p'");
                                                $total += amount($qty*$price);
                                                $yese += $total;
                                                $product_name = pull('product_name', 'zvinhu', "`id` = '$p'");
                                                $total = amount($total);
                                                $file .= "
                                                <tr>
                                                    <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'> $product_name ($qty X $$price) </td>
                                                    <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'> $$total </td>
                                                </tr>
                                                ";
                                            }
                                            $total = amount($total);
                                            $dev = amount($delivery_rate*$yese);
                                            $yese += $dev;
                                            $yese = amount($yese);
                                            $file .= "
                                            <tr>
                                                <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'> Delivery Fee </td>
                                                <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;'> $$dev </td>
                                            </tr>";
                                            if (isset($_SESSION[$coupon_session])) {
                                                $cids = $_SESSION[$coupon_session];
                                                $a = get(r("SELECT * FROM `coupons` WHERE `id` = '$cids'"));
                                                $coupon = $a['coupon'];
                                                $m = $a['amount'];
                                                $file .= "
                                                <tr>
                                                    <td width='75%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 700; line-height: 24px; padding: 15px 10px 5px 10px;'> Coupon ($coupon) </td>
                                                    <td width='25%' align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 700; line-height: 24px; padding: 15px 10px 5px 10px;'> $$m </td>
                                                </tr>";

                                            }
                                            $file .= "
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' style='padding-top: 20px;'>
                                        <table cellspacing='0' cellpadding='0' border='0' width='100%'>
                                            <tr>
                                                <td width='75%' align='left'
                                                style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'>
                                                TOTAL </td>";
                                                if (isset($_SESSION[$coupon_session])) {
                                                    $cids = $_SESSION[$coupon_session];
                                                    $a = get(r("SELECT * FROM `coupons` WHERE `id` = '$cids'"));
                                                    $coupon =  $a['coupon'];
                                                    $m = $a['amount'];
                                                    $yese = $yese - $m;
                                                    if ($yese < 0) {
                                                        $yese = 0;
                                                    }
                                                    $yese = amount($yese);
                                                    $file .= "
                                                    <td width='25%' align='left'
                                                    style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'>
                                                    $$yese </td>";

                                                }else {
                                                    $file .= "
                                                    <td width='25%' align='left'
                                                    style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;'>
                                                    $$yese </td>";
                                                }
                                                $file .= "
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align='center' height='100%' valign='top' width='100%' style='padding: 0 35px 35px 35px; background-color: #ffffff;' bgcolor='#ffffff'>
                                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:660px;'>
                                    <tr>
                                        <td align='center' valign='top' style='font-size:0;'>
                                            <div style='display:inline-block; max-width:100%; min-width:100%; vertical-align:top; width:100%;'>
                                                <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='max-width:100%;'>
                                                    <tr>
                                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400;'>
                                                            <p style='font-weight: 800;'>Customer Name: <span style='font-weight:100;'> $buyer_name $buyer_surname </span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                            <p style='font-weight: 800;'>Delivery Address: <span style='font-weight:100;'> $street_address, $town</span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                            <p style='font-weight: 800;'>Phone: <span style='font-weight:100;'> $phone</span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                            <p style='font-weight: 800;'>Email: <span style='font-weight:100;'> $buyer_email</span></p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='left' valign='top' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;'>
                                                            <p style='font-weight: 800;'>Method of Payment: <span style='font-weight:100;'> $payment_method</span></p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </td>
                        </tr>
                        <tr>
                            <td colspan='2' style='font-size:14px;padding:10px 15px 0 15px;'>
                                Apise Orders Team<br> Room 2 Manson Court Selous Avenue, Harare Zimbabwe<br>
                                <b>Phone:</b> +263 778 016 700<br>
                                <b>Phone:</b> +263 712 545 860<br>
                                <b>Email:</b> <a href='mailto:orders@apise.shop'>orders@apise.shop</a><br><br><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>";
$mail->Body = $file ;
if(!$mail->Send()) {
    error('Order has not been placed.');
}else {
    $n = date('Y-m-d H:i:s');
    $sd = r("SELECT `id` FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order'");
    while ($z = get($sd)) {
        $id = $z['id'];
        $coupon =  isset($cids) ? $cids : '';
        r("UPDATE `basket` SET `status` = 'Order Received', `uid` = '$order_id', `time_of_insert` = '$n', `mop` = '$payment_method', `coupon` = '$coupon' WHERE `id` = '$id'");
    }
    if (isset($_SESSION[$coupon_session])) {
        r("UPDATE `coupons` SET `status` = 'USED', `used_on` ='$n', `customer_id` = '$user_id' WHERE `id` = '$cids'");
        unset($_SESSION[$coupon_session]);
    }
    echo "<script type='text/javascript'>
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
        toastr.success('Order has been placed, now redirecting to WhatsApp.');
        window.setTimeout(function(){
            window.location.href = 'https://api.whatsapp.com/send?phone=$whatsapp_number&text=Hello%20Apise%20My%20name%20is%20$buyer_name.%20I%20have%20an%20order%20with%20order%20number%20$order_id%20';
        }, 4000);
    }, 0);
    </script>";
}
?>
<script type="text/javascript">
cart();
</script>
