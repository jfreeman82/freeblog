<?php

/**
 * Description of View
 *
 * @author myrmidex
 */
class View {

  private $content;
  private $css;
  private $title;
  

  public function __construct() {
    $this->content = "";
  }
  
  /*
   * Lay-Outs
   */
  public function login($warning = "") {
    $this->content .= '
      <br><br><br><br>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4">';
          
    if ($warning != "") {
      $this->content .= '
        <div class="alert alert-danger text-center">'.$warning.'</div>';
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
  
  public function dashboard() {
    $this->setCss(ADMIN_URL."inc/stylesheets/dashboard.css");
    $tmpcontent = $this->content;
    $this->content = '
      
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">'. fbvar('ADMIN_TITLE').'</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Help</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Reports</a></li>
            <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li>
          </ul>
        </div>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>

        '.$tmpcontent.' 
          
        </div>
      </div>
    </div>';
    $this->page();
  }
  
  
  private function page() {
    echo  '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.$this->title.'</title>
    '.$this->css.' 
    <link href="inc/modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    '.$this->content.'
    <script src="inc/modules/jquery/jquery-3.2.1.min.js"></script>
    <script src="inc/modules/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>';
  }
  /* 
   * Pages
   *    
   */
  public function front() {
    $content = ' 
      <h1>Home</h1>
      <p>The front page</p>
      ';
    $this->dashboard();
  }
  
  /* PAGE BLOCKS 
   * 
   *  can be reused multiple times per page
   */
  
  // ArticleBlock puts everything in an article and returns it
  private function articleBlock($art) {
    return '
          <article class="blog-post">
            <h2 class="blog-post-title">'.$art['title'].'</h2>
            <p class="blog-post-meta">'.date("F j, Y, g:i a",strtotime($art['gendate'])).' by <a href="#">'.$art['username'].'</a></p>
            <p class="blog-post-body">'.$art['article'].'</p>
          </article>
';
  }
  
  // NAV
  private function nav() {
    return ' 
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="'.ADMIN_URL.'">Home</a>
          <a class="blog-nav-item" href="#">New features</a>
          <a class="blog-nav-item" href="#">Press</a>
          <a class="blog-nav-item" href="#">New hires</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>
      </div>
    </div>';
  }
  
  /* 
   * SETTERS
   */
  public function setCss($css) {
    $this->css = '<link rel="stylesheet" href="'.$css.'"/>';
  }
  
}
