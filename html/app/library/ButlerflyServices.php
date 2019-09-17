<?php
/**
 * Created by PhpStorm.
 * User: toddsalpen
 * Date: 3/31/16
 * Time: 7:03 PM
 */


use Phalcon\Mvc\User\Component;


class ButlerflyServices extends Component
{
    const _SERVICE_ = 'service/';

    const BUTLERFLY                 = 1000;
    const HOUSEKEEPING              = 1001;
    const MOVINGHELP                = 1002;
    const DISPOSAL                  = 1003;
    const YARDMAINTENANCE           = 1004;
    const PICKUPANDDELIVERY         = 1005;
    const HANDYMAN                  = 1006;
    const HEATINGANDCOOLING         = 1007;
    const SNOWREMOVAL               = 1008;
    const ERRANDSANDCHORES          = 1009;

    const KEY_HOUSEKEEPING          = "housekeeping";
    const KEY_MOVINGHELP            = "moving-help";
    const KEY_DISPOSAL              = "disposal";
    const KEY_YARDMAINTENANCE       = "yard-cleanup";
    const KEY_PICKUPANDDELIVERY     = "pickup-and-delivery";
    const KEY_HANDYMAN              = "handyman";
    const KEY_HEATINGANDCOOLING     = "heating-and-cooling";
    const KEY_SNOWREMOVAL           = "snow-removal";
    const KEY_ERRANDSANDCHORES      = "errands-and-chores";

    const ACTION_HOUSEKEEPING       = "housekeeping";
    const ACTION_MOVINGHELP         = "movinghelp";
    const ACTION_DISPOSAL           = "disposal";
    const ACTION_YARDMAINTENANCE    = "yardcleanup";
    const ACTION_PICKUPANDDELIVERY  = "pickupanddelivery";
    const ACTION_HANDYMAN           = "handyman";
    const ACTION_HEATINGANDCOOLING  = "heatingandcooling";
    const ACTION_SNOWREMOVAL        = "snowremoval";
    const ACTION_ERRANDSANDCHORES   = "errandsandchores";

    const NAME_HOUSEKEEPING         = "Housekeeping";
    const NAME_MOVINGHELP           = "Moving Help";
    const NAME_DISPOSAL             = "Disposal";
    const NAME_YARDMAINTENANCE      = "Yard Cleanup";
    const NAME_PICKUPANDDELIVERY    = "Pickup & Delivery";
    const NAME_HANDYMAN             = "Handyman";
    const NAME_HEATINGANDCOOLING    = "Heating & Cooling";
    const NAME_SNOWREMOVAL          = "Snow Removal";
    const NAME_ERRANDSANDCHORES     = "Errands & Chores";

    /**
     *  Our team gets the job done in a timely manner and handles your cargo carefully using the proper equipment to avoid damage.
     */

    const DESC_HOUSEKEEPING         = "We provide a variety of professional services, including: cleaning, detailing, organizing, and move-in / move-out cleanouts.";
    const DESC_MOVINGHELP           = "We provide a variety of professional services, including: packing, unpacking, loading, unloading, and organizing.";
    const DESC_DISPOSAL             = "Our team picks up and removes all of your unwanted items, junk, trash, and debris, cleans the work area before leaving, and disposes everything properly by donating reusable items to charity and taking everything else to the proper disposal or recycling site.";
    const DESC_YARDMAINTENANCE      = "Our team can help you with all your leaf cleanup and weed removal needs.";
    const DESC_PICKUPANDDELIVERY    = "Locally or across town, we pickup and deliver just about anything the same day.";
    const DESC_HANDYMAN             = "We provide a variety of professional services, including: general repairs, maintenance, installations, and assembly.";
    const DESC_HEATINGANDCOOLING    = "We provide a variety of professional heating & cooling services, including: furnace and air-conditioning repairs, new installations, and maintenance.";
    const DESC_SNOWREMOVAL          = "Our team can clean your driveway, sidewalk, porch, and deck, saving you time and the hassle of shoveling snow.";
    const DESC_ERRANDSANDCHORES     = "Our team can help you with all your everyday tasks, as well as handle your entire to do list.";

    const RATE_HOUSEKEEPING         = '&#36;30.00 per hour';
    const RATE_MOVINGHELP           = '&#36;50.00 per hour - per butler';
    const RATE_DISPOSAL             = '&#36;90.00 per hour - plus &#36;50 recycling fee';
    const RATE_YARDMAINTENANCE      = '&#36;30.00 per hour';
    const RATE_PICKUPANDDELIVERY    = '&#36;60.00 per hour - plus 50&cent; per mile';
    const RATE_HANDYMAN             = '&#36;60.00 per hour';
    const RATE_HEATINGANDCOOLING    = '&#36;80.00 per hour';
    const RATE_SNOWREMOVAL          = '&#36;30.00 per hour';
    const RATE_ERRANDSANDCHORES     = '&#36;20.00 per hour';

    const MSG_ALL_SERVICES          = "All of our team members are experienced, pre-screened, and insured.";

    const KEY = "ButlerFlyV1.0";
    const LOGO = "https://www.butlerfly.com/img/logos/logo.png";
    const WIDTH = 130;
    const ZIPCODES = [48009,48012,48017,48025,48030,48033,48034,48067,48069,48070,48071,48072,48073,48075,48076,48083,48084,48085,48098,48101,48111,48120,48122,48124,48125,48126,48127,48128,48134,48135,48138,48141,48146,48150,48152,48154,48164,48165,48167,48168,48170,48173,48174,48178,48180,48183,48184,48185,48186,48187,48188,48192,48193,48195,48201,48202,48203,48204,48205,48206,48207,48208,48209,48210,48211,48212,48213,48214,48215,48216,48217,48218,48219,48220,48221,48223,48224,48225,48226,48227,48228,48229,48230,48233,48234,48235,48236,48237,48238,48239,48240,48242,48243,48301,48302,48304,48306,48307,48309,48320,48322,48323,48324,48326,48327,48328,48329,48331,48334,48335,48336,48340,48341,48342,48346,48348,48350,48356,48357,48359,48360,48362,48363,48367,48370,48371,48374,48375,48377,48380,48381,48382,48383,48386,48390,48393,48442,48462];

    public function getServiceIdByKey($key){
        switch($key){
            case $this::KEY_HOUSEKEEPING:
                return $this::HOUSEKEEPING;
            case $this::KEY_MOVINGHELP:
                return $this::MOVINGHELP;
            case $this::KEY_DISPOSAL:
                return $this::DISPOSAL;
            case $this::KEY_YARDMAINTENANCE:
                return $this::YARDMAINTENANCE;
            case $this::KEY_PICKUPANDDELIVERY:
                return $this::PICKUPANDDELIVERY;
            case $this::KEY_HANDYMAN:
                return $this::HANDYMAN;
            case $this::KEY_HEATINGANDCOOLING:
                return $this::HEATINGANDCOOLING;
            case $this::KEY_SNOWREMOVAL:
                return $this::SNOWREMOVAL;
            case $this::KEY_ERRANDSANDCHORES:
                return $this::ERRANDSANDCHORES;
        }
    }
    public function getServiceKeyById($id){
        switch($id){
            case $this::HOUSEKEEPING:
                return $this::KEY_HOUSEKEEPING;
            case $this::MOVINGHELP:
                return $this::KEY_MOVINGHELP;
            case $this::DISPOSAL:
                return $this::KEY_DISPOSAL;
            case $this::YARDMAINTENANCE:
                return $this::KEY_YARDMAINTENANCE;
            case $this::PICKUPANDDELIVERY:
                return $this::KEY_PICKUPANDDELIVERY;
            case $this::HANDYMAN:
                return $this::KEY_HANDYMAN;
            case $this::HEATINGANDCOOLING:
                return $this::KEY_HEATINGANDCOOLING;
            case $this::SNOWREMOVAL:
                return $this::KEY_SNOWREMOVAL;
            case $this::ERRANDSANDCHORES:
                return $this::KEY_ERRANDSANDCHORES;
        }
    }

    public function getServiceDescriptionById($id){
        switch($id){
            case $this::HOUSEKEEPING:
                return $this::DESC_HOUSEKEEPING;
            case $this::MOVINGHELP:
                return $this::DESC_MOVINGHELP;
            case $this::DISPOSAL:
                return $this::DESC_DISPOSAL;
            case $this::YARDMAINTENANCE:
                return $this::DESC_YARDMAINTENANCE;
            case $this::PICKUPANDDELIVERY:
                return $this::DESC_PICKUPANDDELIVERY;
            case $this::HANDYMAN:
                return $this::DESC_HANDYMAN;
            case $this::HEATINGANDCOOLING:
                return $this::DESC_HEATINGANDCOOLING;
            case $this::SNOWREMOVAL:
                return $this::DESC_SNOWREMOVAL;
            case $this::ERRANDSANDCHORES:
                return $this::DESC_ERRANDSANDCHORES;
        }
    }

    public function getServiceNameById($id){
        switch($id){
            case $this::HOUSEKEEPING:
                return $this::NAME_HOUSEKEEPING;
            case $this::MOVINGHELP:
                return $this::NAME_MOVINGHELP;
            case $this::DISPOSAL:
                return $this::NAME_DISPOSAL;
            case $this::YARDMAINTENANCE:
                return $this::NAME_YARDMAINTENANCE;
            case $this::PICKUPANDDELIVERY:
                return $this::NAME_PICKUPANDDELIVERY;
            case $this::HANDYMAN:
                return $this::NAME_HANDYMAN;
            case $this::HEATINGANDCOOLING:
                return $this::NAME_HEATINGANDCOOLING;
            case $this::SNOWREMOVAL:
                return $this::NAME_SNOWREMOVAL;
            case $this::ERRANDSANDCHORES:
                return $this::NAME_ERRANDSANDCHORES;
        }
    }
    public function getServiceNameByKey($key){
        switch($key){
            case $this::KEY_HOUSEKEEPING:
                return $this::NAME_HOUSEKEEPING;
            case $this::KEY_MOVINGHELP:
                return $this::NAME_MOVINGHELP;
            case $this::KEY_DISPOSAL:
                return $this::NAME_DISPOSAL;
            case $this::KEY_YARDMAINTENANCE:
                return $this::NAME_YARDMAINTENANCE;
            case $this::KEY_PICKUPANDDELIVERY:
                return $this::NAME_PICKUPANDDELIVERY;
            case $this::KEY_HANDYMAN:
                return $this::NAME_HANDYMAN;
            case $this::KEY_HEATINGANDCOOLING:
                return $this::NAME_HEATINGANDCOOLING;
            case $this::KEY_SNOWREMOVAL:
                return $this::NAME_SNOWREMOVAL;
            case $this::KEY_ERRANDSANDCHORES:
                return $this::NAME_ERRANDSANDCHORES;
        }
    }
    public function getFormActionById($id){
        switch($id){
            case $this::HOUSEKEEPING:
                return $this::_SERVICE_.$this::ACTION_HOUSEKEEPING;
            case $this::MOVINGHELP:
                return $this::_SERVICE_.$this::ACTION_MOVINGHELP;
            case $this::DISPOSAL:
                return $this::_SERVICE_.$this::ACTION_DISPOSAL;
            case $this::YARDMAINTENANCE:
                return $this::_SERVICE_.$this::ACTION_YARDMAINTENANCE;
            case $this::PICKUPANDDELIVERY:
                return $this::_SERVICE_.$this::ACTION_PICKUPANDDELIVERY;
            case $this::HANDYMAN:
                return $this::_SERVICE_.$this::ACTION_HANDYMAN;
            case $this::HEATINGANDCOOLING:
                return $this::_SERVICE_.$this::ACTION_HEATINGANDCOOLING;
            case $this::SNOWREMOVAL:
                return $this::_SERVICE_.$this::ACTION_SNOWREMOVAL;
            case $this::ERRANDSANDCHORES:
                return $this::_SERVICE_.$this::ACTION_ERRANDSANDCHORES;
        }
    }
    public function getActionById($id){
        switch($id){
            case $this::HOUSEKEEPING:
                return $this::ACTION_HOUSEKEEPING;
            case $this::MOVINGHELP:
                return $this::ACTION_MOVINGHELP;
            case $this::DISPOSAL:
                return $this::ACTION_DISPOSAL;
            case $this::YARDMAINTENANCE:
                return $this::ACTION_YARDMAINTENANCE;
            case $this::PICKUPANDDELIVERY:
                return $this::ACTION_PICKUPANDDELIVERY;
            case $this::HANDYMAN:
                return $this::ACTION_HANDYMAN;
            case $this::HEATINGANDCOOLING:
                return $this::ACTION_HEATINGANDCOOLING;
            case $this::SNOWREMOVAL:
                return $this::ACTION_SNOWREMOVAL;
            case $this::ERRANDSANDCHORES:
                return $this::ACTION_ERRANDSANDCHORES;
        }
    }
    public function getRateById($id){
        switch($id){
            case $this::HOUSEKEEPING:
                return $this::RATE_HOUSEKEEPING;
            case $this::MOVINGHELP:
                return $this::RATE_MOVINGHELP;
            case $this::DISPOSAL:
                return $this::RATE_DISPOSAL;
            case $this::YARDMAINTENANCE:
                return $this::RATE_YARDMAINTENANCE;
            case $this::PICKUPANDDELIVERY:
                return $this::RATE_PICKUPANDDELIVERY;
            case $this::HANDYMAN:
                return $this::RATE_HANDYMAN;
            case $this::HEATINGANDCOOLING:
                return $this::RATE_HEATINGANDCOOLING;
            case $this::SNOWREMOVAL:
                return $this::RATE_SNOWREMOVAL;
            case $this::ERRANDSANDCHORES:
                return $this::RATE_ERRANDSANDCHORES;
        }
    }

    public function decrypt($value){
        return str_replace($this::KEY,"", base64_decode($value));
    }

    public function encrypt($value){
        return base64_encode($value.$this::KEY);
    }

    public function cardNumbers($value){
        return "****".substr($this->decrypt($value),-4);
    }

    public function getLogo(){
        return $this::LOGO;
    }

    public function getZipcodes(){
        return $this::ZIPCODES;
    }

    public function getWidth(){
        return $this::WIDTH."px";
    }

    public function getServiceMessage(){
        return $this::MSG_ALL_SERVICES;
    }

}