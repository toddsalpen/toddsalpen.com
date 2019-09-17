{% extends "layouts/form.volt" %}

{% block title %}
    <title>ButlerFly - {{ name }} Services</title>
    <meta name="description" content="{{ desc }}">
{% endblock %}

{% block content %}
<section id="portfolio">
    <div class="row container">
        <p class="lead">&nbsp;</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="row">Apologies!</h2>
                <h1 class="row">Zip code {{ zipcode }} is outside of our service area.</h1>
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
{% endblock %}