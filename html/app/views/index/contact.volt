{% extends "layouts/base.volt" %}
{% block content %}
<!-- Header -->
    <section id="portfolio">
        <div class="container">
            <div class="row col-lg-12 text-left">
                <h1>Contact us</h1>
                <p class="row-half">We want to hear from you.</p>
                <p>Your questions, comments, and concerns are always welcome.</p>
                <p>Please fill out and submit this form, and our support team will get back to you within the next 24 hours.</p>
            </div>
            {{ form('contactus','method':'post') }}
                <div class="row text-left col-md-6">
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        {{ form.render('firstname') }}
                    </div>
                </div>
                <div class="row text-left col-md-6">
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        {{ form.render('lastname') }}
                    </div>
                </div>
                <div class="row text-left col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        {{ form.render('email') }}
                    </div>
                </div>
                <div class="row text-left col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        {{ form.render('phone') }}
                    </div>
                </div>
                <div class="row text-left col-lg-12">
                    <div class="form-group">
                        <label for="phone">Subject</label>
                        {{ form.render('question') }}
                    </div>
                    <div class="form-group">
                        <label for="phone">Message</label>
                        {{ form.render('message') }}
                    </div>
                    <div class="row text-center">
                        {{ form.render('Submit') }}
                    </div>
                </div>
            {{ end_form() }}
        </div>
    </section>
{% endblock %}