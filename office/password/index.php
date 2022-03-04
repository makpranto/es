<?php
include '../heart/a.php';
if (!isset($user_id)) {
    header("location: ../");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name | Change Password"; ?> </title>
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
                    <form role="form" method="POST">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <input type="password" name="now" class="form-control"  placeholder="Current Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="then" class="form-control"  placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="so" class="form-control example3"  placeholder="Confirm Password">
                                </div>
                                <div class="form-group" >
                                    <button style="background-color: #1AB394; color: white" class="form-control example3"  type="submit" name="change">Change Password</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <?php foot(); ?>
            </div>
        </div>
    </div>
    <?php scripts(); ?>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/toastr/toastr.min.js"></script>
    <script src="<?php echo "$project_root_folder"; ?>/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>
    <?php
    if (isset($_POST['change'])) {
        if (!isset($_POST['now']) || !isset($_POST['then']) || !isset($_POST['so'])) {
            error('Oops! That did not work.');
        }else {
            $now = $_POST['now'];
            $then = $_POST['then'];
            $so = $_POST['so'];
            if (empty($now) || empty($then) || empty($so)) {
                error('Please fill in all fields');
            }elseif (!password_verify($now, $user_password)) {
                error('Wrong current password.');
            }elseif (!preg_match("^(?=.*?[A-Z])(?=.*?[0-9])(?=.*?[a-z]).{8,}^", $then) ) {
                error("Passsword should contain upper and lower case letters, one number and 1 special character and should be 8 and above in length.");
            }elseif (password_verify($then, $user_password)) {
                error("You cannot use this password.");
            }elseif ($then != $so) {
                error("The two passwords do not match.");
            }else {
                $n = date('Y-m-d H:i:s');
                $so = password_hash($so, PASSWORD_DEFAULT);
                $d = "UPDATE `chikwata` SET `password` = '$so', `last_password_change_date` = '$n' WHERE `id` = '$user_id'";
                if (r($d)) {
                    success("Dear $user_name, your password has been changed.");
                }else {
                    echo "$d";;
                }
            }
        }
    }
    ?>
</body>
</html>
