<?php

/* FreeBlog - a free light-weight blog platform
 */
error_reporting(E_ALL);
ini_set("error_reporting", E_ALL);

// Requires
require_once 'inc/config.php';

// Start controller
$controller = new Controller();

// Invoke Controller
$controller->invoke();


echo 'ok';