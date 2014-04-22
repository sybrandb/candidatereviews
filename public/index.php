<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
/**
 * Application setup
 * 
 * @package    Application
 */

// define request microtime
define('REQUEST_MICROTIME', microtime(true));

// setup autoloading
require_once '../vendor/autoload.php';

// change dir
chdir(dirname(__DIR__));

// define application path
define('CRV_ROOT', realpath(__DIR__ . '/..'));

// Run the application!
Zend\Mvc\Application::init(include 'config/application.config.php')->run();
