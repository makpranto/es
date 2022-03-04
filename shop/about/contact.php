<?php
include '../a/fun.php';
$name = '';
$sur = '';
$mail = '';
$add = '';
$cit = '';
$ph = '';
$code = '';
$pay = '';
if (!empty($phone)) {
    $a = get(r("SELECT * FROM `customers` WHERE `id` = '$user_id'"));
    $name = hide('d', $a['name']);
    $sur = hide('d', $a['surname']);
    $mail = hide('d', $a['email_address']);
    $add = hide('d', $a['street_address']);
    $cit = hide('d', $a['town']);
    $ph = hide('d', $a['phone']);
    $ph = preg_replace('/\D/', '', $ph);
    $ph = strrev(substr($ph, -9));
    $ph = strrev($ph);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Askbootstrap">
    <meta name="author" content="Askbootstrap">
    <title>apise.shop | Contact us</title>
    <?php style(); ?>
</head>
<body>
    <?php nav(); ?>
    <section class="section-padding bg-dark inner-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="mt-0 mb-3 text-white">Contact Us</h1>
                    <div class="breadcrumbs">
                        <p class="mb-0 text-white"><a class="text-white" href="<?php echo "$home"; ?>">Home</a> / <span class="text-success">Contact Us</span></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <h3 class="mt-1 mb-5">Get In Touch</h3>
                    <h6 class="text-dark"><i class="mdi mdi-home-map-marker"></i> Address :</h6>
                    <p>Room 2 Manson Court<br>Selous Avenue, Harare Zimbabwe</p>
                    <h6 class="text-dark"><i class="mdi mdi-phone"></i> Phone :</h6>
                    <p><a href="tel:<?php echo "$business_phone"; ?>"><?php echo "$business_phone"; ?></a>, <a href="tel:<?php echo "$business_phone_two"; ?>"><?php echo "$business_phone_two"; ?></a> </p>
                    <h6 class="text-dark"><i class="mdi mdi-email"></i> Email :</h6>
                    <p><a href="mailto:<?php echo "$business_email"; ?>"><?php echo "$business_email"; ?></a></p>
                    <div class="footer-social"><span>Follow : </span>
                        <a href="https://www.facebook.com/Apiseshop-100961622072243/" target="_blank"><i class="mdi mdi-facebook"></i></a></li>
                        <a href="https://api.whatsapp.com/send?phone=<?php  echo "$whatsapp_number"; ?>" target="_blank"><i class="mdi mdi-whatsapp"></i></a></li>
                        <a href="https://www.instagram.com/apise.shop/"><i class="mdi mdi-instagram" target="_blank"></i></a></li>
                        <a href="https://twitter.com/ApiseShop/"><i class="mdi mdi-twitter" target="_blank"></i></a></li>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12 col-md-12 section-title text-left mb-4">
                                <h2>Email Us</h2>
                            </div>
                            <?php
                                if (isset($_POST['send'])) {
                                    if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['text']) || !there('d') || (there('d') && !empty($_POST['d']))) {
                                        echo "<div class='alert alert-danger alert-dismissable'>
                                        Hi Edward Snowden ;)
                                        </div>";
                                    }else {
                                        function text($h){
                                            $h = str_replace('\r', '<br>', $h);
                                            return $h;
                                        }
                                        $name = word(clean($_POST['name']));
                                        $email = mb_strtolower(clean($_POST['email']));
                                        $phone = word(clean($_POST['phone']));
                                        $text = text(cleaned($_POST['text']));
                                        if (empty($name) || empty($email) || empty($phone) || empty($text)) {
                                            echo "<div class='alert alert-danger alert-dismissable'>
                                            All fields are required.
                                            </div>";
                                        }elseif (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
                                            echo "<div class='alert alert-danger alert-dismissable'>
                                            Submit a valid name.
                                            </div>";
                                        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                            echo "<div class='alert alert-danger alert-dismissable'>
                                            Submit a valid email address.
                                            </div>";
                                        }else {
                                            require '../a/php-mailer/PHPMailerAutoload.php';
                                            $mail = new PHPMailer;
                                            $mail->IsSMTP();
                                            $mail->Host = 'mail.apise.shop';
                                            $mail->Port = 587;
                                            $mail->SMTPAuth = true;
                                            $mail->Username = $tysla_email;
                                            $mail->Password = $tysla_password;
                                            // $mail->SMTPSecure = 'tls';
                                            $mail->SetFrom("$tysla_email", 'Tysla Solutions');
                                            $mail->AddReplyTo("$email", $name);
                                            $mail->AddAddress("customerinfo@apise.shop", 'apise.shop Customer Iformation');
                                            $mail->IsHTML(true);
                                            $mail->Subject = "Enquiry";
                                            $mail->Body = "<!DOCTYPE html>
                                            <html lang=\"en\" xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:o=\"urn:schemas-microsoft-com:office:office\">
                                            <head>
                                                <meta charset=\"utf-8\">
                                                <meta name=\"viewport\" content=\"width=device-width\">
                                                <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
                                                <meta name=\"x-apple-disable-message-reformatting\">
                                                <title></title>
                                                <link href=\"https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700\" rel=\"stylesheet\">
                                                <style>
                                                    html,
                                                    body {
                                                        margin: 0 auto !important;
                                                        padding: 0 !important;
                                                        height: 100% !important;
                                                        width: 100% !important;
                                                        background: #f1f1f1;
                                                    }
                                                    * {
                                                        -ms-text-size-adjust: 100%;
                                                        -webkit-text-size-adjust: 100%;
                                                    }
                                                    div[style*=\"margin: 16px 0\"] {
                                                        margin: 0 !important;
                                                    }
                                                    table,
                                                    td {
                                                        mso-table-lspace: 0pt !important;
                                                        mso-table-rspace: 0pt !important;
                                                    }
                                                    table {
                                                        border-spacing: 0 !important;
                                                        border-collapse: collapse !important;
                                                        table-layout: fixed !important;
                                                        margin: 0 auto !important;
                                                    }
                                                    img {
                                                        -ms-interpolation-mode: bicubic;
                                                    }
                                                    a {
                                                        text-decoration: none;
                                                    }
                                                    *[x-apple-data-detectors],
                                                    .unstyle-auto-detected-links *,
                                                    .aBn {
                                                        border-bottom: 0 !important;
                                                        cursor: default !important;
                                                        color: inherit !important;
                                                        text-decoration: none !important;
                                                        font-size: inherit !important;
                                                        font-family: inherit !important;
                                                        font-weight: inherit !important;
                                                        line-height: inherit !important;
                                                    }
                                                    .a6S {
                                                        display: none !important;
                                                        opacity: 0.01 !important;
                                                    }
                                                    .im {
                                                        color: inherit !important;
                                                    }
                                                    img.g-img+div {
                                                        display: none !important;
                                                    }
                                                    @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
                                                        u~div .email-container {
                                                            min-width: 320px !important;
                                                        }
                                                    }
                                                    @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
                                                        u~div .email-container {
                                                            min-width: 375px !important;
                                                        }
                                                    }
                                                    @media only screen and (min-device-width: 414px) {
                                                        u~div .email-container {
                                                            min-width: 414px !important;
                                                        }
                                                    }
                                                    .primary {
                                                        background: #17bebb;
                                                    }
                                                    .bg_white {
                                                        background: #ffffff;
                                                    }
                                                    .bg_light {
                                                        background: #f7fafa;
                                                    }
                                                    .bg_black {
                                                        background: #000000;
                                                    }
                                                    .bg_dark {
                                                        background: rgba(0, 0, 0, .8);
                                                    }

                                                    .email-section {
                                                        padding: 2.5em;
                                                    }

                                                    /*BUTTON*/
                                                    .btn {
                                                        padding: 10px 15px;
                                                        display: inline-block;
                                                    }

                                                    .btn.btn-primary {
                                                        border-radius: 5px;
                                                        background: #17bebb;
                                                        color: #ffffff;
                                                    }

                                                    .btn.btn-white {
                                                        border-radius: 5px;
                                                        background: #ffffff;
                                                        color: #000000;
                                                    }

                                                    .btn.btn-white-outline {
                                                        border-radius: 5px;
                                                        background: transparent;
                                                        border: 1px solid #fff;
                                                        color: #fff;
                                                    }

                                                    .btn.btn-black-outline {
                                                        border-radius: 0px;
                                                        background: transparent;
                                                        border: 2px solid #000;
                                                        color: #000;
                                                        font-weight: 700;
                                                    }

                                                    .btn-custom {
                                                        color: rgba(0, 0, 0, .3);
                                                        text-decoration: underline;
                                                    }

                                                    h1,
                                                    h2,
                                                    h3,
                                                    h4,
                                                    h5,
                                                    h6 {
                                                        font-family: 'Poppins', sans-serif;
                                                        color: #000000;
                                                        margin-top: 0;
                                                        font-weight: 400;
                                                    }

                                                    body {
                                                        font-family: 'Poppins', sans-serif;
                                                        font-weight: 400;
                                                        font-size: 15px;
                                                        line-height: 1.8;
                                                        color: rgba(0, 0, 0, .4);
                                                    }

                                                    a {
                                                        color: #17bebb;
                                                    }

                                                    table {}

                                                    /*LOGO*/

                                                    .logo h1 {
                                                        margin: 0;
                                                    }

                                                    .logo h1 a {
                                                        color: #17bebb;
                                                        font-size: 24px;
                                                        font-weight: 700;
                                                        font-family: 'Poppins', sans-serif;
                                                    }

                                                    /*HERO*/
                                                    .hero {
                                                        position: relative;
                                                        z-index: 0;
                                                    }

                                                    .hero .text {
                                                        color: rgba(0, 0, 0, .3);
                                                    }

                                                    .hero .text h2 {
                                                        color: #000;
                                                        font-size: 34px;
                                                        margin-bottom: 0;
                                                        font-weight: 200;
                                                        line-height: 1.4;
                                                    }

                                                    .hero .text h3 {
                                                        font-size: 24px;
                                                        font-weight: 300;
                                                    }

                                                    .hero .text h2 span {
                                                        font-weight: 600;
                                                        color: #000;
                                                    }

                                                    .text-author {
                                                        bordeR: 1px solid rgba(0, 0, 0, .05);
                                                        max-width: 50%;
                                                        margin: 0 auto;
                                                        padding: 2em;
                                                    }

                                                    .text-author img {
                                                        border-radius: 50%;
                                                        padding-bottom: 20px;
                                                    }

                                                    .text-author h3 {
                                                        margin-bottom: 0;
                                                    }

                                                    ul.social {
                                                        padding: 0;
                                                    }

                                                    ul.social li {
                                                        display: inline-block;
                                                        margin-right: 10px;
                                                    }

                                                    /*FOOTER*/

                                                    .footer {
                                                        border-top: 1px solid rgba(0, 0, 0, .05);
                                                        color: rgba(0, 0, 0, .5);
                                                    }

                                                    .footer .heading {
                                                        color: #000;
                                                        font-size: 20px;
                                                    }

                                                    .footer ul {
                                                        margin: 0;
                                                        padding: 0;
                                                    }

                                                    .footer ul li {
                                                        list-style: none;
                                                        margin-bottom: 10px;
                                                    }

                                                    .footer ul li a {
                                                        color: rgba(0, 0, 0, 1);
                                                    }


                                                    @media screen and (max-width: 500px) {}
                                                </style>
                                            </head>

                                            <body width=\"100%\" style=\"margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;\">
                                                <center style=\"width: 100%; background-color: #f1f1f1;\">
                                                    <div style=\"display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;\">
                                                    </div>
                                                    <div style=\"max-width: 600px; margin: 0 auto;\" class=\"email-container\">

                                                        <table align=\"left\" role=\"presentation\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\" style=\"margin: auto;\">

                                                            <tr>
                                                                <td valign=\"middle\" class=\"hero bg_white\" style=\"padding: 2em 0 4em 0;\">
                                                                    <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                                                                        <tr>
                                                                            <td style=\"padding: 0 2.5em; text-align: left; padding-bottom: 3em;\">
                                                                                <div class=\"text\">
                                                                                    <h2 style='color: #008080'>Hello apise.shop</h2>
                                                                                    <span style=\"text-align: left\">
                                                                                        <p> $name ($email) who uses $phone has left the message below.
                                                                                        <p><strong>$text</text></p>
                                                                                    </span>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td  class=\"bg_white\" style=\"padding: 1em 2.5em 0 2.5em;\">
                                                                                <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
                                                                                    <tr>
                                                                                        <p>Regards. <br> <b>Tysla at apise.shop</b>
                                                                                        <br>
                                                                                        28 Drury Ln Strathaven, Harare, Zimbabwe <br>
                                                                                        7874 49 017<br>
                                                                                        <a href=\"mailto:tysla@apise.shop\">tysla@apise.shop</a></p>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </center>
                                            </body>
                                            </html>
                                            ";
                                            if(!$mail->Send()) {
                                                echo "<div class='alert alert-danger alert-dismissable'>
                                                Something went wrong. Please try again.
                                                </div>";
                                            }else {
                                                echo "<div class='alert alert-success alert-dismissable'>
                                                Thank you $name for the message. We will be in touch shortly.
                                                </div>";
                                                echo '<script type="text/javascript">
                                                if ( window.history.replaceState ) {
                                                    window.history.replaceState( null, null, window.location.href );
                                                }
                                                </script>';
                                                $name = $email = $phone = $text = '';
                                            }
                                        }
                                    }

                                }
                                ?>
                            <form class="col-lg-12 col-md-12" name="sentMessage" method='post'>
                                <div class="control-group form-group">
                                    <div class="controls">
                                        <label>Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" placeholder="Full Name" class="form-control" value="<?php echo "$name $sur"; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="control-group form-group col-md-6">
                                        <label>Phone Number <span class="text-danger">*</span></label>
                                        <div class="controls">
                                            <input type="text" placeholder="Phone Number" name="phone" class="form-control" value="<?php echo "$phone"; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <div class="controls">
                                            <label>Email Address <span class="text-danger">*</span></label>
                                            <input type="email" name="email" placeholder="Email Address" class="form-control" value="<?php echo "$email"; ?>">
                                            <input name="d" style="display: none">
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <div class="controls">
                                        <label>Message <span class="text-danger">*</span></label>
                                        <textarea rows="4" name="text" cols="100" placeholder="Message" class="form-control" data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                                    </div>
                                </div>
                                <div id="success"></div>
                                <button type="submit" class="btn btn-success" name="send">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php foot(); ?>
</body>
</html>
