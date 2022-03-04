<?php
include '../heart/a.php';
secure('brands');
if (isset($_SERVER["CONTENT_LENGTH"])) {
    if ($_SERVER["CONTENT_LENGTH"] > ((int)ini_get('post_max_size') * 1024 * 1024)) {
        $_SESSION['JIsY77*0neY7Y77*07*fkgnjOInfgjUd8njdfjsdkdsjf*00(*7)'] = "<a href='$project_root_folder"."/brand/' class='btn btn-success waves-effect waves-light'><i class='fa fa-arrow-left mr-2'></i> Go Back</a>";
        header("location: ../error");
        exit;
    }
}
$brand = '';
$main_cat = '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | All $company_name's Brands"; ?> </title>
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
                            if (isset($_POST['save_brand'])) {
                                if (!empty($_FILES['file'])) {
                                    if($_FILES['file']["size"] > 0){
                                        if ($_FILES["file"]["size"] > 1*MB) {
                                            $er[] = ("The image should be less than or equal to 1MB. Compress it first then try again.");
                                        }else {
                                            if (!there('brand')) {
                                                $er[] = ("Bad practice has been detected.");
                                            }else {
                                                $s = 0;
                                                $brand = clean($_POST['brand']);
                                                $filename = $_FILES['file']['name'];
                                                $ext = mb_strtolower(clean(pathinfo($filename, PATHINFO_EXTENSION)));
                                                $extensions = ['png', 'jpg', 'jpeg'];
                                                if (!in_array($ext, $extensions)) {
                                                    $er[] = ("<b>$ext</b> files are not allowed.");
                                                    $s = 20;
                                                }
                                                if (empty($brand)) {
                                                    $er[] = ("Submit brand name.");
                                                    $s = 20;
                                                }elseif (strlen($brand) < 3) {
                                                    $er[] = ("The brand\'s name has to be greater than 3 characters in length.");
                                                    $s = 20;
                                                }elseif (!ls($brand)){
                                                    $er[] = ("Only letters and spaces are allowed.");
                                                    $s = 20;
                                                }elseif (strlen($brand) > 15) {
                                                    $er[] = ("The brand\'s name has to be less than 15 characters in length.");
                                                    $s = 20;
                                                }elseif (mysqli_num_rows(r("SELECT `id` FROM `brands` WHERE `name` = '$brand'")) != 0) {
                                                    $name = ucwords(mb_strtolower($brand));
                                                    $er[] = ("$name is already registered.");
                                                    $s = 20;
                                                }
                                                if ($s == 0) {
                                                    $path = "../../img/brands/";
                                                    $rand = ('SJASDIOdshfjkhjBgdfg830GNZcVMXCXLSA7R87SDFSDJDSF989AF1356687DS987JSADHOUIO855634567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                                                    $rename = substr(str_shuffle($rand), 0, (4)). date("Y").substr(str_shuffle($rand), 0, (3)). date("m").substr(str_shuffle($rand), 0, (3)). date("d").substr(str_shuffle($rand), 0, (2)). date("h").substr(str_shuffle($rand), 0, (2)). date("i").substr(str_shuffle($rand), 0, (2)). date("s").".$ext";
                                                    $path = $path .$rename;
                                                    if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                                                        $name = ucwords(mb_strtolower($brand));
                                                        $df = "INSERT INTO `brands`(`name`, `image`, `status`) VALUES ('$name', '$rename', 'ACTIVE')";
                                                        if (r($df)) {
                                                            $suc[] = ("$name has been added successfully.");
                                                        }else {
                                                            $er[] = ("Something went wrong.");
                                                        }
                                                    }else {
                                                        $er[] = ("The was an eror whilst uploading the image.");
                                                    }
                                                }
                                            }
                                        }
                                    }else {
                                        $er[] = ("Submit the image for the product.");
                                    }
                                }else {
                                    $er[] = ("Bad practice has been detected");
                                }
                            }
                            if (isset($_POST['edit_brand'])) {
                                if (!empty($_FILES['file'])) {
                                    if($_FILES['file']["size"] >= 0){
                                        if ($_FILES["file"]["size"] > MB) {
                                            error("The image should be less than or equal to 1MB. Compress it first then try again.");
                                        }else {
                                            if (!there('brand') || !there('brand_id')) {
                                                $er[] = ("Bad practice has been detected.");
                                            }else {
                                                $s = 0;
                                                $brand = mb_strtoupper(clean($_POST['brand']));
                                                $brand_id = clean(hide('d', $_POST['brand_id']));
                                                if (mysqli_num_rows(r("SELECT `id` FROM `brands` WHERE `id` = '$brand_id'")) == 1) {
                                                    if ($_FILES['file']["size"] > 0) {
                                                        $filename = $_FILES['file']['name'];
                                                        $ext = mb_strtolower(clean(pathinfo($filename, PATHINFO_EXTENSION)));
                                                        $extensions = ['png', 'jpg', 'jpeg'];
                                                        if (!in_array($ext, $extensions)) {
                                                            $er[] = ("<b>$ext</b> files are not allowed.");
                                                            $s = 20;
                                                        }
                                                    }
                                                    if (empty($brand)) {
                                                        $er[] = ("Submit brand name.");
                                                        $s = 20;
                                                    }elseif (strlen($brand) < 3) {
                                                        $er[] = ("The brand\'s name has to be greater than 3 characters in length.");
                                                        $s = 20;
                                                    }elseif (!ls($brand)){
                                                        $er[] = ("Only letters and spaces are allowed.");
                                                        $s = 20;
                                                    }elseif (strlen($brand) > 15) {
                                                        $er[] = ("The brand\'s name has to be less than 15 characters in length.");
                                                        $s = 20;
                                                    }elseif (mysqli_num_rows(r("SELECT `id` FROM `brands` WHERE `name` = '$brand' AND `id` != '$brand_id'")) != 0) {
                                                        $name = ucwords(mb_strtolower($brand));
                                                        $er[] = ("$name is already registered.");
                                                        $s = 20;
                                                    }
                                                    if ($s == 0) {
                                                        $n = date('Y-m-d H:i:s');
                                                        $name = ucwords(mb_strtolower($brand));
                                                        if ($_FILES['file']["size"] > 0) {
                                                            $path = "../../img/brands/";
                                                            $paths = $path .pull('image', 'brands', "`id` = '$brand_id'");
                                                            $rand = ('SJASDIOdshfjkhjBgdfg830GNZcVMXCXLSA7R87SDFSDJDSF989AF1356687DS987JSADHOUIO855634567890ABCDEFGHIJKLMNOPQRSTUVWXYZ');
                                                            $rename = substr(str_shuffle($rand), 0, (4)). date("Y").substr(str_shuffle($rand), 0, (3)). date("m").substr(str_shuffle($rand), 0, (3)). date("d").substr(str_shuffle($rand), 0, (2)). date("h").substr(str_shuffle($rand), 0, (2)). date("i").substr(str_shuffle($rand), 0, (2)). date("s").".$ext";
                                                            $path = $path .$rename;
                                                            if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
                                                                $df = "UPDATE `brands` SET `name` = '$name', `image` = '$rename' WHERE `id` = '$brand_id'";
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
                                                            $df = "UPDATE `brands` SET `name` = '$name' WHERE `id` = '$brand_id'";
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
                                $brand = '';
                                $main_cat = '';
                            }
                            ?>
                            <h3 class="m-t-none m-b text-navy">Add a new brand</h3>
                            <form role="form" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file" required accept=".jpg, .png, .jpeg"/>
                                </div>
                                <div class="form-group"><input type="text" required placeholder="Brand's name" autocomplete='off' value="<?php echo  $brand; ?>" name="brand" class="form-control" /></div>
                                <div class="form-group"><button class="btn btn-sm btn-primary m-t-n-xs" name='save_brand' type="submit"><strong>Save</strong></button></div>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div id="hunter">
                        <?php include 'table__.php'; ?>
                    </div>
                    <tell id='order'>
                        <div class="modal fade" id='brander' role="dialog">

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
                {extend: 'csv',  title: '<?php echo "$company_name brands as at ". date('d F, Y') ; ?>'},
                {extend: 'excel', title: '<?php echo "$company_name brands as at ". date('d F, Y') ; ?>'},
                {extend: 'pdf', title: '<?php echo "$company_name brands as at ". date('d F, Y') ; ?>'},
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
$(document).on('click', 'a[data-role=view-brand]', function(){
    var id = $(this).data('id');
    $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
    $.ajax({
        url: 'cat.php',
        method: 'post',
        data: { id : id},
        success:function(response){
            $('#ibox1').children('.ibox-content').toggleClass('sk-loading');
            $('#brander').html(response);
        }
    });
});
</script>
</body>
</html>
