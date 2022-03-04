<?php
include '../heart/a.php';
secure('receive');
if (!isset($_POST['id'])) {
	error('Bad practice detected.');
}else {
	$idg = clean(hide('d', $_POST['id']));
	if (r("DELETE FROM `basket` WHERE `user_id` ='$user_id' AND `company_id`='$company_id' AND `id` = '$idg' AND `type` = 'new'")) {
	}else {
		error("Oops. Something went wrong. Contact Tysla Solutions.");
	}
}
?>
<?php include 'UdfghvscfJpoury.php' ?>
