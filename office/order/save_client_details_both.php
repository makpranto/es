<?php
// include '../heart/a.php';
// secure('sell');
$fg = $_SESSION['tysla_retail customer SESSIONS name'];
$customer_name = pull("full_name", 'walk_in_clients', "`id` = '$fg'");
$customer_phone = pull("phone", 'walk_in_clients', "`id` = '$fg'");
$customer_email = pull("email", 'walk_in_clients', "`id` = '$fg'");
$now = date('Y-m-d H:i:s');
require('../ddffgg/fpdf.php');
class PDF extends FPDF{
    function Header(){
        include '../heart/heart.php';
        include '../heart/dsfhiusdfhui.php';
        global $db, $customer_name, $sale_id, $customer_email, $customer_phone;
        $this->Image('../img/'.$ikon,9,5,50);
        $this->SetFont( 'Arial', 'B', 10 );
        $this->SetTextColor(0,0,0);
        $this->SetX($this->lMargin);
        $this->SetTextColor(0,0,0);
        $this->SetX($this->lMargin);
        $this->Cell( 0, -1, $company_name, 0, 0, 'R' );
        $this->Ln(5);
        $this->SetFont( 'Arial', '', 10 );
        $this->SetTextColor(0,0,0);
        $this->Cell( 0, -1, $company_address, 0, 0, 'R' );
        $this->Ln(5);
        $this->Cell( 0, -1, $company_email, 0, 0, 'R' );
        $this->Ln(5);
        $this->Cell( 0, -1, $company_phone_1, 0, 0, 'R' );
        if (strlen($company_phone_2)>0) {
            $this->Ln(4);
            $this->Cell( 0, -1, $company_phone_2, 0, 0, 'R' );
        }
        $this->Ln(7);
        $this->SetFont( 'Arial', 'B', 10 );
        $this->Cell( 0, -1, date('d F, Y'), 0, 0, 'R' );
        $this->Ln(3);
        $fg = $_SESSION['tysla_retail customer SESSIONS name'];
        $this->SetTextColor(0,0,0);
        $this->SetTextColor(51,102,255);
        $this->SetFont('Arial','B',20);
        $this->Cell(.01,1,"________________________________________________",0,0);
        $this->Ln(5);
        $this->SetTextColor(0,0,0);
        $this->SetFont( 'Arial', '', 10 );
        $this->Ln(5);
        $this->Cell(1 , 1, "Customer Name:      $customer_name", 0, 0 );
        $this->Ln(5);
        $this->SetCol(0);
        $this->Cell( 0, 1, "Phone:                      $customer_phone", 0, 0 );
        if (!empty($customer_email)) {
            $this->Ln(5);
            $this->Cell( 0, 1, "Email:                        $customer_email", 0, 0);
        }
        $this->Ln(5);
        $this->SetTextColor(0,0,0);
        $this->SetFont('Arial','B',20);
        $this->Cell(.01,1,"________________________________________________",0,0);
        $this->Ln(8);
        $this->SetTextColor(0,67,83);
        $this->SetCol(0);
        $this->SetFont( 'Arial', 'B', 10 );
        $this->SetTextColor(255,255,255);
        $this->setFillColor(77,140,49);
        $this->Cell(0,7,"Qty",0,0,'L', 1);
        $this->SetCol(0.2);
        $this->Cell(0,7,"u.o.m",0,0,'L', 1);
        $this->SetCol(0.5);
        $this->Cell(0,7,"Description",0,0,'L',1);
        $this->SetCol(2.05);
        $this->Cell(0,7,"Unit Price",0,0,'L',1);
        $this->SetCol(3);
        $this->Cell(0,7,"Total",0,0,'L',1);
        $this->SetFont('Times','B',12);
        $this->SetCol(0);
        $this->Ln(10);
    }
    function SetCol($col){
        $this->col = $col;
        $x = 10+$col*50;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTextColor(51,102,255);
$pdf->SetFont('Arial','B',14);
$pdf->SetMargins(25,5);
$pq1=0;$count =0;$all_disc =0;
$get_basket = r("SELECT `zvinhu`.`id` AS `product_id`,`product_name`, `uom`, `zvinhu`.`buying_price` AS `buying_price`, `selling_price`, `basket`.`id` AS `id`, `basket`.`qty` `qty`, `basket`.`discount` AS `disco` FROM `basket` JOIN `zvinhu` ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'sale'");
$fopin = date('Y-F-d')."-$sale_id";
if (mysqli_num_rows($get_basket)>0) {
    $ese = 0;
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',7);
    while ($it = mysqli_fetch_array($get_basket)) {
        $product_name = $it['product_name'];
        $selling_price = $it['selling_price'];
        $buying_price = $it['buying_price'];
        $product_quantity = $it['qty'];
        $ese += $product_quantity;
        $uom = $it['uom'];
        $uom = pull('name', 'uom', "`id` = '$uom'");
        $product_id= $it['product_id'];
        $id = $it['id'];
        $disco = $it['disco'] * $product_quantity;
        $pdf->SetCol(0);
        $pdf->Ln(5);
        $pdf->Cell(80,0,"$product_quantity",0,0);
        $pdf->SetCol(0.2);
        $pdf->Cell(80,0,"$uom",0,0);
        $pdf->SetCol(2.05);
        $pdf->Cell(250,0,"$selling_price",0,0);
        $pdf->SetCol(3);
        $selling_price = str_pad($selling_price, 11,' ', STR_PAD_LEFT);
        $pdf->Cell(40,0,amount(($selling_price*$product_quantity)-$disco),0,'R');
        $pdf->SetCol(0.5);
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
    }
    $pdf->Ln(6);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetCol(0);
    $pdf->Cell(191,1,"",0,1,'L',1);
    $pdf->Ln(9);
    $pdf->Cell(250,0,$ese,0,0);
    if (access($user_id, 'discount')) {
        $pdf->SetCol(2.9);
        $pdf->Cell(250,0,amount($all_disc),0,0);
    }
    $pdf->SetCol(3);
    $pq1 = number_format($pq1-$all_disc, 2);
    $pdf->Cell(250,0,"$$pq1",0,0);
    $pdf->SetCol(0);
    $pdf->Ln(9);
    $pdf->Cell(191,1,"",0,1,'L',1);
    $pdf->Ln(30);
    $pdf->SetCol(0);
    $pdf->SetFont( 'Arial', '',6 );
    $pdf->SetY(-35);
    $pdf->Cell(40,1,"*No claim for shortages or breakages will be recognised unless notified within seven days of delivery, and no goods will be accepted for return after seven days from the date of supply EXCEPT by",0,0);
    $pdf->Ln(5);
    $pdf->Cell(40,1,"special arrangement. Subject to a special agreement, a handling charge of 10% will be made on all goods returned.",0,0);
    $pdf->SetCol(2.5);
    $filename = "../storage/$fopin.pdf";
    $pdf->Output($filename,'F');
    $_SESSION['file'] = $filename;

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
    // $mail->AddAddress('orders@apise.shop', 'Apise Orders');
    $mail->AddAddress('tysla@apise.shop', 'Tysla Solutions');
    $mail->IsHTML(true);
    $mail->Subject = "Invoice from Enfield Zimbabwe";
    $mail->Body = "<div class='email_t_1 st-tm OrderConfirmation active'>
    <table role='presentation' class='theme-tab' style='width: 100%; min-width: 0 !important;' width='100%' cellspacing='0' cellpadding='0' border='0'>
    <tbody>
    <tr>
    <td class='st_theme-body st_email-start st_email-end tc' style='font-size: 0 !important; line-height: 100%; height: 640px; padding: 32px 8px;' valign='top' bgcolor='#eceff1' align='center'>
    <table role='presentation' class='c-section' style='max-width: 640px; text-align: center; width: 100%; min-width: 0 !important; margin: 0 auto;' width='100%' cellspacing='0' cellpadding='0' border='0'>
    <tbody>
    <tr>
    <td class='c-cell pb bb-c tc' style='padding-left: 8px; padding-right: 8px; font-size: 0 !important; line-height: 100%; border-bottom-width: 3px; border-bottom-color: #28a745; border-bottom-style: solid; padding-bottom: 16px;' bgcolor='transparent' align='center'>
    <div class='st_col-2' style='width: 100%; min-width: 0 !important; font-size: 0 !important; line-height: 100%; display: inline-block; vertical-align: top; max-width: 312px;'>
    <table role='presentation' class='column' style='width: 100%; min-width: 0 !important;' width='100%' cellspacing='0' cellpadding='0' border='0'>
    <tbody>
    <tr>
    <td class='st_col-cell st_email-end pt tl' style='padding-left: 8px; padding-right: 8px; font-size: 16px; color: #757575; line-height: 100%; padding-top: 16px; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important;' valign='top' align='left'>
    <a href='$home;' style='display: inline-block; text-decoration: none;'>
    <img src='$logo;' alt='Enfield Zimbabwe Logo' style='width: auto; height: 41px; max-width: 200px; vertical-align: middle;' width='370'>
    </a>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    <div class='st_col-2' style='width: 100%; min-width: 0 !important; font-size: 0 !important; line-height: 100%; display: inline-block; vertical-align: top; max-width: 312px;'>
    <table role='presentation' class='column' style='width: 100%; min-width: 0 !important;' width='100%' cellspacing='0' cellpadding='0' border='0'>
    <tbody>
    <tr>
    <td class='st_col-cell st_navigation-menu' style='padding-left: 8px; padding-right: 8px; font-size: 16px; color: #757575; padding-top: 24px; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important;' valign='top' align='right'>
    <p class='mb-0 tm' style='font-size: 16px; color: #b3b3b3; line-height: 100%; mso-line-height-rule: exactly; margin-top: 0; margin-bottom: 0; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important;'>#$sale_id;</p>
    </td>
    </tr>
    </tbody>
    </table>
    </div>
    </td>
    </tr>
    <tr>
    <td class='c-cell default-back py tc' style='font-size: 0 !important; line-height: 100%; padding: 16px 8px;' bgcolor='#f1f6f9' align='center'>
    <table role='presentation' class='column' style='width: 100%; min-width: 0 !important;' width='100%' cellspacing='0' cellpadding='0' border='0'>
    <tbody>
    <tr>
    <td class='st_col-cell py tc sc' style='font-size: 16px; color: #ffffff; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important; padding: 16px 8px;' valign='top' align='center'>
    <table role='presentation' class='ic-h' style='display: table; margin-left: auto; margin-right: auto;' width='80' cellspacing='0' cellpadding='0' border='0' align='center'>
    <tbody>
    <tr>
    <td class='content-back' style='line-height: 100%; mso-line-height-rule: exactly; border-radius: 100px; padding: 16px;' valign='middle' bgcolor='#ffffff' align='center'>
    <p class='imgr mb-0' style='font-size: 0; color: #a7b1b6; line-height: 100%; mso-line-height-rule: exactly; margin-top: 0; margin-bottom: 0; width: 100%; height: auto; clear: both; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important;'><img role='img' src='https://cdn.shopify.com/s/files/1/0014/8530/7965/files/i-shopping-cart.png?10164563408428775342' alt='Shopping cart' style='max-width: 48px; width: 100%; height: auto; clear: both; font-size: 0; line-height: 100%; margin-left: auto; margin-right: auto;' width='48' height='48'></p>
        </td>
        </tr>
        </tbody>
        </table>
        <h1 class='sc' style='color: #3e484d; font-size: 26px; line-height: 34px; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 700 !important; margin: 16px 0 8px; padding: 0;'>Thank you for your purchase! </h1>
        <p class='lead sc' style='font-size: 17px; color: #a7b1b6; line-height: 27px; mso-line-height-rule: exactly; margin-top: 0; margin-bottom: 24px; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important;'>
        Hi $customer_name, we have attached a copy of your invoice on this email. We look forward to seeing you again.
        </p>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        <tr>
        <td class='c-cell footer pb tc' style='padding-left: 8px; padding-right: 8px; font-size: 0 !important; line-height: 100%; padding-bottom: 16px;' bgcolor='transparent' align='center'>
        <table role='presentation' class='column' style='width: 100%; min-width: 0 !important;' width='100%' cellspacing='0' cellpadding='0' border='0'>
        <tbody>
        <tr>
        <td class='st_col-cell pt tc' style='padding-left: 8px; padding-right: 8px; font-size: 16px; color: #8f8f8f; padding-top: 16px; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important;' valign='top' align='center'>
        <p class='mb-0' style='font-size: 12px; color: #8f8f8f; line-height: 23px; mso-line-height-rule: exactly; margin-top: 0; margin-bottom: 0; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important;'>
        If you have any questions, reply to this email or contact us at <a href='mailto:sales@enfield.co.zw' style='color: #8f8f8f; display: inline-block; text-decoration: none;'><span style='color: #8f8f8f;'>sales@enfield.co.zw</span></a>
        </p>
        <p class='footer-mb' style='font-size: 12px; color: #8f8f8f; line-height: 23px; mso-line-height-rule: exactly; margin-top: 0; margin-bottom: 8px; font-family: 'Open Sans', Arial, sans-serif !important; font-weight: 400 !important;'>
        ©date('Y'); <a href='http://enfield.co.zw' style='color: #8f8f8f; display: inline-block; text-decoration: none;'>enfield</a>
        <br>
        Corner Hobbs and Plymouth, Harare <br> Zimbabwe
        </p>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        ";
        $mail->addAttachment($filename, "Enfield Invoice for $client_name.pdf");
        // if($mail->Send()) {
        //     success('Order has not been placed.');
        // }else {
        //     error("Not");
        //     // echo "<script>window.location.replace('./');</script>";
        // }
    }
    ?>
