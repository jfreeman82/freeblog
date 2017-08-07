<?php

ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 'STDOUT');

define('BASE_URL', 'http://localhost/freeblog/');
define('ADMIN_URL', 'http://localhost/freeblog/fbadmin/');

define("MYSQL_HOST","localhost");
define("MYSQL_USER","freebloguser");
define("MYSQL_PASS","freebloguser12345");
define("MYSQL_DB","freeblog");


define('SITE_TITLE', 'onsBudget');

// Requires
require_once 'modules/DBC.php';

require_once 'controller/Controller.php';
require_once 'model/Model.php';
require_once 'view/View.php';

require_once 'modules/articles/Article.php';
require_once 'modules/User.php';

require_once 'controller/ArticleController.php';
require_once 'model/ArticleModel.php';
require_once 'view/ArticleView.php';

require_once 'controller/UserController.php';
require_once 'model/UserModel.php';
require_once 'view/UserView.php';

require_once 'modules/fbvars.php';
require_once 'modules/auth.php';