<?php

define('ADMIN_URL', BASE_URL.'fbadmin/');

require_once 'src/mvc/controller/admin/AdminController.php';
require_once 'src/mvc/controller/admin/ArticleAdminController.php';
require_once 'src/mvc/controller/admin/UserAdminController.php';

require_once 'src/mvc/model/admin/AdminModel.php';
require_once 'src/mvc/model/admin/ArticleAdminModel.php';
require_once 'src/mvc/model/admin/UserAdminModel.php';

require_once 'src/mvc/view/admin/AdminView.php';
require_once 'src/mvc/view/admin/ArticleAdminView.php';
require_once 'src/mvc/view/admin/UserAdminView.php';

require_once 'src/modules/auth.php';