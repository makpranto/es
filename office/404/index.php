<!DOCTYPE html>
<html>
<?php
include '../heart/heart.php';
include '../heart/func.php';

 ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucwords($project_name); ?> | Page not found</title>
    <link rel="icon" type="image/x-icon" href="<?php echo "$icon"; ?>">
    <link href="<?php echo "$project_root_folder"; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo "$project_root_folder"; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo "$project_root_folder"; ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo "$project_root_folder"; ?>/css/style.css" rel="stylesheet">
</head>
<body class="gray-bg">
    <div class="middle-box text-center animated fadeInDown">
        <center>
            <img src="<?php echo "$ikon"; ?>" alt="" style="width: 170px">
        </center>
        <h3 class="font-bold">Page Not Found</h3>

        <div class="error-desc">
            Sorry, but the page you are looking for has not been found. Try checking the URL for an error. <br><br><br>
            <a href="<?php echo "$project_root_folder"; ?>" class="btn btn-primary">Return</a>
        </div>
    </div>
    <script src="<?php echo "$project_root_folder"; ?>/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/bootstrap.min.js"></script>
</body>
</html>
