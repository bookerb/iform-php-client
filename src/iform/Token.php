<?php

namespace IForm;

use \Firebase\JWT\JWT;

class Token
{

    private $int_token_access;
    private $int_token_expiry;
    private $client_key;
    private $client_secret;
    private $oauth_url;

    ## ===========================================
    ## __construct
    ## ===========================================
    function __construct($client_key, $client_secret, $oauth_url)
    {
        $this->client_key = $client_key;
        $this->client_secret = $client_secret;
        $this->oauth_url = $oauth_url;
    }

    //public function getTokenTimeRemain()       { return strtotime($this->$int_token_expiry) - time(); }
    //public function getTokenDisplay()          { return "Access: " . $this->$int_token_access . " Expiry: " . $this->$int_token_expiry . " Valid: " . $this->getTokenTimeRemain() . " seconds remaining"; }

    ## ===========================================
    ## getAccessToken
    ## ===========================================
    public function getToken()
    {

        if (!$this->int_token_access || $this->int_token_expiry < time()) {

            $token = array(
                "iss" => $this->client_key,
                "aud" => $this->oauth_url,
                "iat" => time(),
                "exp" => (time() + 120)  // 10 seconds to auto or fail out
            );
            $assertion = \Firebase\JWT\JWT::encode($token, $this->client_secret);

            $param = array();
            $param["grant_type"] = "urn:ietf:params:oauth:grant-type:jwt-bearer";
            $param["assertion"] = $assertion;

            $param = http_build_query($param);


            list ($httpStatus, $response) = Curl::sendCurlRequest("POST", $this->oauth_url, $param, false);


            $response = json_decode($response, true);
            $this->int_token_access = $response['access_token'];
            $this->int_token_expiry = time() + 3500;


        }

        if (!($this->int_token_access)) {
            $msg = "ERROR - no access token for IForm API - application terminated";
            exit();
        }
        return $this->int_token_access;
    }
}