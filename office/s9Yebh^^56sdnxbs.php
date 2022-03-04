<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo ucwords($project_name); ?> | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo "$icon"; ?>"/>
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo "$project_root_folder"; ?>/css/main.css">
    <?php require('heart/styles.php'); ?>
</head>
<body class="gray-bg">
	<div class="middle-box text-center  animated fadeInDown">
        <div>
            <div>
				<?php include 'heart/errors.php'; ?>
                <img src="img/enfield-logo.png" alt="" style="width: 230px">
            </div>
            <form class="m-t" role="form" method="post">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username" required="">
                </div>
                <div class="form-group">
                    <input  type="password" name="pass" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" name="login" class="btn btn-primary block full-width m-b">Login</button>
            </form>
		</div>
	</div>
	<?php require('heart/scripts.php'); ?>
	<?php require('heart/errors.php'); ?>
</body>
</html>
