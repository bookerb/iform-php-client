<?php
/**
 * @author bookerb
 * @package iform
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


        switch ($method) {
            case 'GET':
                $params = (sizeof($params)) ? "?" . http_build_query($params) : '';
                $this->response  = \Httpful\Request::get($httpurl .  $params)
                    ->addHeaders(array('Authorization' => ' Bearer ' . $this->token->getToken()))
                    ->send();
                break;
            case 'POST':
                $this->response  = \Httpful\Request::post($httpurl)
                    ->body(json_encode($params))
                    ->addHeaders(array('Authorization' => ' Bearer ' . $this->token->getToken()))
                    ->send();
                break;
            case 'PUT':
                $this->response  = \Httpful\Request::put($httpurl)
                    ->body(json_encode($params))
                    ->addHeaders(array('Authorization' => ' Bearer ' . $this->token->getToken()))
                    ->send();

                break;
            case 'DELETE':
                $this->response  = \Httpful\Request::delete($httpurl)
                    ->body(json_encode($params))
                    ->addHeaders(array('Authorization' => ' Bearer ' . $this->token->getToken()))
                    ->send();
                dump($this->response);
                break;
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
