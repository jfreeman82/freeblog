<?php
namespace freest\blog\admin;

use freest\blog\admin\mvc\controller\Controller as Controller;

session_start();
/* FreeBlog - a free light-weight blog platform */

require 'inc/config.php';

// Start controller
$controller = new Controller();

// Invoke Controller
$controller->invoke();