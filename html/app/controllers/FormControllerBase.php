<?php

use Phalcon\Mvc\Controller;
use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;

class FormControllerBase extends Controller
{
    public function initialize(){
        $this->assets
            ->collection('header')
            ->addCss('css/style.css')
            ->addCss('css/font-butlerfly.css',true,false)
            ->addCss('css/font-awesome.css',true,false)
            ->setTargetPath('css/style.min.css')
            ->setTargetUri('css/style.min.css')
            ->join(true)
            ->addFilter(new Cssmin());

        $this->assets
            ->collection('footer')
            ->addJs('https://www.google.com/recaptcha/api.js',false,false)
            ->addJs('js/jquery.js')
            ->addJs('js/bstrap.js')
            ->addJs('js/form.js')
            ->addJs('js/analytics.js')
            ->setTargetPath('js/form.min.js')
            ->setTargetUri('js/form.min.js')
            ->join(true)
            ->addFilter(new Jsmin());

    }
}