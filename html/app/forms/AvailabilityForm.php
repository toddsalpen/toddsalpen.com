<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Hidden;

class AvailabilityForm extends Form{

  public function initialize(){
      $zipcode  = new Text('zipcode',['class'=>'form-control','pattern'=>'^\d{5}(?:[-\s]\d{4})?$','title'=>'Please enter a valid zip code']);
      $service  = new Hidden('service');
      $tz       = new Hidden('tz');
      $this->add($zipcode);
      $this->add($service);
      $this->add($tz);
      $this->add(new Submit('Next'));
 }
    public function messages($name){
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}
