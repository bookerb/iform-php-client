<?php
/**
 * User: bbennett
 * Date: 2016-12-08
 * Time: 5:51 AM
 */

namespace iform;
use IForm;

/**
 * Class Resource
 * @package iform
 */
class Resource
{
    protected $httpurl;
    protected $token;
    protected $params;

    /**
     * Resource constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * @param $method
     * @param $httpurl
     * @param array $params
     * @return array
     */
    public function getResponse($method, $httpurl)
    {
        $request = new IForm\Request($this->token);
        return $request->getResponse($method, $httpurl, $this->params);
    }

    /**
     * @param $key
     * @param $value
     */
    public function setParams($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param $params
     */
    public function setParamArray($params)
    {

        if (sizeof($params) && is_array($params))
        {
            foreach ($params as $key => $value)
            {
                $this->setParams($key, $value);
            }
        }
    }
}