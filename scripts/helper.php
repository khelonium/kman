<?php

// Set error reporting to the level to which the Framework code must comply
error_reporting( E_ALL | E_STRICT );

// Determine the root, library, and tests directories of the framework distribution
$root      = dirname(dirname(__FILE__));
$library   = $root ."/library";
//$tests   = $root . DIRECTORY_SEPARATOR . 'tests';

/*
Prepend the Zend Framework library/ and tests/ directories to the include_path. This allows the tests to run out of
the box and helps prevent loading other copies of the framework code and tests that would supersede this copy.
*/

set_include_path($library . PATH_SEPARATOR
               . dirname(__FILE__).PATH_SEPARATOR
               . get_include_path());

//require_once "Vv/Loader.php";
//Vv_Loader::registerAutoload();

// Unset global variables no longer needed
unset($root, $library);

require_once 'Zend/Loader.php';
Zend_Loader::registerAutoload();