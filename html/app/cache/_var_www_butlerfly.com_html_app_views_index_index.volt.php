<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Butlerfly allows you to outsource a wide range of services, including: Handyman, Housekeeping, Disposal, and much more.">
    <title>ButlerFly - Local Service Contractors</title>
    <link href="https://www.butlerfly.com/img/logos/favicon.png" rel="icon" type="image/png" sizes="32x32" >
    <?php echo $this->assets->outputCss('header'); ?>
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

<!-- Header -->
<header>
    <!-- Carrousel -->
    <div id="butler_carousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#butler_carousel" data-slide-to="0" class="active"></li>
            <li data-target="#butler_carousel" data-slide-to="1"></li>
            <li data-target="#butler_carousel" data-slide-to="2"></li>
            <li data-target="#butler_carousel" data-slide-to="3"></li>
            <li data-target="#butler_carousel" data-slide-to="4"></li>
            <li data-target="#butler_carousel" data-slide-to="5"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="img/carrousel/housekeeping.jpg" alt="housekeeping Services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $nameHousekeeping; ?></h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/moving.jpg" alt="moving services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $nameMovingHelp; ?></h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/disposal.jpg" alt="disposal services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $nameDisposal; ?></h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/yardcleanup.jpg" alt="yard maintenance services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $nameYardMaintenance; ?></h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/pickupanddelivery.jpg" alt="pickup & delivery services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $namePickupDelivery; ?></h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/handyman.jpg" alt="handyman services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $nameHandyman; ?></h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/heatingandcooling.jpg" alt="yard maintenance services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $nameHeatingCooling; ?></h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/snowremoval.jpg" alt="pickup & delivery services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $nameSnowRemoval; ?></h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/errandsandchores.jpg" alt="handyman services">
                <div class="carousel-caption"><h2 class="text-uppercase"><?php echo $nameErrandsChores; ?></h2></div>
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#butler_carousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#butler_carousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</header>
<!-- How ButlerFly Works Section -->
<section class="container" id="howbfworks">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>How ButlerFly works</h1>
            </div>
        </div>
        <div class="text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-submit"></i>
            </span>
            <h4 class="row service-heading">Submit an assigment</h4>
        </div>
        <div class="text-center col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="fa fa-stack-2x text-primary"></i>
                    <i id="arrowright" class="fa fa-arrow-right fa-stack-1x"></i>
                    <i id="arrowdown" class="fa fa-arrow-down fa-stack-1x"></i>
                </span>
        </div>
        <div class="text-center col-md-4">
                <span class="fa-stack fa-4x">
                    <i class="roundCircle icon-help"></i>
                </span>
            <h4 class="row service-heading">Sit back & relax help is on the way</h4>
        </div>
</section>
<!-- Why use Butlerfly Section -->
<section class="success" id="whyusebf">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Why use ButlerFly</h1>
            </div>
        </div>
        <div class="row panel-default text-center col-md-4">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-check"></i>TIME SAVING</h4>
                </div>
                <div class="panel-body text-left">
                    <p>We save you time, so you can focus on what is important in your life.</p>
                </div>
        </div>
        <div class="row panel-default text-center col-md-4">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-check"></i>RELIABLE</h4>
                </div>
                <div class="panel-body text-left">
                    <p>Our team is always standing by ready to help, wherever you are.</p>
                </div>
        </div>
        <div class="row panel-default text-center col-md-4">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-check"></i>QUALITY</h4>
                </div>
                <div class="panel-body text-left">
                    <p>Our team members are experienced on their respective fields.</p>
                </div>
        </div>
        <div class="row panel-default text-center col-md-4">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-check"></i>SAFE</h4>
                </div>
                <div class="panel-body text-left">
                    <p>All of our team members are screened, and all services are insured.</p>
                </div>
        </div>
        <div class="row panel-default text-center col-md-4">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-check"></i>IT'S FREE</h4>
                </div>
                <div class="panel-body text-left">
                    <p>Our system is free to use. There are no membership fees, or contracts.</p>
                </div>
        </div>
        <div class="row panel-default text-center col-md-4">
                <div class="panel-heading">
                    <h4><i class="fa fa-fw fa-check"></i>CASHLESS</h4>
                </div>
                <div class="panel-body text-left">
                    <p>All transactions are securely processed through our system.</p>
                </div>
        </div>
    </div>
</section>
<!-- Services Section -->
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Services</h1>
            </div>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-house"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $nameHousekeeping; ?></h3>
            <a href="<?php echo $urlHousekeeping; ?>" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-moving"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $nameMovingHelp; ?></h3>
            <a href="<?php echo $urlMovingHelp; ?>" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-disposal"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $nameDisposal; ?></h3>
            <a href="<?php echo $urlDisposal; ?>" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-yard"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $nameYardMaintenance; ?></h3>
            <a href="<?php echo $urlYardMaintenance; ?>" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-delivery"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $namePickupDelivery; ?></h3>
            <a href="<?php echo $urlPickupDelivery; ?>" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-handyman"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $nameHandyman; ?></h3>
            <a href="<?php echo $urlHandyman; ?>" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-heatingCooling"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $nameHeatingCooling; ?></h3>
            <a href="<?php echo $urlHeatingCooling; ?>" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-snowRemoval"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $nameSnowRemoval; ?></h3>
            <a href="<?php echo $urlSnowRemoval; ?>" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-todo"></i>
            </span>
            <h3 class="row-half service-heading"><?php echo $nameErrandsChores; ?></h3>
            <a href="<?php echo $urlErrandsChores; ?>" class="btn btn-default">Request Service</a>
        </div>
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