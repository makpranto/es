<?php
include '../heart/a.php';
secure('start_order');
if (there('query')) {
	$keyword = strval($_POST['query']);
	$keyword = clean($keyword);
	$search_param = "%{$keyword}%";
	$sql = r("SELECT `name` FROM `suppliers` WHERE `name` LIKE '$search_param' AND `status` = 'ACTIVE'");
	if (mysqli_num_rows($sql) > 0) {
		while($row = mysqli_fetch_array($sql)) {
			$countryResult[] = $row["name"];
		}
		echo json_encode($countryResult);
	}
}
?>
