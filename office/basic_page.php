<?php
include '../heart/a.php';
secure('manage_categories');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | All $company_name's Categories"; ?> </title>
    <?php style(); ?>
</head>
<body>
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <div class="ibox-content">
                    <div class="row">

                    </div>
                </div>
                <?php foot(); ?>
            </div>
        </div>
    </div>
    <?php scripts(); ?>
</body>
</html>
