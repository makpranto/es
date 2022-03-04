<?php
// <!-- <div class="navbar-top bg-success pt-2 pb-2">
// <div class="container-fluid">
// <div class="row">
// <div class="col-lg-12 text-center">
// <a href="shop.html" class="mb-0 text-white">
// 10% cashback for new users | Code: <strong><span class="text-light">OGOFERS13 <span class="mdi mdi-tag-faces"></span></span> </strong>
// </a>
// </div>
// </div>
// </div>
// </div> -->
?>
<nav class="navbar navbar-light navbar-expand-lg bg-faded osahan-menu" style="background-color: gray;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo "$home"; ?>"> <img src="<?php echo "$logo"; ?>" width='140px'> </a>
        <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse" id="navbarNavDropdown">

            <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
                <div class="top-categories-search">
                    <?php if (url() != $home.'Mu3exb8o/'): ?>
                        <form  action="<?php echo "$home"; ?>Mu3exb8o/" method="get">
                            <div class="input-group">
                                <input class="form-control product_finder" placeholder="Type to search"  type="text" autocomplete="off" name='q'>
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="submit"><i class="mdi mdi-file-find"></i> Find</button>
                                </span>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="my-2 my-lg-0">
                <ul class="list-inline main-nav-right">
                    <?php
                    //     <!-- <li class="">
                    //     <a href="#" data-target="#bd-example-modal" data-toggle="modal" class="btn btn-link"> </a>
                    // </li> -->
                    ?>
                    <li class=" list-inline-item dropdown">
                        <a class="text-white dropdown-toggle " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="mdi mdi-account-circle"></i> <strong>Hi</strong>
                            <?php
                            global $user_name, $phone;
                            if (empty($phone)) {

                            }else {
                                echo "$user_name";
                            }
                            ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="my-profile.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> My Profile</a>
                            <a class="dropdown-item" href="my-address.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> My Address</a>
                            <a class="dropdown-item" href="wishlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Wish List </a>
                            <a class="dropdown-item" href="orderlist.html"><i class="mdi mdi-chevron-right" aria-hidden="true"></i> Order List</a>
                        </div>
                    </li>
                    <li class="list-inline-item cart-btn">
                        <a href="#" data-toggle="offcanvas" class="btn btn-link border-none"><i class="mdi mdi-cart"></i> My Cart <small class="cart-value" id="cvbv"></small></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light osahan-menu-2 pad-none-mobile">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto">
                <li class="nav-item">
                    <a href="<?php echo $home; ?>" class="nav-link shop"><span class="mdi mdi-store"></span>Home</a>
                </li>
                <?php
                $sd = r("SELECT * FROM `categories` WHERE `status` = '1' LIMIT 5");
                while ($a = get($sd)) {
                    $name = $a['name'];
                    $link = $home.'categories/'.linker('o', $name)."/";
                    $id = $a['id'];
                    $fg = r("SELECT * FROM `sub_categories` WHERE `main_cat` = '$id' ORDER BY `name` ASC");
                    if (mysqli_num_rows($fg) > 0) {
                        echo "<li class='nav-item dropdown'>
                        <a class=\"nav-link dropdown-toggle shop\" href='#' onclick=\"window.location.href='$link'\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        $name
                        </a>
                        <div class=\"dropdown-menu\">
                        ";
                        while ($z = get($fg)) {
                            $names = $z['name'];
                            $l = $home.'categories/'.linker('o', $names).'/';
                            echo "<a class=\"dropdown-item\" href=\"$l\"> $names</a>";
                        }
                        echo "</div></li>";
                    }else {
                        echo "
                        <li class='nav-item'>
                        <a class='nav-link shop' href='$home".'categories/'.linker('o', $name)."/'>$name</a>
                        </li>";
                    }
                }
                ?>
                <?php
                $sd = r("SELECT * FROM `categories` WHERE `status` = '1' LIMIT 5, 30");
                echo "<li class=\"nav-item dropdown\">
                <a class=\"nav-link dropdown-toggle shop\" href=\"#\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                More Categories
                </a>
                <div class=\"dropdown-menu\">";
                while ($a = get($sd)) {
                    $link = $a['link'];
                    $name = $a['name'];
                    $id = $a['id'];
                    $l = $home.'categories/'.linker('o', $name).'/';
                    echo "<a class=\"dropdown-item\" href=\"$l\"> $name</a>";
                }
                ?>
            </div>    </li>
            <li class="nav-item">
                <a href="http://enfield.co.zw" class="nav-link" target="_blank">Company</a>
            </li>
            <?php global $project_main_session_name; if (isset($_SESSION[$project_main_session_name])): ?>
                <li class="nav-item">
                    <a class="nav-link" target="_blank" href="<?php echo "$home"; ?>office/" >
                        Back Office
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
</nav>
