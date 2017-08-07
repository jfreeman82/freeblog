<?php
namespace FreeBlog\Admin\View;
/**
 * Description of View
 *
 * @author myrmidex
 */
class View {
    
    protected $content;
    protected $css;
    protected $title;
    protected $warning;
  
  
    public function __construct()
    {
        $this->content = "";
    }
  
    /*
     * Lay-Outs
     *      
     */
    protected function bare()
    {
        $this->page();
    }
    
    protected function dashboard() 
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
  
    private function page()
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
    public function login(Array $formArray) {
        require_once 'inc/modules/arrayform.php';
        
        $this->content = '
    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">';
          
        $this->content .= \FreeBlog\Admin\Modules\Arrays\array2form($formArray);
        
        $this->content .= '
            </div>
        </div>
    </div>';
        $this->bare();
    }
    
    // Front
    public function front() 
    {
        $this->content = ' 
      <h1>Home</h1>
      <p>The front page</p>';
        $this->dashboard();
    }
  
    
    /* Table Array
     * 
     *  Makes a table from an array
     */
    public function tableArray(Array $array) 
    {
        require_once 'inc/modules/arraytable.php';
        $this->title = $array['title'];
        $this->base = 'dashboard';
        $this->content .= array2table($array);
    
        if (isset($array['footer'])) {$this->content .= $array['footer'];}
        $this->dashboard();
    }
  
    
    // Single error within dashboard. a 404...
    public function error(string $error) 
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
