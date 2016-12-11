<?php
/**
 * @author bookerb
 * @package iform
 */

namespace iform;

use IForm;


class PageResource extends IForm\Resource
{
    /**
     * UserResource constructor.
     * @param $token
     * @param $client_name
     * @param $client_profile
     */
    public function __construct($token, $client_name, $client_profile)
    {
        $this->token = $token;
        $this->httpurl = 'https://' . $client_name . '.iformbuilder.com/exzact/api/v60/profiles/self/pages';
    }

    /**
     * @param $params
     * @return array
     */
    public function getPageList($params)
    {
        $this->setParamArray($params);
        return $this->getResponse('GET', $this->httpurl);
    }

}