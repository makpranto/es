<?php global $base_currency; ?>
<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0; background-color: #f3f3f4">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#" ><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li>
                <span class="m-r-sm text-muted welcome-message">Good <?php echo "$greeting <b>$user_name</b>."; ?></span>
            </li>
            <li>
                <a href="<?php echo "$project_root_folder/password"; ?>">
                    <i class="fa fa-key"></i>
                </a>
            </li>
            <li id='cc'>
                <a href="#" onclick="return change_currency();">
                    <i class="fa fa-money"></i><?php echo pull('name', 'payment_methods', "`id` = '$base_currency'"); ?>
                </a>
            </li>
            <li>
                <a href="<?php echo "$project_root_folder/out"; ?>">
                    <i class="fa fa-sign-out"></i>Logout
                </a>
            </li>
        </ul>
    </nav>
</div>
