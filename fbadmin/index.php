<?php
session_start();
/* FreeBlog - a free light-weight blog platform */

require 'inc/config.php';

// Start controller
$controller = new Controller();

// Invoke Controller
$controller->invoke();