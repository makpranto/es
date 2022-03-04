<?php
include 'fun.php';
if (there('query')) {
	$countryResult[] = trim($_POST['query']);
	$keyword = strval($_POST['query']);
	$keyword = clean($keyword);
	$search_param = "%{$keyword}%";
	$sql = r("SELECT * FROM `zvinhu` WHERE `product_name` LIKE '$search_param' AND `status` = 1");
	if (mysqli_num_rows($sql) > 0) {
		while($row = mysqli_fetch_array($sql)) {
			$countryResult[] = pname(linker('l', $row['product_name']));
		}
	}
	echo json_encode($countryResult);
}else {
	header("location: $home");
}
