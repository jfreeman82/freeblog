<?php
namespace freest\blog\mvc\view;

use freest\blog\modules\articles\Article as Article;
use freest\blog\modules;

/**
 * Description of ArticleView
 *
 * @author myrmidex
 */
class ArticleView extends View
{
    /* Articles Layout
     * 
     * Like Front but without sidebar, see how that looks
     */

    protected function layout() 
    {        
        $tmp_content = $this->content;
        $this->setCss('stylesheets/css/article.css');
        $this->content = $this->nav().' 

    <div class="container">

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
    /*
     *  Pages
     */
<<<<<<< HEAD
    public function article($art) 
    {
        $this->setCss('stylesheets/css/blog.css');
        $this->content = $this->nav().'

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">'. fbvar('SITE_TITLE').'</h1>
        <p class="lead blog-description">'. fbvar('SITE_SUBTITLE').'</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">';
        $this->content .= ArticleView::articleBlock($art);
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
=======
    public function articles($arts) {
        foreach ($arts as $art) {
            $this->content .= $this->articleBlock($art);
        }
        $this->layout();
    }  
>>>>>>> show-article
  
    public function article($art) 
    {      
        $this->content .= $this->articleBlock($art);
        $this->layout();
    }
    public function articleShort($art) 
    {
        $this->content .= $this->articleBlock($art);
        $this->layout();
    }


    /* PAGE BLOCKS 
     * 
     *  can be reused multiple times per page
     */
    // ArticleBlock puts everything in an article and returns it
    public function articleBlock($art) 
    {
        return '
          <article class="blog-post">
            <h2 class="blog-post-title">'.$art['title'].'</h2>
            <p class="blog-post-meta">'.date("F j, Y, g:i a",strtotime($art['gendate'])).' by <a href="#">'.$art['username'].'</a></p>
            <p class="blog-post-body">'.$art['article'].'</p>
          </article>';
    }
    
    // Re-imagining articleBlock:
    public function block_article(Article $art): string
    {
        return '
          <article class="blog-post">
            <h2 class="blog-post-title">'.$art->title().'</h2>
            <p class="blog-post-meta">'.date("F j, Y, g:i a",strtotime($art->genDate())).' by <a href="#">'.$art->username().'</a></p>
            <p class="blog-post-body">'.$art->article().'</p>
          </article>';
    }
    
    // block_article_short
    public function block_article_short(Article $art): string
    {
        return '
          <article class="blog-post">
            <h2 class="blog-post-title">'.$art->title().'</h2>
            <p class="blog-post-meta">'.date("F j, Y, g:i a",strtotime($art->genDate())).' by <a href="#">'.$art->user()->getUsername().'</a></p>
            <p class="blog-post-body">'.substr($art->article(),0,200).'... </p>
            <a href="'.WWW.'article/'.$art->id().'/">Read More...</a>
          </article>';
    }
}
