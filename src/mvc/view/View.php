<?php
namespace freest\blog\mvc\view;

use freest\blog\modules;

/**
 * Description of View
 *
 * @author myrmidex
 */
class View 
{
    protected $content;
    protected $css;
    protected $title;
  

    public function __construct() {}
  
    
    public function warning($msg)  // a 404 type page   
    {
        $this->content = '
      <div class="warning">'.$msg.'</div>';
        $this->page();
    }
  
    protected function page() 
    {
        echo  '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.$this->title.'</title>
    '.$this->css.' 
    <link href="'.BASE_URL.'stylesheets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="'.BASE_URL.'stylesheets/font-awesome/css/font-awesome.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    '.$this->content.'
    <script src="'.BASE_URL.'stylesheets/jquery/jquery-3.2.1.min.js"></script>
    <script src="'.BASE_URL.'stylesheets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>';
    }

    protected function layout() 
    {        
        $tmp_content = $this->content;
        $this->setCss('stylesheets/css/blog.css');
        $this->content = $this->nav().' 

    <div class="container">

        <div class="blog-header">
            <h1 class="blog-title">'. modules\fbvar('SITE_TITLE').'</h1>
            <p class="lead blog-description">'. modules\fbvar('SITE_SUBTITLE').'</p>
        </div>

        <div class="row">

            <div class="col-sm-8 blog-main">
            
                '.$tmp_content .' 
            
            </div><!-- /.blog-main -->
        
            '.$this->sidebar().' 
      
        </div><!-- /.row -->

    </div><!-- /.container -->

    '.$this->footer();
        
        $this->page();  
    }

    
    // FOOTER
    protected function footer() 
    {
        return ' 
    <footer class="blog-footer">
      <p>Blog template built for <a href="http://getbootstrap.com">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>';
    }
    
    // NAV
    protected function nav() 
    {
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
    protected function sidebar() 
    {
        $sidebar = '
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>'. modules\fbvar('SITE_ABOUT').'</p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>'.$this->sidebar_archives();
        
        $sidebar .= ' 
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="https://github.com/jfreeman82/freestblog" target="_blank" class="black"><i class="fa fa-github fa-3x"></i></a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->';
        return $sidebar;
    }
  
    protected function sidebar_archives(): string 
    {
        
/*        
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
 */
        $out = '
            <ol class="list-unstyled">';
        $archives = \freest\blog\mvc\model\Model::retrieve_archives();
        foreach ($archives as $archive) {
            $out .= '
                <li>
                    <a href="'.WWW.'archives/'.$archive['year'].'/'.$archive['month'].'/">
                        '.date("F Y",mktime(0,0,0,$archive['month'],1,$archive['year'])).'
                    </a>
                </li>';

        }
        $out .= '
            </ol>';
        return $out;
    }
  
    /* 
     * SETTERS
     */
    public function setCss($css) 
    {
        $this->css = '<link rel="stylesheet" href="'.BASE_URL.$css.'"/>';
    }
  
}
