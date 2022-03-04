<?php
include '../a/fun.php';
if (isset($_COOKIE[$kook])) {
    setcookie($kook, hide('e', hide('e', hide('e', hide('e', $user_id)))), time()+60*24*60*60);
    $_COOKIE[$kook] = hide('e', hide('e', hide('e', hide('e', $user_id))));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="APISE is company which was established to carry on business as an online shop and trading hub which trade goods and services electronically locally and globally. We aim to meet and exceed customers expectations by delivering goods timely and efficiently. Customer satisfaction is at the at the core of our business.">
	<title>apise.shop | About Us</title>
	<meta name="keywords" content="apise.shop apise shop">
    <?php style(); ?>
</head>
<body>
    <?php nav(); ?>
    <section class="section-padding bg-dark inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">About Us</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white"><a class="text-white" href="../">Home</a> / <span class="text-success">About Us</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding bg-white">
        <div class="container">
            <div class="row">
                <div class="pl-4 col-lg-5 col-md-5 pr-4">
                    <img class="rounded img-fluid" src="<?php echo "$home"; ?>img/d.jpg" width="350px">
                </div>
                <div class="col-lg-6 col-md-6 pl-5 pr-5">
                    <h5 class="mt-2 text-secondary">About APISE</h5>
                    <p>APISE is company which was established to carry on business as an online shop and trading hub which trade goods and services electronically locally and globally. We aim to meet and exceed customers expectations by delivering goods timely and efficiently. Customer satisfaction is at the at the core of our business.</p>
                </div>
            </div>
        </div>
    </section>
    <?php foot();script(); ?>
</body>
</html>
