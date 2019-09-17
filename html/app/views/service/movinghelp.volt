{% extends "layouts/form.volt" %}

{% block title %}
    <title>ButlerFly - {{ name }} Services</title>
    <meta name="description" content="{{ desc }}">
{% endblock %}

{% block content %}

    <!-- Moving Service Request  Section -->
    <section id="portfolio">
        <div class="container">
            <div class="row-half">
                <div class="col-lg-12 text-center">
                    <h1 class="row">{{ name }} Services</h1>
                    <p class="text-left">{{ desc }}</p>
                    <p>{{ smsg }}</p>
                    <h3 class="row form-group">Rate {{ rate }}</h3>
                </div>
            </div>

            {{ form('service/submit','method':'post') }}

            <!---------------------------------------------------->
            <!-------------- Assignment Description -------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-12">
                <div class="row form-inline">
                    <div class="form-group col-md-12">
                        <label for="helpers" style="padding-right: 20px">What type of help do you need?</label>
                    </div>
                    <div class="form-group col-md-2">
                        {{ form.render('loading') }}<span>&nbsp;</span><span style="font-size: medium; padding-right: 25px;"> Loading</span>
                    </div>
                    <div class="form-group col-md-2">
                        {{ form.render('unloading') }}<span>&nbsp;</span><span style="font-size: medium; padding-right: 25px;"> Unloading</span>
                    </div>
                    <div class="form-group col-md-2">
                        {{ form.render('packing') }}<span>&nbsp;</span><span style="font-size: medium; padding-right: 25px;"> Packing</span>
                    </div>
                    <div class="form-group col-md-2">
                        {{ form.render('unpacking') }}<span>&nbsp;</span><span style="font-size: medium; padding-right: 25px;"> Unpacking</span>
                    </div>
                    <div class="form-group col-md-2">
                        {{ form.render('organizing') }}<span>&nbsp;</span><span style="font-size: medium; padding-right: 25px;"> Organizing</span>
                    </div>
                </div>
                <div class="row form-inline col-md-12">
                    <div class="form-group">
                        <label for="helpers" style="padding-right: 20px">How many butlers do you need?</label>
                    </div>
                    <div class="form-group">
                        {{ form.render('helpers') }}
                    </div>
                </div>
                <div class="row form-group col-md-12">
                    <label for="description">Assignment description</label>
                    {{ form.render('description') }}
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
                    {{ form.render('address') }}
                </div>
                <div class="form-group col-md-12">
                    <label for="city">City</label>
                    {{ form.render('city') }}
                </div>
                <div class="form-group col-md-12">
                    <label for="zipcode">Zip code</label>
                    {{ form.render('zipcode',['value': zipcode ]) }}
                </div>
                <div class="form-group col-md-12">
                    <label for="state">State</label>
                    {{ form.render('state',['value':'MI']) }}
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
                    {{ form.render('firstname') }}
                </div>
                <div class="form-group col-md-12">
                    <label for="lastname">Last name</label>
                    {{ form.render('lastname') }}
                </div>
                <div class="form-group col-md-12">
                    <label for="email">Email</label>
                    {{ form.render('email') }}
                </div>
                <div class="form-group col-md-12">
                    <label for="phone">Phone</label>
                    {{ form.render('phone') }}
                </div>
            </div>

            <!---------------------------------------------------->
            <!-------------------- Date & Time ------------------->
            <!---------------------------------------------------->
            <div class="row-half text-left col-md-12">
                <div class="row-half text-left">
                    <div class="form-group col-md-6">
                        <label for="day">Date</label>
                        {{ form.render('day') }}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="time">Time</label>
                        {{ form.render('time') }}
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
                    {{ form.render('ctype') }}
                </div>
                <div class="form-group col-md-6">
                    <label for="cnumber">Card number</label>
                    {{ form.render('cnumber') }}
                </div>
                <div class="form-group col-md-4">
                    <label for="cmonth">Expiration date</label>
                    {{ form.render('cmonth') }}
                </div>
                <div class="form-group col-md-4">
                    <label for="cyear">&nbsp;</label>
                    {{ form.render('cyear') }}
                </div>
                <div class="form-group col-md-4">
                    <label for="cscode">Security code</label>
                    {{ form.render('cscode') }}
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
                    {{ form.render('cholder') }}
                </div>
                <div class="form-group col-md-6">
                    <label for="caddress">Address</label>
                    {{ form.render('caddress') }}
                </div>
                <div class="form-group col-md-6">
                    <label for="ccity">City</label>
                    {{ form.render('ccity') }}
                </div>
                <div class="form-group col-md-6">
                    <label for="cstate">State</label>
                    {{ form.render('cstate') }}
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zip code</label>
                    {{ form.render('czipcode') }}
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
                {{ form.render('approve') }}<span>&nbsp;</span><span style="font-size: medium"> I Agree</span>
            </div>

            <div class="hidden">
                {{ form.render('service',['value':service]) }}
            </div>
            <!---------------------------------------------------->
            <!------------------- Submit Button ------------------>
            <!---------------------------------------------------->
            <div class="row-half text-center col-md-12">
                {{ form.render('Submit') }}
            </div>

            {{ end_form() }}

        </div>
        <div class="row container">
            <p class="lead">&nbsp;</p>
        </div>
    </section>
{% endblock %}