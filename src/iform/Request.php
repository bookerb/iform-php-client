<?php

/**
 * User: bbennett
 * Date: 2016-12-03
 * Time: 5:17 PM
 */

namespace IForm;

/**
 * Class Request
 * @package IForm
 */
class Request
{
    private $token;
    private $response;
    private $http_status;
    private $http_json;

    /**
     * Request constructor.
     * @param $token
     */
    public function __construct($token)
    {
        // Check for access token
        $this->token = $token;
        $this->response = array();
        $this->debug = true;
    }

    /**
     * @param $method
     * @param $httpurl
     * @param array $params
     */
    public function sendRequest($method, $httpurl, $params = array())
    {
        $this->response = '';

        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json';
        $header[] = 'Authorization: Bearer ' . $this->token->getToken();
        $params = http_build_query($params);

        list ($this->http_status, $this->http_json) = Curl::sendCurlRequest($method, $httpurl, $params, false, '', $header);

        if ($this->http_status == 200) {
            $this->response = json_decode($this->http_json, true);
        } else {
            exit($this->http_json);
        }

    }

    /**
     * @param $httpurl
     * @param array $params
     * @return array
     */
    public function getResponse($method, $httpurl, $params = array())
    {
        $this->sendRequest($method, $httpurl, $params);
        return $this->response;
    }

    /**
     * @return mixed
     */
    public function getRawResponse()
    {
        $this->sendRequest($method, $httpurl, $params);
        return $this->http_json;
    }

}
