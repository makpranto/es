<?php
include '../heart/a.php';
secure('start_order');
$valid_emails = [];
$rtgs = $usd = 0;
if (!there('email')) {
    error("Bad practice has been detected.");
}else {
    $email = mb_strtolower(clean($_POST['email']));
    $v = explode(',',$email);
    $v = array_unique($v);
    foreach ($v as $em) {
        $em = mb_strtolower(clean($em));
        if (empty($em)) {
            $blue = 'pre';
            error("Check all the emails you submitted.");
        }elseif (!valid_email($em)) {
            $blue = 'pre';
            error("$em is not a valid address.");
        }else {
            $valid_emails[] = $em;
        }
    }
    $valid_emails = array_unique($valid_emails);
    if (count($valid_emails) == 0) {
        error("Submit at least one email.");
    }elseif (!there('1') && !there('2')) {
        error("Select the currency for this quotattion");
    }else {
        if (isset($_POST['1']) && !isset($_POST['2'])) {
            $mops = [1];
        }elseif (isset($_POST['1']) && isset($_POST['2'])) {
            $mops = [1, 2];
        }else {
            $mops = [2];
        }
        if (!isset($_SESSION['enfield_customer_session_name'])) {
            error("Bad practice has been detected.");
        }else {
            $fg = $_SESSION['enfield_customer_session_name'];
            $sale_id = mb_strtoupper($fg);
            $customer_id = pull('customer_id', 'basket', "`price_check_id`= '$fg'");
            $customer_name = pull("full_name", 'walk_in_clients', "`id` = '$customer_id'");
            $customer_phone = pull("phone", 'walk_in_clients', "`id` = '$customer_id'");
            $customer_email = pull("email", 'walk_in_clients', "`id` = '$customer_id'");
            $receiver = mb_strtolower(clean($_POST['email']));
            $now = date('Y-m-d H:i:s');
            require('../ddffgg/fpdf_protection.php');
            $get_basket = r("SELECT * FROM `basket` WHERE `status` = 'quotation_approved' AND `price_check_id` = '$fg'");
            if (mysqli_num_rows($get_basket)>0) {
                foreach ($mops as $m) {
                    if ($m == 1) {
                        $rtgs = 1;
                        $currency = "RTGS";
                        $pdf = new FPDF_Protection();
                        $pdf->SetProtection(array('print'), '', '7805327323#Pass');
                        $pdf->AliasNbPages();
                        $pdf->AddPage();
                        $pdf->SetTextColor(51,102,255);
                        $pdf->SetFont('Arial','B',14);
                        $pdf->SetMargins(25,5);
                        $pq1=0;$count =0;$all_disc =0;
                        $fopin = date('Y-F-d')."-$sale_id".time();
                        $ese = 0;
                        $pdf->SetTextColor(0,0,0);
                        $pdf->SetFont('Arial','',7);
                        while ($it = get($get_basket)) {
                            $product_id = $it['product_id'];
                            $product_name = pull('product_name', 'zvinhu', "`id` = '$product_id'");
                            $uom = pull('uom', 'zvinhu', "`id` = '$product_id'");
                            $selling_price = amount($it['selling_price']);
                            $buying_price = $it['buying_price'];
                            $product_quantity = $it['qty'];
                            $ese += $product_quantity;
                            $uom = pull('name', 'uom', "`id` = '$uom'");
                            $product_id= $it['product_id'];
                            $id = $it['id'];
                            $disco = 0;
                            $pdf->SetCol(0);
                            if(strlen($product_name)> 28){
                                $product = str_split($product_name, 40);
                                foreach($product as $pt){
                                    if($pt == end($product)){
                                        $pdf->Cell(80,0,"$pt",0,0);
                                        $pdf->Ln(1);
                                    }else{
                                        $pdf->Cell(80,0,"$pt",0,0);
                                        $pdf->Ln(5);
                                    }
                                }
                            }else{
                                $pdf->Cell(80,0,"$product_name",0,0);
                            }
                            $pdf->SetCol(1.55);
                            $pdf->Cell(80,0,"$uom",0,0);
                            $pdf->SetCol(2);
                            $pdf->Cell(80,0,"$product_quantity",0,0);
                            $pdf->SetCol(2.4);
                            $pdf->Cell(250,0, mari($selling_price),0,0);
                            $pdf->SetCol(3);
                            $selling_price = str_pad($selling_price, 11,' ', STR_PAD_LEFT);
                            $pdf->Cell( 0, -1, mari(($selling_price*$product_quantity)-$disco), 0, 0, 'R' );

                            if (access($user_id, 'discount')) {
                                $pdf->SetCol(2.9);
                                $pdf->Cell(250,0,amount($disco),0,0);
                            }
                            $pq1 = $pq1+($selling_price*$product_quantity);
                            $count = $count+$product_quantity;
                            $all_disc = $all_disc+$disco;
                            if(isset($agent_name) && $agent_name != ""){
                                $profit = amount((($selling_price - $buying_price ) * $product_quantity) - $disco);
                                $commision = amount($profit*$company_commission);
                            }else{
                                $agent_ = 'x';
                                $profit = ($selling_price- $buying_price - ($disco/$product_quantity)) * $product_quantity;
                                $commision = '0.00';
                            }
                            $profit = amount($profit);
                            $tos = date('Y-m-d H:i:s');
                            $pdf->Ln(5);
                        }
                        $pdf->Ln(6);
                        $pdf->SetFont('Arial','',8);
                        $pdf->SetCol(0);
                        $pdf->Cell(191,0.1,"",0,1,'L',1);
                        $pdf->Ln(4);
                        $pdf->Cell(250,0,"Sub Total",0,0);
                        if (access($user_id, 'discount')) {
                            $pdf->SetCol(2.9);
                            $pdf->Cell(250,0,amount($all_disc),0,0);
                        }
                        $pdf->SetCol(2);
                        $pdf->Cell(80,0,"$ese",0,0);
                        $pdf->SetCol(3);
                        $pdf->Cell( 0, -1, mari($pq1-$all_disc), 0, 0, 'R' );
                        $pdf->SetCol(0);
                        $pdf->Ln(4);
                        $pdf->Cell(250,0,"Vat",0,0);
                        $pdf->SetCol(2);
                        $pdf->Cell(80,0,"$vat%",0,0);
                        $pdf->SetCol(3);
                        $pdf->Cell( 0, -1, mari(($pq1-$all_disc)*($vat/100)), 0, 0, 'R' );
                        $pdf->Ln(6);
                        $pdf->SetCol(0);
                        $pdf->SetFont('Arial','B',9);
                        $pdf->Cell(250,0,"Total VAT INCL",0,0);
                        $pdf->SetCol(0);
                        $pdf->SetCol(3);
                        $pdf->Cell( 0, -1, mari(($pq1-$all_disc)*(1+($vat/100))), 0, 0, 'R' );
                        $pdf->Ln(5);
                        $pdf->SetCol(0);
                        $pdf->Cell(191,1,"",0,1,'L',1);
                        $pdf->Ln(30);
                        $pdf->SetFont( 'Arial', 'BU',9 );
                        $pdf->SetTextColor(0,0,0);
                        $pdf->SetY(-50.5);
                        $pdf->Cell(20,.5,"Bank Details",0,0);
                        $pdf->SetFont( 'Arial', '',8.5);
                        $pdf->Ln(5);
                        $pdf->Cell(20,.5,"BANK:                            STANDARD CHARTERED",0,0);
                        $pdf->Cell(0,.5,"BANK:                                                               CABS",0,0, 'R');
                        $pdf->Ln(5);
                        $pdf->Cell(20,.5,"Account Name:              Enfield Zimbabwe(PVT)LTD",0,0);
                        $pdf->Cell(0,.5,"Account Name:              Enfield Zimbabwe(PVT)LTD",0,0, 'R');
                        $pdf->Ln(5);
                        $pdf->Cell(20,.5,"ACC No:                         0100218886600",0,0);
                        $pdf->Cell(0,.5,"ACC No:                                                 1002766842",0,0, 'R');
                        $pdf->Ln(5);
                        $pdf->Cell(20,.5,"BRANCH:                       SOUTHERTON",0,0);
                        $pdf->Cell(0,.5,"BRANCH:                                  CENTRAL AVENUE",0,0, 'R');
                        $pdf->SetY(-22.5);
                        $pdf->SetFont( 'Arial', '',7 );
                        $pdf->SetTextColor(255,0,0);
                        $pdf->Cell(20,.5,"Comments or Special Instrunctions: Delivery ex-stock subject to prior sale. Prices are subject to change without notice. Valid for 24hours!",0,0);
                        $filename = "../storage/quotations-out/$fopin.pdf";
                        $pdf->Output($filename,'F');
                        $files[] = $filename;
                    }else {
                        $usd = 1;
                        $currency = "USD";
                        $pdf = new FPDF_Protection();
                        $pdf->SetProtection(array('print'), '', '7805327323#Pass');
                        $pdf->AliasNbPages();
                        $pdf->AddPage();
                        $pdf->SetTextColor(51,102,255);
                        $pdf->SetFont('Arial','B',14);
                        $pdf->SetMargins(25,5);
                        $pq1=0;$count =0;$all_disc =0;
                        $get_basket = r("SELECT * FROM `basket` WHERE `status` = 'quotation_approved' AND `price_check_id` = '$fg'");
                        $fopin = date('Y-F-d')."--$sale_id".time();
                        $ese = 0;
                        $pdf->SetTextColor(0,0,0);
                        $pdf->SetFont('Arial','',7);
                        while ($it = get($get_basket)) {
                            $product_id = $it['product_id'];
                            $product_name = pull('product_name', 'zvinhu', "`id` = '$product_id'");
                            $uom = pull('uom', 'zvinhu', "`id` = '$product_id'");
                            $selling_price = amount($it['selling_price']*pull('rate', 'payment_methods', "`id` = '1'"));
                            $buying_price = $it['buying_price'];
                            $product_quantity = $it['qty'];
                            $ese += $product_quantity;
                            $uom = pull('name', 'uom', "`id` = '$uom'");
                            $product_id= $it['product_id'];
                            $id = $it['id'];
                            $disco = 0;
                            $pdf->SetCol(0);
                            if(strlen($product_name)> 28){
                                $product = str_split($product_name, 40);
                                foreach($product as $pt){
                                    if($pt == end($product)){
                                        $pdf->Cell(80,0,"$pt",0,0);
                                        $pdf->Ln(1);
                                    }else{
                                        $pdf->Cell(80,0,"$pt",0,0);
                                        $pdf->Ln(5);
                                    }
                                }
                            }else{
                                $pdf->Cell(80,0,"$product_name",0,0);
                            }
                            $pdf->SetCol(1.55);
                            $pdf->Cell(80,0,"$uom",0,0);
                            $pdf->SetCol(2);
                            $pdf->Cell(80,0,"$product_quantity",0,0);
                            $pdf->SetCol(2.4);
                            $pdf->Cell(250,0, mari($selling_price),0,0);
                            $pdf->SetCol(3);
                            $selling_price = str_pad($selling_price, 11,' ', STR_PAD_LEFT);
                            $pdf->Cell( 0, -1, mari(($selling_price*$product_quantity)-$disco), 0, 0, 'R' );

                            if (access($user_id, 'discount')) {
                                $pdf->SetCol(2.9);
                                $pdf->Cell(250,0,amount($disco),0,0);
                            }
                            $pq1 = $pq1+($selling_price*$product_quantity);
                            $count = $count+$product_quantity;
                            $all_disc = $all_disc+$disco;
                            if(isset($agent_name) && $agent_name != ""){
                                $profit = amount((($selling_price - $buying_price ) * $product_quantity) - $disco);
                                $commision = amount($profit*$company_commission);
                            }else{
                                $agent_ = 'x';
                                $profit = ($selling_price- $buying_price - ($disco/$product_quantity)) * $product_quantity;
                                $commision = '0.00';
                            }
                            $profit = amount($profit);
                            $tos = date('Y-m-d H:i:s');
                            $pdf->Ln(5);
                        }
                        $pdf->Ln(6);
                        $pdf->SetFont('Arial','',8);
                        $pdf->SetCol(0);
                        $pdf->Cell(191,0.1,"",0,1,'L',1);
                        $pdf->Ln(4);
                        $pdf->Cell(250,0,"Sub Total",0,0);
                        if (access($user_id, 'discount')) {
                            $pdf->SetCol(2.9);
                            $pdf->Cell(250,0,amount($all_disc),0,0);
                        }
                        $pdf->SetCol(2);
                        $pdf->Cell(80,0,"$ese",0,0);
                        $pdf->SetCol(3);
                        $pdf->Cell( 0, -1, mari($pq1-$all_disc), 0, 0, 'R' );
                        $pdf->SetCol(0);
                        $pdf->Ln(4);
                        $pdf->Cell(250,0,"Vat",0,0);
                        $pdf->SetCol(2);
                        $pdf->Cell(80,0,"$vat%",0,0);
                        $pdf->SetCol(3);
                        $pdf->Cell( 0, -1, mari(($pq1-$all_disc)*($vat/100)), 0, 0, 'R' );
                        $pdf->Ln(6);
                        $pdf->SetCol(0);
                        $pdf->SetFont('Arial','B',9);
                        $pdf->Cell(250,0,"Total VAT INCL",0,0);
                        $pdf->SetCol(0);
                        $pdf->SetCol(3);
                        $pdf->Cell( 0, -1, mari(($pq1-$all_disc)*(1+($vat/100))), 0, 0, 'R' );
                        $pdf->Ln(5);
                        $pdf->SetCol(0);
                        $pdf->Cell(191,1,"",0,1,'L',1);
                        $pdf->Ln(30);
                        $pdf->SetFont( 'Arial', 'BU',9 );
                        $pdf->SetTextColor(0,0,0);
                        $pdf->SetY(-50.5);
                        $pdf->Cell(20,.5,"Bank Details",0,0);
                        $pdf->SetFont( 'Arial', '',8.5);
                        $pdf->Ln(5);
                        $pdf->Cell(20,.5,"BANK:                            STANDARD CHARTERED",0,0);
                        $pdf->Cell(0,.5,"BANK:                                                               CABS",0,0, 'R');
                        $pdf->Ln(5);
                        $pdf->Cell(20,.5,"Account Name:              Enfield Zimbabwe(PVT)LTD",0,0);
                        $pdf->Cell(0,.5,"Account Name:              Enfield Zimbabwe(PVT)LTD",0,0, 'R');
                        $pdf->Ln(5);
                        $pdf->Cell(20,.5,"ACC No:                         0100218886600",0,0);
                        $pdf->Cell(0,.5,"ACC No:                                                 1002766842",0,0, 'R');
                        $pdf->Ln(5);
                        $pdf->Cell(20,.5,"BRANCH:                       SOUTHERTON",0,0);
                        $pdf->Cell(0,.5,"BRANCH:                                  CENTRAL AVENUE",0,0, 'R');
                        $pdf->SetY(-22.5);
                        $pdf->SetFont( 'Arial', '',7 );
                        $pdf->SetTextColor(255,0,0);
                        $pdf->Cell(20,.5,"Comments or Special Instrunctions: Delivery ex-stock subject to prior sale. Prices are subject to change without notice. Valid for 24hours!",0,0);
                        $filename = "../storage/quotations-out/$fopin.pdf";
                        $pdf->Output($filename,'F');
                        $files[] = $filename;
                    }
                }

                require '../heart/php-mailer/PHPMailerAutoload.php';
                $mail = new PHPMailer;
                $mail->IsSMTP();
                $mail->Host = 'mail.apise.shop';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'tysla@apise.shop';
                $mail->Password = '#Pass123!';
                $mail->SetFrom('tysla@apise.shop', 'Apise');
                $mail->AddReplyTo('sales@enfield.co.zw', 'Enfield Sales');
                $mail->From = 'tysla@apise.shop';
                $mail->FromName = 'Enfield Sales';
                foreach ($valid_emails as $milk) {
                    $mail->AddAddress($milk);
                }
                $mail->IsHTML(true);
                $mail->Subject = "Invoice from Enfield Zimbabwe";
                foreach ($files as $x) {
                    $mail->addAttachment($x, "Enfield Invoice for $customer_name - "generate_coupon().".pdf");
                }
                if (count($files)> 1) {
                    $p = "two quotations (RTGS & USD)";
                }else {
                    $p = "quotation";
                }
                $mail->Body = "<!DOCTYPE html> <html xmlns='http://www.w3.org/1999/xhtml'>
                <head>
                <meta name='viewport' content='width=device-width' />
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                </head>
                <body>
                <table class='body-wrap'>
                <style media='screen'>
                * {
                    margin: 0;
                    padding: 0;
                    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                    box-sizing: border-box;
                    font-size: 14px;
                }
                img {
                    max-width: 100%;
                }
                body {
                    -webkit-font-smoothing: antialiased;
                    -webkit-text-size-adjust: none;
                    width: 100% !important;
                    height: 100%;
                    line-height: 1.6;
                }
                table td {
                    vertical-align: top;
                }
                body {
                    background-color: #f6f6f6;
                }
                .body-wrap {
                    background-color: #f6f6f6;
                    width: 100%;
                }
                .container {
                    display: block !important;
                    max-width: 600px !important;
                    margin: 0 auto !important;
                    /* makes it centered */
                    clear: both !important;
                }
                .content {
                    max-width: 600px;
                    margin: 0 auto;
                    display: block;
                    padding: 20px;
                }
                .main {
                    background: #fff;
                    border: 1px solid #e9e9e9;
                    border-radius: 3px;
                }
                .content-wrap {
                    padding: 20px;
                }
                .content-block {
                    padding: 0 0 20px;
                }
                .header {
                    width: 100%;
                    margin-bottom: 20px;
                }
                .footer {
                    width: 100%;
                    clear: both;
                    color: #999;
                    padding: 20px;
                }
                .footer a {
                    color: #999;
                }
                .footer p, .footer a, .footer unsubscribe, .footer td {
                    font-size: 12px;
                }

                h1, h2, h3 {
                    font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
                    color: #000;
                    margin: 40px 0 0;
                    line-height: 1.2;
                    font-weight: 400;
                }

                h1 {
                    font-size: 32px;
                    font-weight: 500;
                }

                h2 {
                    font-size: 24px;
                }

                h3 {
                    font-size: 18px;
                }

                h4 {
                    font-size: 14px;
                    font-weight: 600;
                }

                p, ul, ol {
                    margin-bottom: 10px;
                    font-weight: normal;
                }
                p li, ul li, ol li {
                    margin-left: 5px;
                    list-style-position: inside;
                }

                a {
                    color: #1ab394;
                    text-decoration: underline;
                }

                .btn-primary {
                    text-decoration: none;
                    color: #FFF;
                    background-color: #1ab394;
                    border: solid #1ab394;
                    border-width: 5px 10px;
                    line-height: 2;
                    font-weight: bold;
                    text-align: center;
                    cursor: pointer;
                    display: inline-block;
                    border-radius: 5px;
                    text-transform: capitalize;
                }

                .last {
                    margin-bottom: 0;
                }

                .first {
                    margin-top: 0;
                }

                .aligncenter {
                    text-align: center;
                }

                .alignright {
                    text-align: right;
                }

                .alignleft {
                    text-align: left;
                }

                .clear {
                    clear: both;
                }

                .alert {
                    font-size: 16px;
                    color: #fff;
                    font-weight: 500;
                    padding: 20px;
                    text-align: center;
                    border-radius: 3px 3px 0 0;
                }
                .alert a {
                    color: #fff;
                    text-decoration: none;
                    font-weight: 500;
                    font-size: 16px;
                }
                .alert.alert-warning {
                    background: #f8ac59;
                }
                .alert.alert-bad {
                    background: #ed5565;
                }
                .alert.alert-good {
                    background: #1ab394;
                }

                .invoice {
                    margin: 40px auto;
                    text-align: left;
                    width: 80%;
                }
                .invoice td {
                    padding: 5px 0;
                }
                .invoice .invoice-items {
                    width: 100%;
                }
                .invoice .invoice-items td {
                    border-top: #eee 1px solid;
                }
                .invoice .invoice-items .total td {
                    border-top: 2px solid #333;
                    border-bottom: 2px solid #333;
                    font-weight: 700;
                }

                @media only screen and (max-width: 640px) {
                    h1, h2, h3, h4 {
                        font-weight: 600 !important;
                        margin: 20px 0 5px !important;
                    }

                    h1 {
                        font-size: 22px !important;
                    }

                    h2 {
                        font-size: 18px !important;
                    }

                    h3 {
                        font-size: 16px !important;
                    }

                    .container {
                        width: 100% !important;
                    }

                    .content, .content-wrap {
                        padding: 10px !important;
                    }

                    .invoice {
                        width: 100% !important;
                    }
                }
                </style>
                <tr>
                <td class='container' width='600'>
                <div class='content'>
                <table class='main' width='100%' cellpadding='0' cellspacing='0'>
                <tr>
                <td class='content-wrap'>
                <table  cellpadding='0' cellspacing='0'>
                <tr>
                <td class='content-block'>
                <h3>Dear $customer_name.</h3>
                </td>
                </tr>
                <tr>
                <td class='content-block'>
                <p style='Margin-top: 0;Margin-bottom: 20px;'>We have attached your $p on this email and we look forward to hearing from you soon. Please note that the prices and availability are subject to change.</p>
                <p style='Margin-top: 0;Margin-bottom: 20px;'>Should you have any questions, do get in touch with us using the details below or by replying to this email.</p>
                </td>

                </tr>
                </table>

                </td>
                </tr>
                </table>
                <div class='footer'>
                <table width='100%'>
                <tr>
                <td><div class='column js-footer-additional-info' style='text-align: right;font-size: 12px;line-height: 19px;color: #999;font-family: sans-serif;width: 526px;' dir='ltr'>
                <div style='margin-left: 0;margin-right: 0;Margin-top: 10px;Margin-bottom: 10px;'>
                <div class='email-footer__additional-info' style='font-size: 12px;line-height: 19px;margin-bottom: 3px;margin-top: 0px;'>
                <div bind-to='address'>
                <p class='email-flexible-footer__additionalinfo--center' style='Margin-top: 0;Margin-bottom: 0;'>Enfield Zimbabwe Pvt. Ltd.</p>
                </div>
                </div>
                <div class='email-footer__additional-info' style='font-size: 12px;line-height: 19px;margin-bottom: 3px;margin-top: 0px;'>
                <div>
                <p class='email-flexible-footer__additionalinfo--center' style='Margin-top: 0;Margin-bottom: 0;'>Corner Hobbs & Plymouth</p>
                </div>
                </div>
                <div class='email-footer__additional-info' style='font-size: 12px;line-height: 19px;margin-bottom: 3px;'>
                <div bind-to='permission'>
                <p class='email-flexible-footer__additionalinfo--center' style='Margin-top: 0;Margin-bottom: 0;'></p>
                </div>
                </div>
                <div class='email-footer__additional-info' style='font-size: 12px;line-height: 19px;margin-bottom: 15px;'>
                <span>
                <preferences style='text-decoration: underline;' lang='en'> +263 8644 058 116 </preferences>&nbsp;&nbsp;|&nbsp;&nbsp;
                </span>
                <unsubscribe style='text-decoration: underline;'><a href='mailto:sales@enfield.co.zw'>sales@enfield.co.zw</a> </unsubscribe>
                </div>
                </div>
                </div>
                </td>
                </tr>
                </table>

                </div></div>
                </td>
                <td></td>
                </tr>
                </table>
                </body>
                </html>";
                $gb = r("SELECT * FROM `basket` WHERE `status` = 'quotation_approved' AND `price_check_id` = '$fg'");
                $now = now();
                if($mail->Send()) {
                    while ($a = get($gb)) {
                        $id = $a['id'];
                        r("UPDATE `basket` SET `status` = 'active_quotation', `sent_at` = '$now', `usd` = '$usd', `rtgs` = '$rtgs' WHERE `id` = '$id'");
                    }
                    r_success("The quotation has been sent successfully.", './', '4000');
                }else {
                    error("Something went wrong.");
                }
            }else {
                error("Bad practice has been detected.");
            }
        }
    }
}
include 'tab_le.php';
scripts(); ?>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
<script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
<script>
$('.dataTables-example').DataTable({
    pageLength: 10,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
        { extend: 'copy'},
        {extend: 'csv', title: '<?php echo "$company_name Approved Quoations at ". date('d F Y'); ?>'},
        {extend: 'excel', title: '<?php echo "$company_name Approved Quoations at ". date('d F Y'); ?>'},
        {extend: 'pdf', title: '<?php echo "$company_name Approved Quoations at ". date('d F Y'); ?>'},
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
