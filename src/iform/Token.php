<?php
/**
 * @author bookerb
 * @package iform
 */

namespace IForm;

use \Firebase\JWT\JWT;

/**
 * Class Token
 * @package IForm
 */
class Token
{
    private $response;
    private $int_token_access;
    private $int_token_expiry;
    private $client_key;
    private $client_secret;
    private $oauth_url;

    /**
     * Token constructor.
     * @param $client_key
     * @param $client_secret
     * @param $oauth_url
     */
    function __construct($client_key, $client_secret, $oauth_url)
    {
        $this->client_key = $client_key;
        $this->client_secret = $client_secret;
        $this->oauth_url = $oauth_url;
    }

    /**
     * @return mixed
     */
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

            $this->response  = \Httpful\Request::post($this->oauth_url . "?" . $param)->send();
            $this->int_token_access = $this->response->body->access_token;
            $this->int_token_expiry = time() + 3500;


        }

        if (!($this->int_token_access)) {
            $msg = "ERROR - no access token for IForm API - application terminated";
            exit();
        }
        return $this->int_token_access;
    }
}