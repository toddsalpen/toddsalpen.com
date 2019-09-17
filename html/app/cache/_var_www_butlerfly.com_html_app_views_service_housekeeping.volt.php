<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    
    <title>ButlerFly - <?php echo $name; ?> Services</title>
    <meta name="description" content="<?php echo $desc; ?>">

    <?php echo $this->assets->outputCss('header'); ?>
    <link href="https://www.butlerfly.com/img/logos/favicon.png" rel="icon" type="image/png" sizes="32x32" >
</head>
<body id="page-top" class="index">

<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="https://www.butlerfly.com/">
                <img class="logo-img" src="https://www.butlerfly.com/img/logos/logo.png" alt="Butlerfly.com" />
            </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a target="_blank" href="https://www.facebook.com/helpnearyou" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a></li>
                <li><a target="_blank" href="https://plus.google.com/u/0/b/116065948040885082489/116065948040885082489" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a></li>
                <li><a target="_blank" href="https://twitter.com/helpnearyou" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a></li>
                <li><a target="_blank" href="https://www.youtube.com/channel/UCtg2EWLusxTUkPzhFK5sIIA" class="btn-social btn-outline"><i class="fa fa-fw fa-youtube"></i></a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>


    <!-- Housekeeping Service Request  Section -->
    <section id="portfolio">
        <div class="row container">
            <p class="lead">&nbsp;</p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="row"><?php echo $name; ?> Services</h1>
                    <p class="text-left"><?php echo $desc; ?></p>
                    <p><?php echo $smsg; ?></p>
                    <h3 class="row form-group">Rate <?php echo $rate; ?></h3>
                </div>
            </div>

            <?php echo $this->tag->form(array('service/submit', 'method' => 'post')); ?>

            <!---------------------------------------------------->
            <!-------------- Assignment Description -------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-12">
            <div class="col-md-12">
                <div class="form-group col-md-5">
                    <label for="bedrooms">How many bedrooms does your home have?</label>
                </div>
                <div class="form-group col-md-2">
                    <?php echo $form->render('bedrooms'); ?>
                </div>
                <div class="form-group col-md-5">
                </div>
            </div>
            <div class=" col-md-12">
                <div class="form-group col-md-5">
                    <label for="bathrooms">How many bathrooms does your home have?</label>
                </div>
                <div class="form-group col-md-2">
                    <?php echo $form->render('bathrooms'); ?>
                </div>
                <div class="form-group col-md-5">
                </div>
            </div>
                <div class="row form-group col-md-12">
                    <label for="description">Assignment description</label>
                    <?php echo $form->render('description'); ?>
                </div>
            </div>

            <!---------------------------------------------------->
            <!--------------------- Location --------------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-6">
                <div class="row-half text-center col-md-12">
                    <h4 class="form-group service-heading">Location</h4>
                </div>
                <div class="form-group col-md-12">
                    <label for="address">Address</label>
                    <?php echo $form->render('address'); ?>
                </div>
                <div class="form-group col-md-12">
                    <label for="city">City</label>
                    <?php echo $form->render('city'); ?>
                </div>
                <div class="form-group col-md-12">
                    <label for="zipcode">Zip code</label>
                    <?php echo $form->render('zipcode', array('value' => $zipcode)); ?>
                </div>
                <div class="form-group col-md-12">
                    <label for="state">State</label>
                    <?php echo $form->render('state', array('value' => 'MI')); ?>
                </div>
            </div>

            <!---------------------------------------------------->
            <!----------------- Your Information ----------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-6">
                <div class="row-half text-center col-md-12">
                    <h4 class="form-group service-heading">Your information</h4>
                </div>
                <div class="form-group col-md-12">
                    <label for="firstname">First name</label>
                    <?php echo $form->render('firstname'); ?>
                </div>
                <div class="form-group col-md-12">
                    <label for="lastname">Last name</label>
                    <?php echo $form->render('lastname'); ?>
                </div>
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    <?php echo $form->render('email'); ?>
                </div>
                <div class="form-group col-md-12">
                    <label for="phone">Phone</label>
                    <?php echo $form->render('phone'); ?>
                </div>
            </div>

            <!---------------------------------------------------->
            <!-------------------- Date & Time ------------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-12">
                <div class="row-half text-left">
                    <div class="form-group col-md-6">
                        <label for="day">Date</label>
                        <?php echo $form->render('day'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="time">Time</label>
                        <?php echo $form->render('time'); ?>
                    </div>
                </div>
            </div>


            <!---------------------------------------------------->
            <!---------------- Payment information --------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-6">
                <div class="row-half text-center col-md-12">
                    <h4 class="form-group service-heading">Payment information</h4>
                </div>
                <div class="form-group col-md-6">
                    <label for="ctype">Card type</label>
                    <?php echo $form->render('ctype'); ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="cnumber">Card number</label>
                    <?php echo $form->render('cnumber'); ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="cmonth">Expiration date</label>
                    <?php echo $form->render('cmonth'); ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="cyear">&nbsp;</label>
                    <?php echo $form->render('cyear'); ?>
                </div>
                <div class="form-group col-md-4">
                    <label for="cscode">Security code</label>
                    <?php echo $form->render('cscode'); ?>
                </div>
            </div>

            <!---------------------------------------------------->
            <!----------------- Billing Information ----------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-6">
                <div class="row-half text-center col-md-12">
                    <h4 class="form-group service-heading">Billing information</h4>
                </div>
                <div class="form-group col-md-12">
                    <label for="cholder">Cardholder name</label>
                    <?php echo $form->render('cholder'); ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="caddress">Address</label>
                    <?php echo $form->render('caddress'); ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="ccity">City</label>
                    <?php echo $form->render('ccity'); ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="cstate">State</label>
                    <?php echo $form->render('cstate'); ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zip code</label>
                    <?php echo $form->render('czipcode'); ?>
                </div>
            </div>


            <!---------------------------------------------------->
            <!---------------------- Captcha --------------------->
            <!---------------------------------------------------->
            <div class="row-half text-center col-md-12">
                <div align="center" class="g-recaptcha" data-sitekey="6LcZRB0TAAAAAEcUL-Wc-ZdSYUFr_IE3zlZSo7I4"></div>
            </div>


            <!---------------------------------------------------->
            <!-------------------- PLEASE NOTE ------------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-12">
                <h4>PLEASE NOTE:</h4>
                <p style="font-size: small">As soon as you submit an assignment, we will assign and dispatch help to your location.<br/>
                    After your assignment is completed, your credit/debit card will be charged for the total amount of hours worked.<br/>
                    If an assignment is canceled within one hour of the scheduled start time, a one hour cancelation fee will apply at the chosen service rate.<br/>
                    A minimum of one hour charge is required.</p>
                <p style="font-size: medium">By submitting this assignment, you are agreeing to our terms and conditions.</p>
                <?php echo $form->render('approve'); ?><span>&nbsp;</span><span style="font-size: medium"> I Agree</span>
            </div>

            <div class="hidden">
                <?php echo $form->render('service', array('value' => $service)); ?>
            </div>
            <!---------------------------------------------------->
            <!------------------- Submit Button ------------------>
            <!---------------------------------------------------->
            <div class="row-half text-center col-md-12">
                <?php echo $form->render('Submit'); ?>
            </div>

            <?php echo $this->tag->endForm(); ?>
        </div>
        <div class="row container">
            <p class="lead">&nbsp;</p>
        </div>
    </section>

<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4"><h4><a href="https://www.butlerfly.com/contact">CONTACT US</a></h4></div>
                <div class="footer-col col-md-4"><h4><a href="https://www.butlerfly.com/terms">TERMS OF SERVICE</a></h4></div>
                <div class="footer-col col-md-4"><h4><a href="https://www.butlerfly.com/support">SUPPORT CENTER</a></h4></div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="text-center">
            <small>Copyright © 2016 All Rights Reserved | Design by <a href="http://www.mace.ws" target="blank">mace.ws</a></small>
        </div>
    </div>
</footer>
<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll visible-xs visible-sm">
    <a class="btn btn-default" style="padding: 10px 20px;" href="#page-top">
        <i class="fa fa-chevron-up" style="padding: 0px;margin:  0px 0px 0px -4px;"></i>
    </a>
</div>
<?php echo $this->assets->outputJs('footer'); ?>
</body>
</html>