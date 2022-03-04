<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
if ( mysqli_num_rows($db->query("SELECT `id` FROM `basket` WHERE `user_id` = '$user_id' AND `type` = 'quote' AND `company_id` = '$company_id'")) == 0) {
    echo "success";
    exit;
}else {
    $red = 0;
    $to = 0;
    $to = amount($to);
    $worth = 0.00;
    $basket = $db->query("SELECT sum(`qty`)  AS `qty`, `selling_price`,  sum(`basket`.`discount`) AS `sed` FROM `basket` JOIN `zvinhu`
        ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'quote' AND `basket`.`company_id` = '$company_id'");
        while ($ba = mysqli_fetch_array($basket) ) {
            $co = $ba['qty'];
            $worth = $worth+(($ba['qty']*$ba['selling_price']));
            $worth = $worth - $ba['sed'];
        }
        $fg = $_SESSION['tysla_retail customer SESSIONS name'];
        $sdf = $db->query("SELECT * FROM `customers` WHERE `id` = '$fg'");
        while ($hj = mysqli_fetch_array($sdf)) {
            $customer_name = $hj['customer_name'];
        }
        $now = date('Y-m-d H:i:s');
        $sale_id = date('YmdHis');
        require('../ddffgg/fpdf.php');
        class PDF extends FPDF{
            function Header(){
                include '../heart/heart.php';
                $db = mysqli_connect('localhost', "$database_user", "$database_password", "$database_name");
                include '../heart/dsfhiusdfhui.php';
                $this->Image('../ddffgg/img/'.$company_logo,9,5,50);
                $this->SetFont( 'Arial', 'B', 10 );
                $fg = $_SESSION['tysla_retail customer SESSIONS name'];
                $sdf = $db->query("SELECT * FROM `customers` WHERE `id` = '$fg'");
                while ($hj = mysqli_fetch_array($sdf)) {
                    $customer_name = $hj['customer_name'];
                }
                $this->SetTextColor(0,89,155);
                $this->SetX($this->lMargin);
                $this->Cell( 0, -1, "$company_name", 0, 0, 'R' );
                $this->Ln(5);
                $this->SetFont( 'Arial', '', 10 );
                $this->SetTextColor(0,67,83);
                $this->Cell( 0, -1, $company_address, 0, 0, 'R' );
                $this->Ln(4);
                $this->Cell( 0, -1, $company_email, 0, 0, 'R' );
                $this->Ln(4);
                $this->Cell( 0, -1, $company_phone_1, 0, 0, 'R' );
                if (strlen($company_phone_2)>0) {
                    $this->Ln(4);
                    $this->Cell( 0, -1, $company_phone_2, 0, 0, 'R' );
                }
                $this->Ln(16);
                $this->SetFont('Arial', 'U',15);
                $this->Cell(80);
                $this->SetDrawColor(0,128,128);
                $this->SetFillColor(0,128,128);
                $this->SetTextColor(69,116,158);
                $this->Cell(1,1,"Quotation",0,0,'C');
                $this->Ln(9);
                $this->SetFont('Arial','B',9);
                $this->Cell(1 , 1, "Customer Name : $customer_name", 0, 0 );
                $this->Ln(5);
                $this->Cell(1 , 1, "Cashier : $user_name", 0, 0 );
                $this->Ln(5);
                $pol = date('d F Y H:i:s');
                $this->Cell(1 , 1, "Time: $pol"."HRS", 0, 0 );
                $this->Ln(20);
                $this->SetFont('Times','B',12);
                $this->SetDrawColor(0,128,128);
                $this->SetFillColor(0,128,128);
                $this->SetTextColor(0,128,128);
                $this->Cell(190,5,'DESCRIPTION',1,1);
                $this->SetCol(2);
                $this->Cell(250,-5,'PRICE',0,0);
                $this->SetCol(2.5);
                $this->Cell(250,-5,'QTY',0,0);
                $this->SetCol(2.9);
                $this->Cell(250,-5,'DISCOUNT',0,0);
                $this->SetCol(3.4);
                $this->Cell(40,-5,'TOTAL',0,0);
                $this->Ln(5);
                $this->SetCol(0);
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
            $pdf->SetMargins(25,5);
            $pq1=0;$count =0;$all_disc =0;
            $get_basket = $db->query("SELECT `product_name`, `zvinhu`.`id` AS `product_id`, `buying_price`, `selling_price`, `basket`.`id` AS `id`, `qty`, `product_code`, `basket`.`discount` AS `disco` FROM `basket` JOIN `zvinhu`
                ON `zvinhu`.`id` = `basket`.`product_id`  WHERE `basket`.`user_id` = '$user_id' AND `basket`.`type` = 'quote' AND `basket`.`company_id` = '$company_id'");
                $fopin = date('Y_F_d_H_i_s')."_$user_name"."_"."$customer_name";
            if (mysqli_num_rows($get_basket)>0) {
                while ($it = mysqli_fetch_array($get_basket)) {
                    $product_name = $it['product_name'];
                    $selling_price = $it['selling_price'];
                    $buying_price = $it['buying_price'];
                    $product_quantity = $it['qty'];
                    $product_id= $it['product_id'];
                    $id = $it['id'];
                    $disco = $it['disco'];
                    $pdf->SetCol(0);
                    $pdf->Ln(5);
                    $pdf->SetTextColor(0,0,0);
                    $pdf->SetFont('Arial','',10);
                    if(strlen($product_name)> 28){
                        $product = str_split($product_name, 60);
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
                    $pdf->SetCol(2);
                    $pdf->Cell(250,0,"$selling_price",0,0);
                    $pdf->SetCol(2.5);
                    $pdf->Cell(250,0,$product_quantity,0,0);
                    $pdf->SetCol(2.9);
                    $pdf->Cell(250,0,$disco,0,0);
                    $pdf->SetCol(3.4);
                    $selling_price = str_pad($selling_price, 11,' ', STR_PAD_LEFT);
                    $pdf->Cell(40,0,amount($selling_price*$product_quantity),0,'R');
                    $pq1 = $pq1+($selling_price*$product_quantity);
                    $count = $count+$product_quantity;

                    $tos = date('Y-m-d H:i:s');
                    // $db->query("INSERT INTO `sales`(`buying_price`, `selling_price`,`product_id`, `product_quantity`, `discount`, `time_of_sale`, `company_id`, `user_id`,
                    //     `invoice_number`, `agent_name`, `profit`) VALUES ('$buying_price', '$selling_price','$product_id','$product_quantity','$disco','$tos','$company_id','$user_id','$fopin','$agent_','$profit')");
                    $db->query("DELETE FROM `basket` where `id`=$id");
                    // $db->query("UPDATE `zvinhu` set `on_hand`= (`on_hand` - $product_quantity), `last_sold_on`='$tos' where `id`='$product_id'");
                }
                $pdf->Ln(15);
                $pdf->SetFont('Arial','B',15);
                $pdf->SetCol(0);
                $pdf->Cell(191,1,"",0,1,'L',1);
                $pdf->Ln(9);
                $pdf->Cell(250,0,'Total',0,0);
                $pdf->SetCol(2.5);
                $pdf->Cell(250,0,$count,0,0);
                $pdf->SetCol(3.3);
                $pq1 = number_format($pq1-$all_disc, 2);
                $pdf->Cell(250,0,"$$pq1",0,0);
                $pdf->SetCol(0);
                $pdf->Ln(9);
                $pdf->Cell(191,1,"",0,1,'L',1);
                $pdf->Ln(30);
                $pdf->SetFont('Arial','B',9);
                $pdf->SetTextColor(255,255,255);
                $pdf->setFillColor(0,0,0);
                $pdf->Cell(0,10,"BANKING DETAILS",0,1,'L',1);
                $pdf->Ln(5);
                $pdf->setFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);
                $pdf->Cell(0,10,"Bank Name:                      Steward Bank",0,1,'L',1);
                $pdf->Ln(1);
                $pdf->Cell(0,10,"Account Name:                 Makanaka Properties",0,1,'L',1);
                $pdf->Ln(1);
                $pdf->Cell(0,10,"Account Number:             1008717199",0,1,'L',1);
                $pdf->Ln(1);
                $pdf->Cell(0,10,"Branch:                              Kwame Nkrumah",0,1,'L',1);
                $pdf->SetCol(2.5);

                $filename="../ikdjns/$fopin.pdf";
                $pdf->Output($filename,'F');
                $_SESSION['quotation'] = $filename;
                echo "success";
            }
        }

 ?>
