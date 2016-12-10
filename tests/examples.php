<?php

require_once '../vendor/autoload.php';

$config = include('../src/config.php');

$token = new IForm\Token($config->iform_client_key, $config->iform_client_secret, 'https://' . $config->iform_company . '.iformbuilder.com/exzact/api/oauth/token');

/** USER RESOURCE TESTS */
/**
 * Create user resource
 */
$user_resource = new \IForm\UserResource($token, $config->iform_company, $config->iform_profile);

/**
 * Get user list
 */
$response = $user_resource->getUserList(array('limit'=>100));

/**
 * Get user
 */
$user_resource = new \IForm\UserResource($token, $config->iform_company, $config->iform_profile);
$response = $user_resource->getUser($user_id = xxx);
dump($response, 'green');

/**
 * Set user
 */
$fields['first_name'] = 'MyFirstName';
$response = $user_resource->setUser($user_id = xxx, $fields);
dump($response, 'green');

/**
 * Delete user
 */
$response = $user_resource->deleteUser($user_id = xxx);
dump($response, 'green');

/**
 * Create user
 */
$fields['username'] = 'test2';
$fields['password'] = 'SuperBob#2';
$fields['email']    = 'test2@ecofishresearch.com';
$response = $user_resource->createUser($fields);
dump($response, 'green');

/**
 * REMOVE WHEN COMPLETE
 * @param $vars
 * @param string $color
 */
function dump($vars, $color='black') {
    print '<pre style="color:' . $color . '">';
    print_r($vars);
    print '</pre>';
}