<?php
include '../heart/a.php';
secure('start_order');
if (there('query')) {
	$keyword = strval($_POST['query']);
	$keyword = clean($keyword);
	$search_param = "%{$keyword}%";
	$sql = r("SELECT `product_name` FROM `zvinhu` WHERE `product_name` LIKE '$search_param' AND `status` = '1'");
	if (mysqli_num_rows($sql) > 0) {
		while($row = mysqli_fetch_array($sql)) {
			$countryResult[] = $row["product_name"];
		}
		echo json_encode($countryResult);
	}
}
?>
