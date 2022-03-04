<nav class="navbar-default navbar-static-side" role="navigation" style="position: fixed;overflow-y: scroll; height:100%;" >
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle">
                                <span class="block m-t-xs">
                                    <strong class="font-bold"><?php echo "$user_name "; ?> </strong>
                                </span>
                                <span class="text-muted text-xs block"><?php echo "$company_name"; ?> </span>
                            </a>
                        </div>
                        <div class="logo-element">
                            <img src="<?php echo "$icon"; ?>" alt="" style="width: 45px">
                        </div>
                    </li>
                    <?php include 'custom_nav.php'; ?>
                    </ul>
                </div>
            </nav>
