<?php

use Phalcon\Forms\Form;
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

class StandardServiceForm extends Form{

    private $date;

    public function initialize(){


        /*******************************************
        /* -------- Assignment Description
        /*******************************************/


        /* --------  Description  -------- */
        /* --------  -----------  -------- */
        $description = new TextArea('description',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please describe your assignment']);
        $this->add($description);


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
        $zipcode = new Text('zipcode',['readonly'=>'readonly','class'=>'form-control']);
        $this->add($zipcode);


        /* --------  State  -------- */
        /* --------  -----  -------- */
        $state   = new Select('state',[
//            'AL'=>'Alabama',
//            'AK'=>'Alaska',
//            'AZ'=>'Arizona',
//            'AR'=>'Arkansas',
//            'CA'=>'California',
//            'CO'=>'Colorado',
//            'CT'=>'Connecticut',
//            'DE'=>'Delaware',
//            'DC'=>'District Of Columbia',
//            'FL'=>'Florida',
//            'GA'=>'Georgia',
//            'HI'=>'Hawaii',
//            'ID'=>'Idaho',
//            'IL'=>'Illinois',
//            'IN'=>'Indiana',
//            'IA'=>'Iowa',
//            'KS'=>'Kansas',
//            'KY'=>'Kentucky',
//            'LA'=>'Louisiana',
//            'ME'=>'Maine',
//            'MD'=>'Maryland',
//            'MA'=>'Massachusetts',
            'MI'=>'Michigan',
//            'MN'=>'Minnesota',
//            'MS'=>'Mississippi',
//            'MO'=>'Missouri',
//            'MT'=>'Montana',
//            'NE'=>'Nebraska',
//            'NV'=>'Nevada',
//            'NH'=>'New Hampshire',
//            'NJ'=>'New Jersey',
//            'NM'=>'New Mexico',
//            'NY'=>'New York',
//            'NC'=>'North Carolina',
//            'ND'=>'North Dakota',
//            'OH'=>'Ohio',
//            'OK'=>'Oklahoma',
//            'OR'=>'Oregon',
//            'PA'=>'Pennsylvania',
//            'RI'=>'Rhode Island',
//            'SC'=>'South Carolina',
//            'SD'=>'South Dakota',
//            'TN'=>'Tennessee',
//            'TX'=>'Texas',
//            'UT'=>'Utah',
//            'VT'=>'Vermont',
//            'VA'=>'Virginia',
//            'WA'=>'Washington',
//            'WV'=>'West Virginia',
//            'WI'=>'Wisconsin',
//            'WY'=>'Wyoming'
        ],['class'=>'form-control','readonly'=>'readonly']);
        $this->add($state);


        /*******************************************
        /* -------- Date & Time
        /*******************************************/


        /* --------  day  -------- */
        /* --------  ---  -------- */
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
        $this->add($phone);/*******************************************
        /* -------- Credit Card Information
        /*******************************************/


        /* --------  Card Type  -------- */
        /* --------  ---- ----  -------- */
        $ctype = new Select('ctype',[
            'Visa'=>'Visa',
            'MasterCard'=>'MasterCard',
            'Discover'=>'Discover',
            'American Express'=>'American Express'
        ],['class'=>'form-control']);
        $this->add($ctype);


        /* --------  Cardholder name  -------- */
        /* --------  ---------- ----  -------- */
        $cardholder = new Text('cholder',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your card holder name']);
        $this->add($cardholder);

        /**
        ^(?:4[0-9]{12}(?:[0-9]{3})?          # Visa
        |  5[1-5][0-9]{14}                  # MasterCard
        |  3[47][0-9]{13}                   # American Express
        |  3(?:0[0-5]|[68][0-9])[0-9]{11}   # Diners Club
        |  6(?:011|5[0-9]{2})[0-9]{12}      # Discover
        |  (?:2131|1800|35\d{3})\d{11}      # JCB
        )$
         */
        /* --------  Card number  -------- */
        /* --------  ---- ------  -------- */
        $cardnumber = new Text('cnumber',
            ['required'=>'true',
                'class'=>'form-control',
                'pattern'=>'^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9]{2})[0-9]{12}|3[47][0-9]{13})$',
                'title'=>'Please enter your valid card number']);
        $this->add($cardnumber);


        /* --------  Expiration Month  -------- */
        /* --------  ---------- -----  -------- */
        $cmonth = new Select('cmonth',[
            '01 - Jan'=>'01 - Jan',
            '02 - Feb'=>'02 - Feb',
            '03 - Mar'=>'03 - Mar',
            '04 - Apr'=>'04 - Apr',
            '05 - May'=>'05 - May',
            '06 - Jun'=>'06 - Jun',
            '07 - Jul'=>'07 - Jul',
            '08 - Aug'=>'08 - Aug',
            '09 - Sep'=>'09 - Sep',
            '10 - Oct'=>'10 - Oct',
            '11 - Nov'=>'11 - Nov',
            '12 - Dec'=>'12 - Dec'
        ],['class'=>'form-control']);
        $this->add($cmonth);


        /* --------  Expiration Year  -------- */
        /* --------  ---------- ----  -------- */
        $cyear = new Select('cyear',[
            '2016'=>'2016',
            '2017'=>'2017',
            '2018'=>'2018',
            '2019'=>'2019',
            '2020'=>'2020',
            '2021'=>'2021',
            '2022'=>'2022',
            '2023'=>'2023',
            '2024'=>'2024',
            '2025'=>'2025',
            '2026'=>'2026',
            '2027'=>'2027',
            '2028'=>'2028',
            '2029'=>'2029',
            '2030'=>'2030',
            '2031'=>'2031',
            '2032'=>'2032',
            '2033'=>'2033',
            '2034'=>'2034',
            '2035'=>'2035',
            '2036'=>'2036'
        ],['class'=>'form-control']);
        $this->add($cyear);


        /* --------  Security Code  -------- */
        /* --------  -------- ----  -------- */
        $cscode = new Text('cscode',['required'=>'true','class'=>'form-control','pattern'=>'(/^[0-9]{3,4}$/','title'=>'Please enter your valid security code']);
        $this->add($cscode);


        /*******************************************
        /* -------- Billing Address Information
        /*******************************************/


        /* --------  Card billing Address  -------- */
        /* --------  ---- ------- -------  -------- */
        $caddress = new Text('caddress',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your card billing address']);
        $this->add($caddress);


        /* --------  Card billing City  -------- */
        /* --------  ---- ------- ----  -------- */
        $ccity = new Text('ccity',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your card billing city']);
        $this->add($ccity);


        /* --------  Card State  -------- */
        /* --------  ---- -----  -------- */
        $cstate   = new Select('cstate',[
            'AL'=>'Alabama',
            'AK'=>'Alaska',
            'AZ'=>'Arizona',
            'AR'=>'Arkansas',
            'CA'=>'California',
            'CO'=>'Colorado',
            'CT'=>'Connecticut',
            'DE'=>'Delaware',
            'DC'=>'District Of Columbia',
            'FL'=>'Florida',
            'GA'=>'Georgia',
            'HI'=>'Hawaii',
            'ID'=>'Idaho',
            'IL'=>'Illinois',
            'IN'=>'Indiana',
            'IA'=>'Iowa',
            'KS'=>'Kansas',
            'KY'=>'Kentucky',
            'LA'=>'Louisiana',
            'ME'=>'Maine',
            'MD'=>'Maryland',
            'MA'=>'Massachusetts',
            'MI'=>'Michigan',
            'MN'=>'Minnesota',
            'MS'=>'Mississippi',
            'MO'=>'Missouri',
            'MT'=>'Montana',
            'NE'=>'Nebraska',
            'NV'=>'Nevada',
            'NH'=>'New Hampshire',
            'NJ'=>'New Jersey',
            'NM'=>'New Mexico',
            'NY'=>'New York',
            'NC'=>'North Carolina',
            'ND'=>'North Dakota',
            'OH'=>'Ohio',
            'OK'=>'Oklahoma',
            'OR'=>'Oregon',
            'PA'=>'Pennsylvania',
            'RI'=>'Rhode Island',
            'SC'=>'South Carolina',
            'SD'=>'South Dakota',
            'TN'=>'Tennessee',
            'TX'=>'Texas',
            'UT'=>'Utah',
            'VT'=>'Vermont',
            'VA'=>'Virginia',
            'WA'=>'Washington',
            'WV'=>'West Virginia',
            'WI'=>'Wisconsin',
            'WY'=>'Wyoming'
        ],['class'=>'form-control','required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please enter your card billing city']);
        $this->add($cstate);


        /* --------  Card Billing Zip Code  -------- */
        /* --------  ---- ------- --- ----  -------- */
        $czipcode = new Text('czipcode',['required'=>'true','class'=>'form-control','pattern'=>'^\d{5}(?:[-\s]\d{4})?$','title'=>'Please enter your card billing zip code']);
        $this->add($czipcode);


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
