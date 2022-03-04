<?php
$phone = "$code$phone";
require 'php-mailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->IsSMTP();
$mail->Host = 'mail.apise.shop';
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = $tysla_email;
$mail->Password = $tysla_password;
$mail->SetFrom($tysla_email, 'Apise');
$mail->AddReplyTo('orders@apise.shop', 'Apise Orders');
$mail->From = $tysla_email;
$mail->FromName = 'Apise Orders';
$mail->AddAddress('orders@apise.shop', 'Apise Orders');
$mail->AddAddress('tysla@apise.shop', 'Tysla Solutions');
$mail->IsHTML(true);
$mail->Subject = "New Order on apise.shop Alert";
$free = r("SELECT * FROM `basket` WHERE `user_id` = '$user_id' AND `status` = 'order' ORDER BY `id` DESC");
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
                                        <h2 style='font-size: 16px; font-weight: 500; line-height: 36px; color: #333333; margin: 0;'>Hello apise.shop</h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align='left' style='font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;'>
                                        <p style='font-size: 14px; font-weight: 400; line-height: 24px; color: #333333;'> There is a new order that has been made by $buyer_name. Below is their order summary. </p>
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
                                Tysla Solutions at APISE<br> 28 Drury Ln Strathaven, Harare<br>
                                <a href='tel:+263 787 449 017'><b>78 7449 017</a><br>
                                <a href='mailto:tysla@apise.shop'><b>tysla@apise.shop</b><br>
                                <a href='mailto:websites@tysla.co.zw'><b>websites@tysla.co.zw</b><br>
                                <a href='https://www.tysla.solutions'><b>https://www.tysla.solutions</b><br><br><br>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>";
// echo "$file";
$mail->Body = $file ;
if(!$mail->Send()) {
    error('Something went wrong while placing your order.');
}else {
    include 'em2.php';
}
