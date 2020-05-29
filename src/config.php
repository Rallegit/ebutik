<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

// Include functions
require('app/common_functions.php');
require('app/users_functions.php');

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'my-page-3/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'my-page-3/src/'

// Include functions and classes

// Image

define('APP_URL', 'http://localhost/PHP/ebutik/');
define('IMG_PATH', APP_URL . 'public/img/');
