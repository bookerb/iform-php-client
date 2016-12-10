<?php

/**
 * User: bbennett
 * Date: 2016-12-03
 * Time: 5:17 PM
 */

namespace IForm;

//use Httpful\Request;

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
    public function __construct(Token $token)
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

        $httpful = true;
        if ($httpful) {
            switch ($method) {
                case 'GET':
                    $params = (sizeof($params)) ? "?" . http_build_query($params) : '';
                    $this->response  = \Httpful\Request::get($httpurl .  $params)
                        ->sendsJson()
                        ->addHeaders(array('Authorization' => ' Bearer ' . $this->token->getToken())
                        )->send();
                    break;
                case 'POST':
                    $this->response  = \Httpful\Request::post($httpurl)
                        ->sendsJson()
                        ->body(json_encode($params))
                        ->addHeaders(array('Authorization' => ' Bearer ' . $this->token->getToken())
                        )->send();
                    break;
                case 'PUT':
                    $this->response  = \Httpful\Request::put($httpurl)
                        ->sendsJson()
                        ->body(json_encode($params))
                        ->addHeaders(array('Authorization' => ' Bearer ' . $this->token->getToken())
                        )->send();
                    break;
                case 'DELETE':
                    $this->response  = \Httpful\Request::delete($httpurl)
                        ->sendsJson()
                        ->addHeaders(array('Authorization' => ' Bearer ' . $this->token->getToken())
                        )->send();
                    break;
            }


        }
        else
        {
          list ($this->http_status, $this->http_json) = Curl::sendCurlRequest($method, $httpurl, $params, false, '', $header);

            if ($this->http_status == 200) {
                $this->response = json_decode($this->http_json, true);
            } else {
                exit($this->http_json);
            }
        }
    }

    /**
     * @param $method
     * @param $httpurl
     * @param array $params
     * @return array
     */
    public function getResponse($method, $httpurl, $params = array())
    {
        $this->sendRequest($method, $httpurl, $params);
        return $this->response->body;
    }

    /**
     * @param $method
     * @param $httpurl
     * @param $params
     * @return mixed
     */
    public function getRawResponse($method, $httpurl, $params)
    {
        $this->sendRequest($method, $httpurl, $params);
        return $this->http_json;
    }

}
