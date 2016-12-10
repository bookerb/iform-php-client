<?php
/**
 * User: bbennett
 * Date: 2016-12-09
 * Time: 6:28 AM
 */

namespace iform;
use IForm;

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

    public function setUsers($params = array())
    {
        // TODO: sanity check for passed in array values
        $this->setParamArray($params);
        return $this->getResponse('PUT', $this->httpurl . '/' . $user_id);
    }
    /**
     * @param $user_id
     * @return array
     */
    public function deleteUser($user_id)
    {
        return $this->getResponse('DELETE', $this->httpurl . '/' . $user_id);
    }

    public function createUser($params = array())
    {
        // TODO: sanity check for passed in array values
        $this->setParamArray($params);
        return $this->getResponse('POST', $this->httpurl);
    }
}