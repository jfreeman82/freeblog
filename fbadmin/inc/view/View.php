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
    $this->setCss(ADMIN_URL."inc/stylesheets/css/dashboard.css");
    $tmpcontent = $this->content;
    $this->content = '
      
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-4 sidebar">
          <div class="nav-title">'.fbvar('ADMIN_TITLE').'</div>
        
          <ul class="nav nav-sidebar">
            <li><a href="index.php?page=articles">Articles</a></li>
            <li><a href="#">Reports</a></li>
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
  
  
  private function page() {
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
   *    
   */
  public function front() {
    $content = ' 
      <h1>Home</h1>
      <p>The front page</p>
      ';
    $this->dashboard();
  }
  // articles - a list for articles
  public function articlesList($articles) {
    $this->title = 'Articles';
    $this->content .= '
      <table class="table table-bordered">
        <tr class="row">
          <th class="col-lg-1">id</th>
          <th class="col-lg-1">date</th>
          <th class="col-lg-8">title</th>
          <th class="col-lg-2">user</th>
        </tr>';
    
    foreach ($articles as $article) {
      $this->content .= '
        <tr class="row">
          <td><a href="index.php?page=article&id='. $article['id']  .'">'.  $article['id']                               .'</a></td>
          <td><a href="index.php?page=article&id='. $article['id']  .'">'.  date("d/m/Y",strtotime($article['gendate'])) .'</a></td>
          <td><a href="index.php?page=article&id='. $article['id']  .'">'.  $article['title']                            .'</a></td>
          <td><a href="index.php?page=user&id='.    $article['uid'] .'">'.  $article['username']                         .'</a></td>
        </tr>';      
    }
    
    $this->content .= ' 
      </table>';
    $this->dashboard();
  }
  public function article($article) {
    $this->title = 'Article';
    $this->content = '
      <article>
        <h1>'.$article['title'].'</h1>
        <div class="art-info">posted on '.date("M d, Y", strtotime($article['gendate'])).' by '.$article['username'].'</div>
        <div class="art-body">'.$article['article'].'</div>        
      </article>';
    $this->dashboard();
  }
  public function article_edit($article) {
    $this->title = 'Edit Article';
    $this->content = '
      <div class="row">
        <div class="col-lg-8">
      <form action="index.php?page=article&id='.$article['id'].'&action=edit" method="POST">
        <div class="form-group">
          <label for="ea_title">Title</label>
          <input type="text" name="ea_title" id="ea_title" class="form-control" value="'.$article['title'].'"/>
        </div>
        <div class="form-group">
          <label for="ea_article">Article</label>
          <textarea name="ea_article" id="ea_article" class="form-control">'.$article['article'].'</textarea>
        </div>
        <input type="hidden" name="aeform" value="go" />
        <input type="submit" value="Edit" class="btn btn-primary"/>
      </form>
      </div>
      </div>';
    $this->dashboard();
  }
  
  public function error($error) {
    $this->content = '
      <div class="alert alert-danger">'.$error.'</div>';
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
