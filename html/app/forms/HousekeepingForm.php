<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Check;

/************************************************************************
 * This Works for Housekeeping, Vehicle Detailing & Yard Manintenance
 * **********************************************************************/

class HousekeepingForm extends Form{

    private $date;

    public function initialize(){


        /*******************************************
        /* -------- Assignment Description
        /*******************************************/


        /* --------  Description  -------- */
        /* --------  -----------  -------- */
        $description = new TextArea('description',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please describe your assignment']);
        $this->add($description);


        /* --------  Bedrooms  -------- */
        /* --------  -------  -------- */
        $bedrooms = new Numeric('bedrooms',['required'=>'true','class'=>'form-control','style'=>'width:60px','value'=>1]);
        $this->add($bedrooms);


        /* --------  Bathrooms  -------- */
        /* --------  -------  -------- */
        $bathrooms = new Numeric('bathrooms',['required'=>'true','class'=>'form-control','style'=>'width:60px','value'=>1]);
        $this->add($bathrooms);


        /*******************************************
        /* -------- Section Location
        /*******************************************/


        /* --------  Address  -------- */
        /* --------  -------  -------- */
        $address = new Text('address',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your address', 'value'=>$this->getDate()]);
        $this->add($address);


        /* --------  City  -------- */
        /* --------  ----  -------- */
        $city  = new Text('city',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your city']);
        $this->add($city);


        /* --------  Zip Code  -------- */
        /* --------  --- ----  -------- */
        $zipcode = new Text('zipcode',['disabled'=>'true','class'=>'form-control']);
        $this->add($zipcode);


        /* --------  State  -------- */
        /* --------  -----  -------- */
        $state   = new Select('state',[
                'MI'=>'Michigan',
                'OH'=>'Ohio',
                'IN'=>'Indiana',
                'IL'=>'Illinois'
            ],['class'=>'form-control','disabled'=>'true']);
        $this->add($state);


        /*******************************************
        /* -------- Date & Time
        /*******************************************/


        /* --------  day  -------- */
        /* --------  ---  -------- */
        $day =
        $day = new Select('day',[
            date('l F jS') => date('l F jS'),
            date('l F jS', strtotime('+1 days')) => date('l F jS', strtotime('+1 days')),
            date('l F jS', strtotime('+2 days')) => date('l F jS', strtotime('+2 days')),
            date('l F jS', strtotime('+3 days')) => date('l F jS', strtotime('+3 days')),
            date('l F jS', strtotime('+4 days')) => date('l F jS', strtotime('+4 days')),
            date('l F jS', strtotime('+5 days')) => date('l F jS', strtotime('+5 days')),
            date('l F jS', strtotime('+6 days')) => date('l F jS', strtotime('+6 days')),
            ],['class'=>'form-control']);
        $this->add($day);


        /* --------  time  -------- */
        /* --------  ----  -------- */
        $time = new Select('time',[
            '8:00 am'=>'8:00 am',
            '9:00 am'=>'9:00 am',
            '10:00 am'=>'10:00 am',
            '11:00 am'=>'11:00 am',
            '12:00 pm'=>'12:00 pm',
            '1:00 pm'=>'1:00 pm',
            '2:00 pm'=>'2:00 pm',
            '3:00 pm'=>'3:00 pm',
            '4:00 pm'=>'4:00 pm',
            '5:00 pm'=>'5:00 pm',
            '6:00 pm'=>'6:00 pm'
            ],['class'=>'form-control']);
        $this->add($time);


        /*******************************************
        /* -------- Customer Information
        /*******************************************/


        /* --------  Firstname  -------- */
        /* --------  ---------  -------- */
        $firstname = new Text('firstname',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your name']);
        $this->add($firstname);


        /* --------  Lastname  -------- */
        /* --------  --------  -------- */
        $lastname = new Text('lastname',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your lastname']);
        $this->add($lastname);


        /* --------  Email  -------- */
        /* --------  -----  -------- */
        $email = new Email('email',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your valid email']);
        $this->add($email);


        /* --------  Phone  -------- */
        /* --------  -----  -------- */
        $phone = new Text('phone',['required'=>'true','class'=>'form-control','pattern'=>'(\d{10})','title'=>'Please enter your valid phone number']);
        $this->add($phone);


        /*******************************************
        /* -------- Service Information
        /*******************************************/


        /* --------  Service ID  -------- */
        /* --------  ------- --  -------- */
        $service = new Hidden('service');
        $this->add($service);

        $ready = new Hidden('ready');
        $this->add($ready);

        $ready = new Hidden('zcode');
        $this->add($ready);


        /*******************************************
        /* -------- Approve Conditions
        /*******************************************/


        /* --------  Approval  -------- */
        /* --------  --------  -------- */
        $approve = new Check('approve',['class'=>'btn btn-default','required'=>'true']);
        $this->add($approve);


        /*******************************************
        /* -------- Submit Form
        /*******************************************/


        /* --------  Submit Button  -------- */
        /* --------  ------ ------  -------- */
        $submit = new Submit('Submit',['class'=>'btn btn-default']);
        $this->add($submit);
    }

    public function getDate(){
        return $this->date;
    }
    public function setDate($timezone){
        $this->date = date("C",$timezone);
    }

    public function messages($name){
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}
