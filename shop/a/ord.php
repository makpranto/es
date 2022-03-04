<?php
include 'fun.php';
if (there('s')) {
    $s = mb_strtolower(clean($_POST['s']));
    $allowed = ['az','za', 'lh', 'hl'];
    if (!in_array($s, $allowed)) {
        error("Bad data has been submitted.");
    }else {
        if ($s == 'az') {
            $_SESSION['order'] = "ORDER BY `product_name`";
        }elseif ($s == 'za') {
            $_SESSION['order'] = "ORDER BY `product_name` DESC";
        }elseif ($s == 'lh') {
            $_SESSION['order'] = "ORDER BY ABS(`selling_price`)";
        }elseif ($s == 'hl') {
            $_SESSION['order'] = "ORDER BY ABS(`selling_price`) DESC";
        }
        $_SESSION['order_tag'] = $s;
        echo "<script>
        window.location = './'
        </script>";
    }
}
