<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *--------------------------------------------------------------------------
 * JWT Secure Key
 *--------------------------------------------------------------------------
 */
$config['jwt_key'] = '48fdskfiyf9m895ee05dkdksdk4850204dks948322';
// $config['jwt_key'] = 'ingDLMRuGe9UKHRNjs7cYckS2yul4lc3';


/**
 *--------------------------------------------------------------------------
 * JWT Algorithm Type
 *--------------------------------------------------------------------------
 */
$config['jwt_algorithm'] = 'HS256';

/**
 * Generated token will expire in 1 minute for sample code
 * Increase this value as per requirement for production
 */
$config['token_timeout'] = 1;


