<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | ".ucwords($project_name); ?> </title>
    <?php include 'heart/styles.php'; ?>
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <?php nav(); ?>
        <div id="page-wrapper" class="gray-bg">
            <?php top_bar(); ?>
            <div class="wrapper wrapper-content">
                <?php if (access($user_id, 'main_page_widgets')): ?>
                <div class="row">
                    <?php if (access($user_id, 'sell')): ?>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right"><?php echo date('F, Y'); ?></span>
                                    <h5>Total Sales</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo "$$total_revenue"; ?>
                                    </h1>
                                    <small>_____________________________________</small>
                                </div>
                            </div>
                        </div>

                    <?php endif; ?>
                    <?php if (access($user_id, 'discount')): ?>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-info pull-right"><?php echo date('F, Y'); ?></span>
                                    <h5>Discount</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo "$".amount($total_discount); ?></h1>
                                    <small>_____________________________________</small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (access($user_id, 'sell')): ?>
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <span class="label label-primary pull-right">Today</span>
                                    <h5>Sales</h5>
                                </div>
                                <div class="ibox-content">
                                    <h1 class="no-margins"><?php echo "$$total_reve"; ?></h1>
                                    <small>_____________________________________</small>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (1==1): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Sales & Purchase Chart
                                        <small><?php echo date("d, F Y"); ?></small>
                                    </h5>
                                </div>
                                <div class="ibox-content">
                                    <div>
                                        <canvas id="lineChart" ></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-md-12">
                        <center>
                            <img src="img/retail_logo.png" alt="" style="width: 400px">
                        </center>
                    </div>
                <?php endif; ?>
            </div>
            <?php foot(); ?>
        </div>
    </div>
    <?php scripts(); ?>
</body>
</html>
