<?php

use Phalcon\Mvc\Controller;
use Phalcon\Assets\Filters\Cssmin;
use Phalcon\Assets\Filters\Jsmin;

class ControllerBase extends Controller
{
    public function initialize(){
        $this->assets
            ->collection('header')
            ->addCss('css/style.css')
            ->addCss('css/font-butlerfly.css')
            ->addCss('css/font-icomoon.css')
            ->addCss('css/font-awesome.css')
            ->setTargetPath('css/style.min.css')
            ->setTargetUri('css/style.min.css')
            ->join(true)
            ->addFilter(new Cssmin());

        $this->assets
            ->collection('footer')
            ->addJs('js/jquery.js')
            ->addJs('js/bstrap.js')
            ->addJs('js/analytics.js')
            ->setTargetPath('js/cbase.min.js')
            ->setTargetUri('js/cbase.min.js')
            ->join(true)
            ->addFilter(new Jsmin());
    }
}
