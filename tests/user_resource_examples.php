<?php
/**
 * User Resource Example File
 */
require_once '../vendor/autoload.php';
require_once '../src/debug.php';

$config = include('../src/config.php');

$token = new IForm\Token($config->iform_client_key,
    $config->iform_client_secret,
    'https://' . $config->iform_company . '.iformbuilder.com/exzact/api/oauth/token');


/**
 * Create user resource
 */
$user_resource = new \IForm\UserResource($token, $config->iform_company, $config->iform_profile);

/**
 * Get user list
 */
$response = $user_resource->getUserList(array('limit' => 5, 'offset' => 5));

/**
 * Get a user
 */
$response = $user_resource->getUser($user_id = 123);

/**
 * Set a user
 */
$fields['first_name'] = 'a_first_name';
$response = $user_resource->setUser($user_id = 123, $fields);

/**
 * Set a user group
 */
$users[] = array('id' => 123, 'first_name' => 'bob');
$users[] = array('id' => 234, 'first_name' => 'ted');
$response = $user_resource->setUsers($users);

/**
 * Delete a user
 */
$response = $user_resource->deleteUser($user_id = 123);

/**
 * Delete a user group
 */
$users[] = array('id' => 123);
$users[] = array('id' => 234);
$response = $user_resource->deleteUsers($users);

/**
 * Create user
 */
$fields['username'] = 'a_user_name';
$fields['password'] = 'a_password';
$fields['email'] = 'email@example.com';
$response = $user_resource->createUser($fields);

/**
 * Get user page assignment
 */
$response = $user_resource->getPageAssignment($user_id = 123, $page_id = 123);

/**
 * Set user page assignment
 */
$fields['can_collect'] = 1;
$response = $user_resource->setPageAssignment($user_id = 123, $page_id = 123, $fields);

/**
 * Delete user page
 */
$response = $user_resource->deletePageAssignment($user_id = 123, $page_id = 123);

/**
 * Get page assignments
 */
$response = $user_resource->getPageAssignments($page_id = 123);

/**
 * Set user page assignments
 */
$pages[] = array('page_id' => 123, array('can_collect' => 0, 'can_view' => 1));
$response = $user_resource->setPageAssignments($user_id = 123, $pages);

/**
 * Delete user page assignments
 */
$pages[] = array('page_id' => 123);
$response = $user_resource->setPageAssignments($user_id = 123, $pages);

/**
 * Create user page assignment
 */
$fields['page_id'] = 123;
$fields['can_view'] = 1;
$response = $user_resource->createPageAssignments(123, $fields);
