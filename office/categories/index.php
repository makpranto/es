<?php
include '../heart/a.php';
secure('manage_categories');
if (isset($_SERVER["CONTENT_LENGTH"])) {
    if ($_SERVER["CONTENT_LENGTH"] > ((int)ini_get('post_max_size') * 1024 * 1024)) {
        $_SESSION['JIsY77*0neY7Y77*07*fkgnjOInfgjUd8njdfjsdkdsjf*00(*7)'] = "<a href='$project_root_folder"."/categories/' class='btn btn-success waves-effect waves-light'><i class='fa fa-arrow-left mr-2'></i> Go Back</a>";
        header("location: ../error");
        exit;
    }
}
$cat_name = '';
$main_cat = '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | All $company_name's Categories"; ?> </title>
    <?php style(); ?>
    <link href="<?php echo "$project_root_folder"; ?>/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-4 b-r">
                            <?php
                            $er = [];
                            $suc = [];
                            if (isset($_POST['submit_category'])) {
                                if (!empty($_FILES['file'])) {
                                    if($_FILES['file']["size"] > 0){
                                        if ($_FILES["file"]["size"] > 1*MB) {
                                            $er[] = ("The image should be less than or equal to 1MB. Compress it first then try again.");
                                        }else {
                                            if (!there('cat_name') || !there('main_cat')) {
                                                $er[] = ("Bad practice has been detected.");
                                            }else {
                                                $s = 0;
                                                $cat_name = mb_strtoupper(clean($_POST['cat_name']));
                                                $main_cat = ucwords(mb_strtolower(clean(hide('d', $_POST['main_cat']))));
                                                $filename = $_FILES['file']['name'];
                                                $ext = mb_strtolower(clean(pathinfo($filename, PATHINFO_EXTENSION)));
                                                $extensions = ['png', 'jpg', 'jpeg'];
                                                if (!in_array($ext, $extensions)) {
                                                    $er[] = ("<b>$ext</b> files are not allowed.");
                                                    $s = 20;
                                                }
                                                if (empty($cat_name)) {
                                                    $er[] = ("Submit sub-category\'s name.");
                                                    $s = 20;
                                                }elseif (strlen($cat_name) < 3) {
                                                    $er[] = ("The sub-category\'s name has to be greater than 3 characters in length.");
                                                    $s = 20;
                                                }elseif (!pname($cat_name)){
                                                    $er[] = ("The sub-category\'s name can only have letters, spaces, &, % and numbers.");
                                                    $s = 20;
                                                }elseif (strlen($cat_name) > $c_name_length) {
                                                    $er[] = ("The sub-category\'s name has to be less than $c_name_length characters in length.");
                                                    $s = 20;
                                                }elseif (mysqli_num_rows(r("SELECT `id` FROM `sub_categories` WHERE `name` = '$cat_name'")) != 0) {
                                                    $name = ucwords(mb_strtolower($cat_name));
                                                    $er[] = ("$name is already registered.");
                                                    $s = 20;
                                                }

                                                if ($main_cat == 'Null') {
                                                    $er[] = ('Please select the main category for this sub-category.');
                                                    $s= 20;
                                                }elseif (mysqli_num_rows(r("SELECT `id` FROM `categories` WHERE `id` = '$main_cat'")) != 1) {
                                                    $er[] = ('Bad practice has been detected.');
                                                    $s= 20;
                                                }
                                                if ($s == 0) {
                                                    $path = "../../img/subc/";
                                                    $rand = ('OIDFJ67SYITVJSDBVZXCJI6367WE685QWJGKDSDVCXTWQ6276S979215213546829jddshfjkhjBgdfg830GNZcVMXCXLSA7R87SDFBJ83Y9DSHKWVEASI48DSAF1356687DS987SD7FDF5SKMFGKE632SPIYEUYWQTRYA1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                                                    $rename = substr(str_shuffle($rand), 0, (4)). date("Y").substr(str_shuffle($rand), 0, (3)). date("m").substr(str_shuffle($rand), 0, (3)). date("d").substr(str_shuffle($rand), 0, (2)). date("h").substr(str_shuffle($rand), 0, (2)). date("i").substr(str_shuffle($rand), 0, (2)). date("s").".$ext";
                                                    $path = $path .$rename;
                                                    if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                                                        $name = ucwords(mb_strtolower($cat_name));
                                                        $df = "INSERT INTO `sub_categories`(`name`, `image`, `main_cat`, `status`) VALUES ('$name', '$rename', '$main_cat', '1')";
                                                        if (r($df)) {
                                                            $suc[] = ("$name has been added successfully.");
                                                        }else {
                                                            $er[] = ("Something went wrong.");
                                                        }
                                                    }else {
                                                        $er[] = ("The was an eror whilst uploading the image.");
                                                    }
                                                }
                                                $cat_name = mb_strtoupper($_POST['cat_name']);
                                                $main_cat = ucwords(mb_strtolower(hide('d', $_POST['main_cat'])));
                                            }
                                        }
                                    }else {
                                        $er[] = ("Submit the image for the product.");
                                    }
                                }else {
                                    $er[] = ("Bad practice has been detected");
                                }
                            }
                            if (isset($_POST['edit_sub'])) {
                                if (!empty($_FILES['img'])) {
                                    if($_FILES['img']["size"] >= 0){
                                        if ($_FILES["img"]["size"] > MB) {
                                            error("The image should be less than or equal to 1MB. Compress it first then try again.");
                                        }else {
                                            if (!there('cat_name') || !there('main_cat') || !there('cat_id')) {
                                                $er[] = ("Bad practice has been detected.");
                                            }else {
                                                $s = 0;
                                                $cat_name = mb_strtoupper(clean($_POST['cat_name']));
                                                $main_cat = ucwords(mb_strtolower(clean(hide('d', $_POST['main_cat']))));
                                                $cat_id = clean(hide('d', $_POST['cat_id']));
                                                if (mysqli_num_rows(r("SELECT `id` FROM `sub_categories` WHERE `id` = '$cat_id'")) == 1) {
                                                    if ($_FILES['img']["size"] > 0) {
                                                        $filename = $_FILES['img']['name'];
                                                        $ext = mb_strtolower(clean(pathinfo($filename, PATHINFO_EXTENSION)));
                                                        $extensions = ['png', 'jpg', 'jpeg'];
                                                        if (!in_array($ext, $extensions)) {
                                                            $er[] = ("<b>$ext</b> files are not allowed.");
                                                            $s = 20;
                                                        }
                                                    }
                                                    if ($main_cat == 'Null') {
                                                        $er[] = ('Please select the main category for this sub-category.');
                                                        $s= 20;
                                                    }elseif (mysqli_num_rows(r("SELECT `id` FROM `categories` WHERE `id` = '$main_cat'")) != 1) {
                                                        $er[] = ('Bad practice has been detected.');
                                                        $s= 20;
                                                    }
                                                    if (empty($cat_name)) {
                                                        $er[] = ("Submit sub-category\'s name.");
                                                        $s = 20;
                                                    }elseif (strlen($cat_name) < 3) {
                                                        $er[] = ("The sub-category\'s name has to be greater than 3 characters in length.");
                                                        $s = 20;
                                                    }elseif (!pname($cat_name)){
                                                        $er[] = ("The sub-category\'s name can only have letters, spaces, &, % and numbers.");
                                                        $s = 20;
                                                    }elseif (strlen($cat_name) > $c_name_length) {
                                                        $er[] = ("The sub-category\'s name has to be less than $c_name_length characters in length.");
                                                        $s = 20;
                                                    }elseif (mysqli_num_rows(r("SELECT `id` FROM `sub_categories` WHERE `name` = '$cat_name' AND `id` != '$cat_id'")) != 0) {
                                                        $name = ucwords(mb_strtolower($cat_name));
                                                        $er[] = ("$name is already registered.");
                                                        $s = 20;
                                                    }
                                                    if ($s == 0) {
                                                        $n = date('Y-m-d H:i:s');
                                                        $name = ucwords(mb_strtolower($cat_name));
                                                        if ($_FILES['img']["size"] > 0) {
                                                            $path = "../../img/subc/";
                                                            $paths = $path .pull('image', 'sub_categories', "`id` = '$cat_id'");
                                                            $rand = ('OIDFJ67SYITVJSDBVZXCJI6367WE685QWJGKDSDVCXTWQ6276S979215213546829jddshfjkhjBgdfg830GNZcVMXCXLSA7R87SDFBJ83Y9DSHKWVEASI48DSAF1356687DS987SD7FDF5SKMFGKE632SPIYEUYWQTRYA1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                                                            $rename = substr(str_shuffle($rand), 0, (4)). date("Y").substr(str_shuffle($rand), 0, (3)). date("m").substr(str_shuffle($rand), 0, (3)). date("d").substr(str_shuffle($rand), 0, (2)). date("h").substr(str_shuffle($rand), 0, (2)). date("i").substr(str_shuffle($rand), 0, (2)). date("s").".$ext";
                                                            $path = $path .$rename;

                                                            if(move_uploaded_file($_FILES['img']['tmp_name'], $path)) {
                                                                $df = "UPDATE `sub_categories` SET `name` = '$name', `image` = '$rename', `main_cat` = '$main_cat' WHERE `id` = '$cat_id'";
                                                                if ($db->query($df)) {
                                                                    if ($db->affected_rows == 1) {
                                                                        success("Changes were saved successfully.");
                                                                        unlink($paths);
                                                                    }else {
                                                                        error("No changes were made.");
                                                                    }
                                                                }else {
                                                                    error("Something went wrong. Contact Systems Suport.");
                                                                }
                                                            }else {
                                                                error("The was an eror whilst uploading the image.");
                                                            }
                                                        }else {
                                                            $df = "UPDATE `sub_categories` SET `name` = '$name', `main_cat` = '$main_cat' WHERE `id` = '$cat_id'";
                                                            if ($db->query($df)) {
                                                                if ($db->affected_rows == 1) {
                                                                    success("Changes were saved successfully.");
                                                                }else {
                                                                    error("No changes were made.");
                                                                }
                                                            }else {
                                                                error("Something went wrong. Contact Systems Suport.");
                                                            }
                                                        }
                                                    }
                                                }else {
                                                    $er[] = 'Bad practice has been detected.';
                                                }
                                            }
                                        }
                                    }
                                }else {
                                    error("Bad practice has been detected");
                                }
                                $cat_name = '';
                                $main_cat = '';
                            }
                            ?>
                            <h3 class="m-t-none m-b">Submit Sub Category's Details</h3>
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <select name="main_cat" class="form-control">
                                        <option value="<?php echo hide('e', 'null'); ?>">Select main category</option>
                                        <?php
                                        main_cat_dd($main_cat);
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Display image</label>
                                    <input type="file" class="form-control" name="file" required accept=".jpg, .png, .jpeg"/>
                                </div>
                                <div class="form-group"><input type="text" required placeholder="Sub-category's name" autocomplete='off' value="<?php echo  $cat_name; ?>" name="cat_name" class="form-control" /></div>
                                <div class="form-group"><button class="btn btn-sm btn-primary m-t-n-xs" name='submit_category' type="submit"><strong>Add to Sub-categories</strong></button></div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div id="hunter">
                        <?php include 'table__.php'; ?>
                    </div>
                    <tell id='order'>
                        <div class="modal fade" id='category' role="dialog">

                        </div>
                    </tell>
                </div>
                <?php foot(); ?>
            </div>
        </div>
    </div>
    <?php
    scripts();
    foreach ($er as $r) {
        error($r);
    }
    foreach ($suc as $r) {
        success($r);
    }
    ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/dataTables/datatables.min.js"></script>
    <script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv',  title: '<?php echo "$company_name sub-categories ". date('d F, Y') ; ?>'},
                {extend: 'excel', title: '<?php echo "$company_name sub-categories ". date('d F, Y') ; ?>'},
                {extend: 'pdf', title: '<?php echo "$company_name sub-categories ". date('d F, Y') ; ?>'},
                {extend: 'print',
                customize: function (win){
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');
                    $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                }
            }
        ]
    });
});
$(document).on('click', 'a[data-role=view-category]', function(){
    var id = $(this).data('id');
    $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
    $.ajax({
        url: 'cat.php',
        method: 'post',
        data: { id : id},
        success:function(response){
            $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
            $('#category').html(response);
        }
    });
});
</script>
</body>
</html>
