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
  

  public function __construct() {}
  
  /*
   * Lay-Outs
   */
  public function login($warning = "") {
    if ($warning != "") {
      $this->content .= '
        <div class="warning">'.$warning.'</div>';
    }
    $this->content = '
      <br><br><br><br>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4">
          
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
  public function home() {
    $this->content = 'home';
    $this->page();
  }
  
  
  
  public function warning($msg) {
    $this->content = '
      <div class="warning">'.$msg.'</div>';
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
  
  // FOOTER
  private function footer() {
    return ' 
    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>';
  }
  // NAV
  private function nav() {
    return ' 
    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="'.BASE_URL.'">Home</a>
          <a class="blog-nav-item" href="#">New features</a>
          <a class="blog-nav-item" href="#">Press</a>
          <a class="blog-nav-item" href="#">New hires</a>
          <a class="blog-nav-item" href="#">About</a>
        </nav>
      </div>
    </div>';
  }
  // SIDEBAR
  private function sidebar() {
    return '
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>'. fbvar('SITE_ABOUT').'</p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="#">March 2014</a></li>
              <li><a href="#">February 2014</a></li>
              <li><a href="#">January 2014</a></li>
              <li><a href="#">December 2013</a></li>
              <li><a href="#">November 2013</a></li>
              <li><a href="#">October 2013</a></li>
              <li><a href="#">September 2013</a></li>
              <li><a href="#">August 2013</a></li>
              <li><a href="#">July 2013</a></li>
              <li><a href="#">June 2013</a></li>
              <li><a href="#">May 2013</a></li>
              <li><a href="#">April 2013</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="https://github.com/jfreeman82/freeblog">GitHub</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->';
  }
  
  
  /* 
   * SETTERS
   */
  public function setCss($css) {
    $this->css = '<link rel="stylesheet" href="'.$css.'"/>';
  }
  
}
