<?php
/**
 * Created by PhpStorm.
 * User: bbennett
 * Date: 2016-12-04
 * Time: 8:42 AM
 */

namespace IForm;


class Curl {
    ## ===========================================
    ## sendCurlRequest
    ## ===========================================
    public static function sendCurlRequest($method,$url,$params,$showHeader=false,$file=null,$header=array())
    {

        $ch = curl_init($url);
        $fh = null;

        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_TIMEOUT,15);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,5);
        if ($method=="GET") {
            $ch = curl_init("$url?$params");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        }
        else if ($method=="POST") {
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
        }
        else if ($method=="PUT") {
            $fh = fopen('php://memory', 'rw');
            fwrite($fh, $params);
            rewind($fh);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_INFILE, $fh);
            curl_setopt($ch, CURLOPT_INFILESIZE, strlen($params));
            curl_setopt($ch, CURLOPT_PUT, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        }
        else if ($method=="DELETE") {
            curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
            curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'DELETE');
        }
        else if ($method=="HEAD") {
            curl_setopt($ch,CURLOPT_NOBODY,1);
            curl_setopt($ch,CURLOPT_CUSTOMREQUEST,'HEAD');
        }

        if (!empty($header)) {
            curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        }
        if ($showHeader) {
            curl_setopt($ch,CURLOPT_HEADER,true);
        }

        $output = curl_exec($ch);
        $errorCode = curl_errno($ch);

        if ($errorCode) {
            $httpStatus = $errorCode;
            $output = "";
        }
        else {
            $httpStatus = curl_getinfo($ch,CURLINFO_HTTP_CODE);
        }

        curl_close($ch);
        if ($fh!=null) {
            fclose($fh);
        }
        return array($httpStatus,$output);
    }
}