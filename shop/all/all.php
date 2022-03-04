<?php
include '../a/fun.php';
if (there('n')) {
    if (mysqli_num_rows(r("SELECT `id` FROM `zvinhu` WHERE `status` = '1'")) > 0) {
        $page = 0;
        if (isset($_POST['page'])) {
            $page  = $_POST['page'];
        } else {
            $page=1;
        };
        $startFrom = ($page-1) * $items_per_page;
        if (isset($_SESSION['order'])) {
            $order = $_SESSION['order'];
            $result = r("SELECT * FROM `zvinhu` WHERE `status` = '1' $order LIMIT $startFrom, $items_per_page");
        }else {
            $result = r("SELECT * FROM `zvinhu` WHERE `status` = '1' LIMIT $startFrom, $items_per_page");
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
}else {
    http_response_code(404);
    $lost = 'file';
    include '../tysla_solutions_alt.php';
}
?>
