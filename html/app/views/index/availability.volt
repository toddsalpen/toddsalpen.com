{% extends "layouts/form.volt" %}

{% block title %}
    <title>ButlerFly - {{ name }} Services</title>
    <meta name="description" content="{{ desc }}">
{% endblock %}

{% block content %}
    <section id="availability">
        <div class="row container"><p class="lead">&nbsp;</p></div>
        <div class="row container">
            <div class="row col-lg-12 text-center">
                    <h1>{{ name }} Services</h1>
            </div>
            {{ form() }}
            <div class="row-half text-center form-group col-md-6 col-md-offset-3">
                <label style="font-size: 20px" for="zipcode">Please enter your zip code</label>
            </div>

            <div class="row-half text-center form-group">
                <div class="col-md-5">&nbsp;</div>
                <div class="col-md-2">{{ form.render('zipcode') }}</div>
                <div class="col-md-5">&nbsp;</div>
            </div>
            <div class="row-half text-center form-group col-md-4 col-md-offset-4">
                {{ form.render('service', ['value':index]) }}
                {{ form.render('Next', ['class':'btn btn-default'])}}
            </div>
            {{ end_form() }}
        </div>
    </section>
{% endblock %}
