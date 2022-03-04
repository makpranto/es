<?php
include 'a/fun.php';
if (there('cat')) {
	$cat = clean(hide('d', $_POST['cat']));
	if (mysqli_num_rows(r("SELECT `id` FROM `sub_categories` WHERE `status` = '1' AND `id` = '$cat'")) == 1) {
		$page = 0;
		if (isset($_POST['page'])) {
			$page  = $_POST['page'];
		} else {
			$page=1;
		};
		$startFrom = ($page-1) * $items_per_page;
		if (isset($_SESSION['order'])) {
			$order = $_SESSION['order'];
			$result = r("SELECT * FROM `zvinhu` WHERE `sub_cat` = '$cat' AND `status` = '1' $order LIMIT $startFrom, $items_per_page");
		}else {
			$result = r("SELECT * FROM `zvinhu` WHERE `sub_cat` = '$cat' AND `status` = '1' LIMIT $startFrom, $items_per_page");
		}
		$paginationHtml = '';
		while ($row = mysqli_fetch_assoc($result)) {
			$paginationHtml.='<div class="col-md-4">';
			$paginationHtml.= grocery_item($row['id']);
			$paginationHtml.='</div>';
		}
		$jsonData = array(
			"html"	=> $paginationHtml,
		);
		echo json_encode($jsonData);
	}
}
?>
