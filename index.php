<?php
namespace freest\blog;

use freest\blog\mvc\controller\Controller as Controller;

/* FreeBlog - a free light-weight blog platform */

require 'inc/config.php';

// Start controller
$controller = new Controller();

// Invoke Controller
$controller->invoke();