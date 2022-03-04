<?php
include '../heart/a.php';
secure('add_new_stock');
$sub_c = "!= 'z'";
if (there('main_cat')) {
    $main_cat = clean(hide('d', $_POST['main_cat']));
    if (!empty($main_cat)) {
        if (mysqli_num_rows(r("SELECT `id` FROM `categories` WHERE `id` = '$main_cat'")) > 0) {
            $sub_c = "= '$main_cat'";
        }
    }
}
?>
<div class="form-group">
    <select name="sub_cat" class="form-control">
        <option value="<?php echo hide('e', 'null'); ?>">Select sub-category</option>
        <?php
        $as = r("SELECT `name`, `id` FROM `sub_categories` WHERE `main_cat` $sub_c");
        while ($a = get($as)) {
            echo "<option value='". hide('e', $a['id'])."'>". $a['name']. '</option>';
        }
        ?>
    </select>
</div>
