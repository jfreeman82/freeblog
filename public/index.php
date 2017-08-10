<?php
namespace freest\blog;

use freest\blog\mvc\controller\Controller as Controller;

/* FreeBlog - a free light-weight blog platform */

session_start();

require '../config.php';

// Start controller
$controller = new Controller();

// Invoke Controller
$controller->invoke();