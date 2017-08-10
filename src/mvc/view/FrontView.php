<?php
namespace freest\blog\mvc\view;

use freest\blog\mvc\view\ArticleView as ArticleView;
use freest\blog\modules;

/**
 * Description of FrontView
 *
 * @author myrmidex
 */
class FrontView extends View 
{   
    /* Front
     * 
     * Front layout
     */
    public function front($arts) 
    {
        $this->setCss('stylesheets/css/blog.css');
        $this->content = $this->nav().'

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">'. modules\fbvar('SITE_TITLE').'</h1>
        <p class="lead blog-description">'. modules\fbvar('SITE_SUBTITLE').'</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">';
        foreach ($arts as $art) {
            $this->content .= ArticleView::articleBlock($art);
        }
        $this->content .= ' 
          <nav>
            <ul class="pager">
              <li><a href="#">Previous</a></li>
              <li><a href="#">Next</a></li>
            </ul>
          </nav>

        </div><!-- /.blog-main -->

        '.$this->sidebar().' 

      </div><!-- /.row -->

    </div><!-- /.container -->
    
    '.$this->footer();
    
        $this->page();
    }
    
}
