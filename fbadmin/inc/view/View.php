<?php
namespace FreeBlog\Admin\View;
/**
 * Description of View
 *
 * @author myrmidex
 */
class View {
    
    private $content;
    private $css;
    private $title;
    private $warning;
  
  
    public function __construct()
    {
        $this->content = "";
    }
  
    /*
     * Lay-Outs
     *      
     */
    public function dashboard(): void 
    {
        $this->setCss(ADMIN_URL."inc/stylesheets/css/dashboard.css");
        $tmpcontent = $this->content;
        $this->content = '
      
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 sidebar">
          <div class="nav-title">'.fbvar('ADMIN_TITLE').'</div>
        
          <ul class="nav nav-sidebar">
            <li><a href="index.php?page=articles">Articles</a></li>
            <li><a href="index.php?page=users">Users</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="index.php?action=logout">Log Out</a></li>
          </ul>
        </div>
        
        <div class="col-lg-10 col-md-9 col-sm-9 col-xs-8 main">
          <h1 class="page-header">'.$this->title.'</h1>

            '.$tmpcontent.' 
          
        </div>
      </div>
    </div>';
        $this->page();
  }  
  
    private function page(): void 
    {
        echo  '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.$this->title.'</title>
    '.$this->css.' 
    <link href="'.ADMIN_URL.'inc/modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    '.$this->content.'
    <script src="'.ADMIN_URL.'inc/modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="'.ADMIN_URL.'inc/modules/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>';
    }
  
  /* 
   * Pages
   *    To fill the Lay-Outs
   *    
   */
    public function login(): void
    {
        $this->content .= '
      <br><br><br><br>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4">';
          
        if (isset($this->warning) && $this->warning != "") {
            $this->content .= '
        <div class="alert alert-danger text-center">'.$this->warning.'</div>';
        }
        $this->content .= ' 
      <form class="form-signin" action="'.ADMIN_URL.'" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="lf_email" class="sr-only">Email address</label>
        <input type="email" id="lf_email" name="lf_email" class="form-control" placeholder="Email address" required autofocus>
        <label for="lf_password" class="sr-only">Password</label>
        <input type="password" id="lf_password" name="lf_password" class="form-control" placeholder="Password" required>
        <input type="hidden" name="loginform" value="go" />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>
        
        </div>
      </div>
    </div> <!-- /container -->';
        $this->page();
    }
  
    public function front(): void 
    {
        $this->content = ' 
      <h1>Home</h1>
      <p>The front page</p>';
        $this->dashboard();
    }
  
    public function tableArray(Array $array): void 
    {
        require_once 'inc/modules/arraytable.php';
        $this->title = $array['title'];
        $this->base = 'dashboard';
        $this->content .= array2table($array);
    
        if (isset($array['footer'])) {$this->content .= $array['footer'];}
        $this->dashboard();
    }
  
    
    // Single error within dashboard. a 404...
    public function error(string $error): void 
    {
        $this->content = '
      <div class="alert alert-danger">'.$error.'</div>';
        $this->dashboard();
    }
  
    /* 
     * SETTERS
     */
    public function setCss($css)
    {
        $this->css = '<link rel="stylesheet" href="'.$css.'"/>';
    }/*
    public function setBase(string $base): void 
    {
        $this->base = $base;
        $this->generate();
    }*/
    public function setWarning(string $warning)
    {
        $this->warning = $warning;
    } 
}
