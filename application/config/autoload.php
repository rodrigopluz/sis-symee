<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * -------------------------------------------------------------------
 * AUTO-LOADER
 * -------------------------------------------------------------------
 * This file specifies which systems should be loaded by default.
 *
 * In order to keep the framework as light-weight as possible only the
 * absolute minimal resources are loaded by default. For example,
 * the database is not connected to automatically since no assumption
 * is made regarding whether you intend to use it.  This file lets
 * you globally define which systems you would like loaded with every
 * request.
 *
 * -------------------------------------------------------------------
 * Instructions
 * ---------------------------$autoload['config'] = array('jwt');----------------------------------------
 *$autoload['config'] = array('jwt');
 * These are the things you ca$autoload['config'] = array('jwt');n load automatically:
 *
 * 1. Packages
 * 2. Libraries
 * 3. Drivers
 * 4. Helper files
 * 5. Custom config files
 * 6. Language files
 * 7. Models
 */

/**
 * -------------------------------------------------------------------
 *  Auto-load Packages
 * -------------------------------------------------------------------
 * Prototype:
 *
 *  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
 */
$autoload['packages'] = [];

/**
 * -------------------------------------------------------------------
 *  Auto-load Libraries
 * -------------------------------------------------------------------
 * These are the classes located in the system/libraries folder
 * or in your application/libraries folder.
 *
 * Prototype:
 *
 *	$autoload['libraries'] = ['database', 'email', 'session'];
 *
 * You can also supply an alternative library name to be assigned
 * in the controller:
 *
 *	$autoload['libraries'] = ['user_agent' => 'ua'];
 */
$autoload['libraries'] = [
	'email',
	'xmlrpc',
	'upload',
	'doctrine',
	'pagination',
	'form_validation'
];

/**
 * -------------------------------------------------------------------
 *  Auto-load Drivers
 * -------------------------------------------------------------------
 * These classes are located in the system/libraries folder or in your
 * application/libraries folder within their own subdirectory. They
 * offer multiple interchangeable driver options.
 *
 * Prototype:
 *
 *	$autoload['drivers'] = ['cache'];
 */
$autoload['drivers'] = ['session'];

/**
 * -------------------------------------------------------------------
 *  Auto-load Helper Files
 * -------------------------------------------------------------------
 * Prototype:
 *
 *	$autoload['helper'] = ['url', 'file'];
 */
$autoload['helper'] = [
	'url',
	'jwt',
	'file',
	'form',
	'dump',
	'string',
	'security',
	'download',
	'inflector',
	'directory',
	'format_string',
	'multi_language'
	// 'authorization',
];

/**
 * -------------------------------------------------------------------
 *  Auto-load Config files
 * -------------------------------------------------------------------
 * Prototype:
 *
 *	$autoload['config'] = ['config1', 'config2'];
 *
 * NOTE: This item is intended for use ONLY if you have created custom
 * config files.  Otherwise, leave it blank.
 */
// $autoload['config'] = [];
$autoload['config'] = ['jwt'];

/**
 * -------------------------------------------------------------------
 *  Auto-load Language files
 * -------------------------------------------------------------------
 * Prototype:
 *
 *	$autoload['language'] = ['lang1', 'lang2'];
 *
 * NOTE: Do not include the "_lang" part of your file.  For example
 * "codeigniter_lang.php" would be referenced as ['codeigniter'];
 */
$autoload['language'] = [];

/**
 * -------------------------------------------------------------------
 *  Auto-load Models
 * -------------------------------------------------------------------
 * Prototype:
 *
 *	$autoload['model'] = ['first_model', 'second_model'];
 *
 * You can also supply an alternative model name to be assigned
 * in the controller:
 *
 *	$autoload['model'] = ['first_model' => 'first'];
 */
$autoload['model'] = ['crud'];


// $autoload['config'] = array('jwt');