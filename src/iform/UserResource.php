<?php
/**
 * @author bookerb
 * @package iform
 */

namespace iform;

use IForm;

/**
 * Class UserResource
 * @package iform
 */
class UserResource extends IForm\Resource
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
        $this->httpurl = 'https://' . $client_name . '.iformbuilder.com/exzact/api/v60/profiles/self/users';
    }

    /**
     * @param array $params
     * @return array
     */
    public function getUserList($params = array())
    {
        $this->setParamArray($params);
        return $this->getResponse('GET', $this->httpurl);
    }

    /**
     * @param $user_id
     * @return array
     */
    public function getUser($user_id)
    {
        return $this->getResponse('GET', $this->httpurl . '/' . $user_id);
    }

    /**
     * @param $user_id
     * @param array $params
     * @return array
     */
    public function setUser($user_id, $params = array())
    {
        // TODO: sanity check for passed in array valuesx
        $this->setParamArray($params);
        return $this->getResponse('PUT', $this->httpurl . '/' . $user_id);
    }

    /**
     * @param array $params
     * @return array
     */
    public function setUsers($params = array())
    {
        // TODO: sanity check for passed in array values
        $this->setParamRaw($params);
        return $this->getResponse('PUT', $this->httpurl);
    }

    /**
     * @param $user_id
     * @return array
     */
    public function deleteUser($user_id)
    {
        return $this->getResponse('DELETE', $this->httpurl . '/' . $user_id);
    }

    /**
     * @param $params
     * @return array
     */
    public function deleteUsers($params)
    {
        $this->setParamRaw($params);
        return $this->getResponse('DELETE', $this->httpurl);
    }

    /**
     * @param array $params
     * @return array
     */
    public function createUser($params = array())
    {
        // TODO: sanity check for passed in array values
        $this->setParamArray($params);
        return $this->getResponse('POST', $this->httpurl);
    }

    /**
     * @param $user_id
     * @param $page_id
     * @return array
     */
    public function getPageAssignment($user_id, $page_id)
    {
        return $this->getResponse('GET', $this->httpurl . '/' . $user_id . '/page_assignments/' . $page_id);
    }

    /**
     * @param $user_id
     * @param $page_id
     * @param $params
     * @return array
     */
    public function setPageAssignment($user_id, $page_id, $params)
    {
        $this->setParamArray($params);
        return $this->getResponse('PUT', $this->httpurl . '/' . $user_id . '/page_assignments/' . $page_id);
    }

    /**
     * @param $user_id
     * @param $page_id
     * @return array
     */
    public function deletePageAssignment($user_id, $page_id)
    {
        return $this->getResponse('DELETE', $this->httpurl . '/' . $user_id . '/page_assignments/' . $page_id);
    }

    /**
     * @param $page_id
     * @return array
     */
    public function getPageAssignments($page_id)
    {
        return $this->getResponse('GET', $this->httpurl . '/' . $page_id . '/page_assignments');
    }

    /**
     * @param $user_id
     * @param $params
     * @return array
     */
    public function setPageAssignments($user_id, $params)
    {
        $this->setParamRaw($params);
        return $this->getResponse('PUT', $this->httpurl . '/' . $user_id . '/page_assignments');
    }

    /**
     * @param $user_id
     * @param $params
     * @return array
     */
    public function deletePageAssignments($user_id, $params)
    {
        $this->setParamRaw($params);
        return $this->getResponse('DELETE', $this->httpurl . '/' . $user_id . '/page_assignments');
    }

    /**
     * @param $user_id
     * @param $params
     * @return array
     */
    public function createPageAssignments($user_id, $params)
    {
        $this->setParamArray($params);
        return $this->getResponse('POST', $this->httpurl . '/' . $user_id . '/page_assignments');
    }
}