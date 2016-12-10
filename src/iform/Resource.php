<?php
/**
 * @author bookerb
 * @package iform
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
    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    /**
     * @param $method
     * @param $httpurl
     * @return array
     */
    protected function getResponse($method, $httpurl)
    {
        $request = new IForm\Request($this->token);
        return $request->getResponse($method, $httpurl, $this->params);
    }

    /**
     * @param $key
     * @param $value
     */
    protected function setParams($key, $value)
    {
        $this->params[$key] = $value;
    }

    /**
     * @param $params
     */
    protected function setParamArray($params)
    {

        if (sizeof($params) && is_array($params)) {
            foreach ($params as $key => $value) {
                $this->setParams($key, $value);
            }
        }
    }

    /**
     * @param $params
     */
    protected function setParamRaw($params)
    {
        $this->params = $params;

    }
}