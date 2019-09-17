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
 *  Contact Us Form, basically is sending an email to contactus
 * **********************************************************************/

class ContactUsForm extends Form{

    private $date;

    public function initialize(){

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


        /* --------  Type of question  -------- */
        /* --------  ---- -- --------  -------- */
        $question = new Select('question',[
            'Comments'=>'Comments',
            'Issue with a Butler'=>'Issue with a Butler',
            'Issue with the service privided'=>'Issue with the service privided',
            'Issue with the website'=>'Issue with the website',
            'Question about an invoice'=>'Question about an invoice',
            'Service suggestion'=>'Service suggestion',
            'Something else'=>'Something else'
        ],['class'=>'form-control']);
        $this->add($question);


        /*******************************************
        /* -------- Message
        /*******************************************/


        /* --------  Message  -------- */
        /* --------  -------  -------- */
        $description = new TextArea('message',['required'=>'true','class'=>'form-control','pattern'=>'(.+)','title'=>'Please describe your assignment']);
        $this->add($description);


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
