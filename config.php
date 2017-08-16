<?php

ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
ini_set('display_errors', 'STDOUT');

define('BASE_URL', 'http://localhost/blog/public/');
define('WWW', 'http://localhost/blog/public/');
define('ROOT_URL', $_SERVER['DOCUMENT_ROOT'].'/blog/');

define("MYSQL_HOST","localhost");
define("MYSQL_USER","freebloguser");
define("MYSQL_PASS","freebloguser12345");
define("MYSQL_DB","freeblog");
// ROUTING 
define("BASE_ROUTE",'blog/public');

// Requires
require_once 'vendor/autoload.php';
require_once 'src/modules/DBC.php';

require_once 'src/mvc/controller/Controller.php';
require_once 'src/mvc/controller/ArticleController.php';
require_once 'src/mvc/controller/FrontController.php';

require_once 'src/mvc/model/Model.php';
require_once 'src/mvc/model/ArticleModel.php';

require_once 'src/mvc/view/View.php';
require_once 'src/mvc/view/ArticleView.php';
require_once 'src/mvc/view/FrontView.php';

require_once 'src/modules/articles/Article.php';
require_once 'src/modules/User.php';
require_once 'src/modules/fbvars.php';

require_once '../../router/Router.php';


define('SITE_TITLE', \freest\blog\modules\fbvar('SITE_TITLE'));
define('SITE_SUBTITLE', \freest\blog\modules\fbvar('SITE_SUBTITLE'));
define('SITE_ABOUT', \freest\blog\modules\fbvar('SITE_ABOUT'));
