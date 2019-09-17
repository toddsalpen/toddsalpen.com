{% extends "layouts/base.volt" %}
{% block content %}
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
                <div class="carousel-caption"><h2 class="text-uppercase">{{ nameHousekeeping }}</h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/moving.jpg" alt="moving services">
                <div class="carousel-caption"><h2 class="text-uppercase">{{ nameMovingHelp }}</h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/disposal.jpg" alt="disposal services">
                <div class="carousel-caption"><h2 class="text-uppercase">{{ nameDisposal }}</h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/yardcleanup.jpg" alt="yard maintenance services">
                <div class="carousel-caption"><h2 class="text-uppercase">{{ nameYardMaintenance }}</h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/pickupanddelivery.jpg" alt="pickup & delivery services">
                <div class="carousel-caption"><h2 class="text-uppercase">{{ namePickupDelivery }}</h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/handyman.jpg" alt="handyman services">
                <div class="carousel-caption"><h2 class="text-uppercase">{{ nameHandyman }}</h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/heatingandcooling.jpg" alt="yard maintenance services">
                <div class="carousel-caption"><h2 class="text-uppercase">{{ nameHeatingCooling }}</h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/snowremoval.jpg" alt="pickup & delivery services">
                <div class="carousel-caption"><h2 class="text-uppercase">{{ nameSnowRemoval }}</h2></div>
            </div>
            <div class="item">
                <img src="img/carrousel/errandsandchores.jpg" alt="handyman services">
                <div class="carousel-caption"><h2 class="text-uppercase">{{ nameErrandsChores }}</h2></div>
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
            <h3 class="row-half service-heading">{{ nameHousekeeping }}</h3>
            <a href="{{ urlHousekeeping }}" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-moving"></i>
            </span>
            <h3 class="row-half service-heading">{{ nameMovingHelp }}</h3>
            <a href="{{ urlMovingHelp }}" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-disposal"></i>
            </span>
            <h3 class="row-half service-heading">{{ nameDisposal }}</h3>
            <a href="{{ urlDisposal }}" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-yard"></i>
            </span>
            <h3 class="row-half service-heading">{{ nameYardMaintenance }}</h3>
            <a href="{{ urlYardMaintenance }}" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-delivery"></i>
            </span>
            <h3 class="row-half service-heading">{{ namePickupDelivery }}</h3>
            <a href="{{ urlPickupDelivery }}" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-handyman"></i>
            </span>
            <h3 class="row-half service-heading">{{ nameHandyman }}</h3>
            <a href="{{ urlHandyman }}" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-heatingCooling"></i>
            </span>
            <h3 class="row-half service-heading">{{ nameHeatingCooling }}</h3>
            <a href="{{ urlHeatingCooling }}" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-snowRemoval"></i>
            </span>
            <h3 class="row-half service-heading">{{ nameSnowRemoval }}</h3>
            <a href="{{ urlSnowRemoval }}" class="btn btn-default">Request Service</a>
        </div>
        <div class="row text-center col-md-4">
            <span class="fa-stack fa-4x">
                <i class="roundCircle icon-todo"></i>
            </span>
            <h3 class="row-half service-heading">{{ nameErrandsChores }}</h3>
            <a href="{{ urlErrandsChores }}" class="btn btn-default">Request Service</a>
        </div>
    </div>
</section>
{% endblock %}