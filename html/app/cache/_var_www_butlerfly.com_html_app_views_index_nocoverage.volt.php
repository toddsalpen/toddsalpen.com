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

<section id="portfolio">
    <div class="row container">
        <p class="lead">&nbsp;</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="row">Apologies!</h2>
                <h1 class="row">Zip code <?php echo $zipcode; ?> is outside of our service area.</h1>
            </div>
        </div>
    </div>
    <div class="row container">
        <p class="lead">&nbsp;</p>
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