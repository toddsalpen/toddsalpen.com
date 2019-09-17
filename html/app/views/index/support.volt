{% extends "layouts/base.volt" %}
{% block content %}
    <section id="infocenter">
        <div class="row-half container">
            <div class="row text-center col-lg-12">
                <h1>Support Center.</h1>
            </div>
            <div class="row text-left col-md-12">
                <a role="button" data-toggle="collapse" href="#requestingservice" aria-expanded="false" aria-controls="collapseExample">
                    <h4>REQUESTING SERVICE <i class="fa fa-arrow-down"></i></h4>
                </a>
                <div class="collapse" id="requestingservice">
                    <div class="well">
                        <p>To request service all you have to do is submit an assignment by following the steps below:</p>
                        <ol>
                            <li>Choose a service and click on Request Service.</li>
                            <li>Enter your zip code.</li>
                            <li>Click on Next.</li>
                            <li>Fill out the service request form.</li>
                            <li>Click on Submit Assignment.</li>
                        </ol>
                        <p>After you submit an assignment, we will dispatch help to your location on the date and time you've selected.</p>
                    </div>
                </div><br/>
                <a role="button" data-toggle="collapse" href="#pricing" aria-expanded="false" aria-controls="collapseExample">
                    <h4>PRICING <i class="fa fa-arrow-down"></i></h4>
                </a>
                <div class="collapse" id="pricing">
                    <div class="well">
                        <p>Each service has a different hourly rate.  To see the rates follow the steps below:</p>
                        <ol>
                            <li>Choose a service and click on Request Service.</li>
                            <li>Enter your zip code.</li>
                            <li>Click on Next.</li>
                        </ol>
                        <p>If you are in our service area, you will see the rate at the top of the service request form.</p>
                    </div>
                </div><br/>

                <a role="button" data-toggle="collapse" href="#businesshours" aria-expanded="false" aria-controls="collapseExample">
                    <h4>BUSINESS HOURS <i class="fa fa-arrow-down"></i></h4>
                </a>
                <div class="collapse" id="businesshours">
                    <div class="well">
                        <p>We are standing by ready to help you Monday to Sunday from 8 am to 6 pm.</p>
                    </div>
                </div><br/>

                <a role="button" data-toggle="collapse" href="#servicearea" aria-expanded="false" aria-controls="collapseExample">
                    <h4>SERVICE AREA <i class="fa fa-arrow-down"></i></h4>
                </a>
                <div class="collapse" id="servicearea">
                    <div class="well">
                        <p>Currently we are servicing 7 cities in Michigan, but we have plans to expand to other cities and states in the near future.</p>
                        <p>Our current service area includes:</p>
                        <ul>
                            <li>Livonia, MI</li>
                            <li>Plymouth, MI</li>
                            <li>Canton, MI</li>
                            <li>Farmington, MI</li>
                            <li>Farmington Hills, MI</li>
                            <li>Novi, MI</li>
                            <li>Northville, MI</li>
                        </ul>
                    </div>
                </div><br/>

                <a role="button" data-toggle="collapse" href="#payments" aria-expanded="false" aria-controls="collapseExample">
                    <h4>PAYMENTS <i class="fa fa-arrow-down"></i></h4>
                </a>
                <div class="collapse" id="payments">
                    <div class="well">
                        <p>All payments are securely processed through our system.</p>
                        <p>After your assignment is completed, your credit or debit card will be automatically charged for the total amount of hours worked.  </p>
                    </div>
                </div><br/>

                <a role="button" data-toggle="collapse" href="#contactus" aria-expanded="false" aria-controls="collapseExample">
                    <h4>CONTACT US <i class="fa fa-arrow-down"></i></h4>
                </a>

                <div class="collapse" id="contactus">
                    <div class="well">
                        <p>At ButlerFly we are committed to providing the best customer service. </p>
                        <p>Your questions, comments, and concerns are always welcome.</p>
                        <p>To contact us please fill out and submit the Contact Us form located at the bottom of the home page.</p>
                    </div>
                </div><br/>

                <a role="button" data-toggle="collapse" href="#canceling" aria-expanded="false" aria-controls="collapseExample">
                    <h4>CANCELLATIONS <i class="fa fa-arrow-down"></i></h4>
                </a>
                <div class="collapse" id="canceling">
                    <div class="well">
                        <p>You can cancel an assignment for any reason, but please note that if you cancel an assignment within one hour of the scheduled start time, a one hour cancelation fee will apply at the chosen service rate.</p>
                        <p>To cancel an assignment please contact us at <br/><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> <a style="display: inline-flex; background-color: transparent;" href="tel:2488263316">248-826-3316.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="row container">
        <p class="lead">&nbsp;</p>
    </div>
{% endblock %}