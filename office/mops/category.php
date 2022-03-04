<?php
include '../heart/heart.php';
include '../heart/func.php';
include '../heart/dsfhiusdfhui.php';
check_access($user_id, 'stock');
$keyword = strval($_POST['query']);
$keyword = clean($keyword);
$search_param = "%{$keyword}%";
$db = mysqli_connect('localhost', "$database_user", "$database_password", "$database_name");
$sql = $db->query("SELECT `name` FROM `categories` WHERE `name` LIKE '$search_param' AND `company_id` = '$company_id'");
if (mysqli_num_rows($sql) > 0) {
	while($row = mysqli_fetch_array($sql)) {
	$countryResult[] = $row["name"];
	}
	echo json_encode($countryResult);
}
$db->close();
?>
