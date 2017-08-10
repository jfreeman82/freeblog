<?php
namespace freest\blog\mvc\view\admin;

use freest\blog\mvc\view\View as View;
use freest\blog\modules;
use freest\blog\modules\arrays;

/**
 * Description of View
 *
 * @author myrmidex
 */
class AdminView extends View 
{
    
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
          <div class="nav-title">'.modules\fbvar('ADMIN_TITLE').'</div>
        
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
  
    /* 
     * Pages
     *    To fill the Lay-Outs
     *    
     */
    public function login(Array $formArray) 
    {
        require_once $_SERVER['DOCUMENT_ROOT'].'/blog/src/modules/arrayform.php';
        $this->setCss('stylesheets/css/login.css');
        $this->content = '
    <div class="container" id="login">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">';
          
        $this->content .= arrays\array2form($formArray);
        
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
        $this->content .= arrays\array2table($array);
    
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
