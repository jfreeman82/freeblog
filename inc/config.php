<?php

// Error reporting
ini_set('display_errors',1); 
error_reporting(E_ALL);

// Constants
define('MYSQL_DB','freeblog');
define('MYSQL_USER','freebloguser');
define('MYSQL_PASS','freebloguser12345');


// Requires
require_once 'controller/Controller.php';
require_once 'model/Model.php';
require_once 'view/View.php';
