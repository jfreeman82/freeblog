<?php

define('ADMIN_URL', BASE_URL.'fbadmin/');

require_once 'src/mvc/controller/admin/AdminController.php';
require_once 'src/mvc/controller/admin/ArticleAdminController.php';
require_once 'src/mvc/controller/admin/UserAdminController.php';
require_once 'src/mvc/controller/admin/FrontAdminController.php';

require_once 'src/mvc/model/admin/AdminModel.php';
require_once 'src/mvc/model/admin/ArticleAdminModel.php';
require_once 'src/mvc/model/admin/UserAdminModel.php';

require_once 'src/mvc/view/admin/AdminView.php';
require_once 'src/mvc/view/admin/FrontAdminView.php';
require_once 'src/mvc/view/admin/ArticleAdminView.php';
require_once 'src/mvc/view/admin/UserAdminView.php';

require_once 'src/modules/auth.php';



$menu = array(
    array('title' => 'Articles',  'href' => ADMIN_URL.'articles/'),
    array('title' => 'Users',     'href' => ADMIN_URL.'users/'),
    array('title' => 'Analytics', 'href' => ADMIN_URL),
    array('title' => 'Log Out',   'href' => ADMIN_URL.'logout/'),
);
    