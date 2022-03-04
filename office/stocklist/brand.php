<?php
include '../heart/a.php';
secure('stock');
if (there('query')) {
	$keyword = strval($_POST['query']);
    $keyword = clean($keyword);
	$search_param = "%{$keyword}%";
	$sql = r("SELECT `name` FROM `brands` WHERE `name` LIKE '$search_param'");
	if (mysqli_num_rows($sql) > 0) {
		while($row = mysqli_fetch_array($sql)) {
		$countryResult[] = word(strtolower($row["name"]));
		}
		echo json_encode($countryResult);
	}
}else {
	header("location: $home");
}
