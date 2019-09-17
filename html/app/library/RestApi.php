<?php
use Phalcon\Mvc\User\Component;
/**
 * Created by PhpStorm.
 * User: toddsalpen
 * Date: 4/13/16
 * Time: 9:53 PM
 */
class RestApi extends Component
{

    public static function PostRequest($url,$json){

        $request = curl_init($url);

        curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($request, CURLOPT_POST, true);
        curl_setopt($request, CURLOPT_POSTFIELDS, $json);
        curl_setopt($request, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'Accept:application/json',
            'Content-Length:' . strlen($json)]);

        $response = curl_exec($request);

        curl_close($request);


        return $response;

    }
    public static function GetRequest($url){

        $request = curl_init($url);

        curl_setopt($request, CURLOPT_POST, false);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($request, CURLOPT_HTTPHEADER,[
            'Content-Type:application/json',
            'Accept:application/json']);

        $response = curl_exec($request);

        curl_close($request);

        return $response;
    }

}