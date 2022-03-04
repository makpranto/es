<!DOCTYPE html>
<html>
<?php
include '../heart/heart.php';
include '../heart/func.php';
if (!isset($_SESSION['JIsY77*0neY7Y77*07*fkgnjOInfgjUd8njdfjsdkdsjf*00(*7)'])) {
    include '../404/rimwe.php';
    exit;
}
 ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords($project_name); ?> | File too big</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $icon; ?>">
    <link href="<?php echo "$project_root_folder"; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo "$project_root_folder"; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo "$project_root_folder"; ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo "$project_root_folder"; ?>/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
        <h3 class="font-bold">Sorry but the file you uploaded is too big</h3>
        <h1>
            <i class="fa fa-file text-danger"></i>
        </h1>
        <div class="error-desc">
            The file you are trying to upload is too big. Please compress it and then try again
            <br><br><br>
            <?php echo $_SESSION['JIsY77*0neY7Y77*07*fkgnjOInfgjUd8njdfjsdkdsjf*00(*7)']; ?>
        </div>
    </div>
    <script src="<?php echo "$project_root_folder"; ?>/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/bootstrap.min.js"></script>
</body>
</html>
<?php unset($_SESSION['JIsY77*0neY7Y77*07*fkgnjOInfgjUd8njdfjsdkdsjf*00(*7)']); ?>
