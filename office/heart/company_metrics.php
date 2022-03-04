<?php
// $now = date('Y-m-d');
// $last_mwedzi = date('Y-m', strtotime('last month'));
// $total_monthly = 0;
// $bim = $db->query("SELECT `product_quantity` FROM `sales` WHERE `user_id`= '$user_id' AND `company_id` = '$company_id' AND `time_of_sale` LIKE '$this_mwedzi%'");
// while ($bmi = mysqli_fetch_array($bim)) {
//     $total_monthly += $bmi['product_quantity'];
// }
//
// $total_last_monthly = 0;
// $bim = $db->query("SELECT `product_quantity` FROM `sales` WHERE `user_id`= '$user_id' AND `company_id` = '$company_id' AND `time_of_sale` LIKE '$last_mwedzi%'");
// while ($bmi = mysqli_fetch_array($bim)) {
//     $total_last_monthly += $bmi['product_quantity'];
// }
//
// $lay = 0;
// $bim = $db->query("SELECT `product_quantity` FROM `lay_by` WHERE `user_id`= '$user_id' AND `company_id` = '$company_id' AND `time_of_payment` LIKE '$this_mwedzi%'");
// while ($bmi = mysqli_fetch_array($bim)) {
//     $lay += $bmi['product_quantity'];
// }
//
// $lay_last = 0;
// $bim = $db->query("SELECT `product_quantity` FROM `lay_by` WHERE `user_id`= '$user_id' AND `company_id` = '$company_id' AND `time_of_payment` LIKE '$last_mwedzi%'");
// while ($bmi = mysqli_fetch_array($bim)) {
//     $lay_last += $bmi['product_quantity'];
// }
//
// $c = 0;
// $bim = $db->query("SELECT ((`product_quantity`*`selling_price`) - `discount`) AS 'df' FROM `sales` WHERE `user_id`= '$user_id' AND `company_id` = '$company_id' AND `time_of_sale` LIKE '$this_mwedzi%'");
// while ($bmi = mysqli_fetch_array($bim)) {
//     $c += $bmi['df'];
// }
// $c = amount($c);
// $cl = 0;
// $bim = $db->query("SELECT ((`product_quantity`*`selling_price`) - `discount`) AS 'df' FROM `sales` WHERE `user_id`= '$user_id' AND `company_id` = '$company_id' AND `time_of_sale` LIKE '$last_mwedzi%'");
// while ($bmi = mysqli_fetch_array($bim)) {
//     $cl += $bmi['df'];
// }
// $bim = r("SELECT SUM(`product_quantity`) AS `df`, `product_id`  FROM `sales` WHERE `company_id` = '$company_id' AND `time_of_sale` LIKE '$now%' GROUP BY `product_quantity` DESC LIMIT 1");
//
// $s = get($bim);
// $most_sold_total = isset($s['df']) ? $s['df'] : '0';
// $product_name = pn(isset($s['product_id']) ? $s['product_id'] : '0');
//
//
//
// $cl = amount($cl);
// $credit_payments_mow = 0;
// $credit_last = 0;
// $query = $db->query("SELECT
//                 `amounts`.`a1` as `a1`,
//                 `payments_dates`.`d1` as `d1`,
//                 `amounts`.`a2` as `a2`, `payments_dates`.`d2` as `d2`,
//                 `amounts`.`a3` as `a3`, `payments_dates`.`d3` as `d3`,
//                 `amounts`.`a4` as `a4`, `payments_dates`.`d4` as `d4`,
//                 `amounts`.`a5` as `a5`, `payments_dates`.`d5` as `d5`,
//                 `amounts`.`a6` as `a6`, `payments_dates`.`d6` as `d6`,
//                 `amounts`.`a7` as `a7`, `payments_dates`.`d7` as `d7`,
//                 `amounts`.`a8` as `a8`, `payments_dates`.`d8` as `d8`,
//                 `amounts`.`a9` as `a9`, `payments_dates`.`d9` as `d9`,
//                 `amounts`.`a10` as `a10`, `payments_dates`.`d10` as `d10`,
//                 `amounts`.`a11` as `a11`, `payments_dates`.`d11` as `d11`,
//                 `amounts`.`a12` as `a12`, `payments_dates`.`d12` as `d12`,
//                 `amounts`.`a13` as `a13`, `payments_dates`.`d13` as `d13`,
//                 `amounts`.`a14` as `a14`, `payments_dates`.`d14` as `d14`,
//                 `amounts`.`a15` as `a15`, `payments_dates`.`d15` as `d15`,
//                 `amounts`.`a16` as `a16`, `payments_dates`.`d16` as `d16`,
//                 `amounts`.`a17` as `a17`, `payments_dates`.`d17` as `d17`,
//                 `amounts`.`a18` as `a18`, `payments_dates`.`d18` as `d18`,
//                 `amounts`.`a19` as `a19`, `payments_dates`.`d19` as `d19`,
//                 `amounts`.`a20` as `a20`, `payments_dates`.`d20` as `d20`,
//                 `amounts`.`a21` as `a21`, `payments_dates`.`d21` as `d21`,
//                 `amounts`.`a22` as `a22`, `payments_dates`.`d22` as `d22`,
//                 `amounts`.`a23` as `a23`, `payments_dates`.`d23` as `d23`,
//                 `amounts`.`a24` as `a24`, `payments_dates`.`d24` as `d24`
//                 FROM `payments_dates` INNER JOIN `amounts` ON `payments_dates`.`sale_id`=`amounts`.`sale_id` where `amounts`.`company_id`='$company_id'");
//                 $mar = [];
//                 $dat = [];
//                 while($row = mysqli_fetch_assoc($query)){
//
//                     foreach($row as $key => $valu) {
//                         if (($valu != '') && $valu != '0000-00-00 00:00:00') {
//                             if (strlen($valu) == 19) {
//                                 array_push($dat, $valu);
//                             }else{
//                                 array_push($mar, $valu);
//                             }
//                         }
//                     }
//                 }
//                 $keys = 0;
//                 while (count($mar) > $keys) {
//                     if (fnmatch("$this_mwedzi*", $dat[$keys])) {
//                         $credit_payments_mow += $mar[$keys];
//                     }
//                     $keys++;
//                 }
//                 $credit_payments_mow = amount($credit_payments_mow);
//                 $query = $db->query("SELECT
//                                 `amounts`.`a1` as `a1`,
//                                 `payments_dates`.`d1` as `d1`,
//                                 `amounts`.`a2` as `a2`, `payments_dates`.`d2` as `d2`,
//                                 `amounts`.`a3` as `a3`, `payments_dates`.`d3` as `d3`,
//                                 `amounts`.`a4` as `a4`, `payments_dates`.`d4` as `d4`,
//                                 `amounts`.`a5` as `a5`, `payments_dates`.`d5` as `d5`,
//                                 `amounts`.`a6` as `a6`, `payments_dates`.`d6` as `d6`,
//                                 `amounts`.`a7` as `a7`, `payments_dates`.`d7` as `d7`,
//                                 `amounts`.`a8` as `a8`, `payments_dates`.`d8` as `d8`,
//                                 `amounts`.`a9` as `a9`, `payments_dates`.`d9` as `d9`,
//                                 `amounts`.`a10` as `a10`, `payments_dates`.`d10` as `d10`,
//                                 `amounts`.`a11` as `a11`, `payments_dates`.`d11` as `d11`,
//                                 `amounts`.`a12` as `a12`, `payments_dates`.`d12` as `d12`,
//                                 `amounts`.`a13` as `a13`, `payments_dates`.`d13` as `d13`,
//                                 `amounts`.`a14` as `a14`, `payments_dates`.`d14` as `d14`,
//                                 `amounts`.`a15` as `a15`, `payments_dates`.`d15` as `d15`,
//                                 `amounts`.`a16` as `a16`, `payments_dates`.`d16` as `d16`,
//                                 `amounts`.`a17` as `a17`, `payments_dates`.`d17` as `d17`,
//                                 `amounts`.`a18` as `a18`, `payments_dates`.`d18` as `d18`,
//                                 `amounts`.`a19` as `a19`, `payments_dates`.`d19` as `d19`,
//                                 `amounts`.`a20` as `a20`, `payments_dates`.`d20` as `d20`,
//                                 `amounts`.`a21` as `a21`, `payments_dates`.`d21` as `d21`,
//                                 `amounts`.`a22` as `a22`, `payments_dates`.`d22` as `d22`,
//                                 `amounts`.`a23` as `a23`, `payments_dates`.`d23` as `d23`,
//                                 `amounts`.`a24` as `a24`, `payments_dates`.`d24` as `d24`
//                                 FROM `payments_dates` INNER JOIN `amounts` ON `payments_dates`.`sale_id`=`amounts`.`sale_id` where `amounts`.`company_id`='$company_id'");
//                                 $mar = [];
//                                 $dat = [];
//                                 while($row = mysqli_fetch_assoc($query)){
//
//                                     foreach($row as $key => $valu) {
//                                         if (($valu != '') && $valu != '0000-00-00 00:00:00') {
//                                             if (strlen($valu) == 19) {
//                                                 array_push($dat, $valu);
//                                             }else{
//                                                 array_push($mar, $valu);
//                                             }
//                                         }
//                                     }
//                                 }
//                                 $keys = 0;
//                                 while (count($mar) > $keys) {
//                                     if (fnmatch("$last_mwedzi*", $dat[$keys])) {
//                                         $credit_last += $mar[$keys];
//                                     }
//                                     $keys++;
//                                 }
//                                 $credit_last = amount($credit_last);

 ?>
