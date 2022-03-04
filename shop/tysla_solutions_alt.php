<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>apise.shop - Page not found</title>
    <?php style(); ?>
</head>

<body>
    <?php nav(); ?>
    <section class="not-found-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center  pt-4 pb-5">
                    <h1>404</h1>
                    <h1>Sorry! Page not found.</h1>
                    <p class="land">Unfortunately the <?php echo "$lost"; ?> you are looking for has been moved or deleted.</p>
                    <div class="mt-5">
                        <a href="<?php echo "$home"; ?>" class="btn btn-success btn-lg"><i class="mdi mdi-home"></i> GO TO HOME PAGE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php foot(); script(); ?>
</body>
</html>
