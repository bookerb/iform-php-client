<?php

require_once '../vendor/autoload.php';

$config = include('../src/config.php');


// Call debug from PhpConsole\Handler
$handler = PhpConsole\Handler::getInstance();

$token = new IForm\Token($config->iform_client_key, $config->iform_client_secret, 'https://' . $config->iform_company . '.iformbuilder.com/exzact/api/oauth/token');
/*
$user_resource = new \IForm\UserResource($token, $config->iform_company, $config->iform_profile);
$response = $user_resource->getUserList(array('limit'=>10));
dump($response);
*/



$user_resource = new \IForm\UserResource($token, $config->iform_company, $config->iform_profile);
$response = $user_resource->getUser($user_id = 53836418);

dump($response);

function dump($vars) {
    print '<pre>';
    print_r($vars);
    print '</pre>';


}
