<?php
include '../heart/a.php';
secure('start_order');
if (isset($_SESSION['enfield_customer_session_name'])) {
    $fg = $_SESSION['enfield_customer_session_name'];
    $sale_id = mb_strtoupper($fg);
    $customer_id = pull('customer_id', 'basket', "`price_check_id`= '$fg'");
    $customer_name = pull("full_name", 'walk_in_clients', "`id` = '$customer_id'");
    $customer_phone = pull("phone", 'walk_in_clients', "`id` = '$customer_id'");
    $customer_email = pull("email", 'walk_in_clients', "`id` = '$customer_id'");
    $now = date('Y-m-d H:i:s');
    require('../ddffgg/fpdf_protection.php');
    $pdf = new FPDF_Protection();
    $pdf->SetProtection(array('print'), '', '7805327323#Pass');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetTextColor(51,102,255);
    $pdf->SetFont('Arial','B',14);
    $pdf->SetMargins(25,5);
    $pq1=0;$count =0;$all_disc =0;
    $get_basket = r("SELECT * FROM `basket` WHERE `status` = 'quotation_approved' AND `price_check_id` = '$fg'");
    $fopin = date('Y-F-d')."-$sale_id".time();
    if (mysqli_num_rows($get_basket)>0) {
        $ese = 0;
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','',7);
        while ($it = mysqli_fetch_array($get_basket)) {
            $product_id = $it['product_id'];
            $product_name = pull('product_name', 'zvinhu', "`id` = '$product_id'");
            $uom = pull('uom', 'zvinhu', "`id` = '$product_id'");
            $selling_price = $it['selling_price'];
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
        $pdf->Cell(0,.5,"*Comments or Special Instrunctions: Delivery ex-stock subject to prior sale. Prices are subject to change without notice. Valid for 24hours!",0,0);
        $pdf->SetTextColor(0,0,0);
        $filename = "../storage/quotations-out/$fopin.pdf";
        $pdf->Output($filename,'F');
        $_SESSION['file'] = $filename;
    }
}
header("location: ./");
?>
