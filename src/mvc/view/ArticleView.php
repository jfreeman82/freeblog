<?php
namespace freest\blog\mvc\view;

use freest\blog\modules\articles\Article as Article;
use freest\blog\modules;
use freest\modules\DB\DBC as DBC;

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
    public function article($art) 
    {
        $this->setCss('stylesheets/css/article.css');
        $this->content = $this->nav().'

    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">';
        $this->content .= ArticleView::articleBlock($art);
        $this->content .= ' 
          <nav>
            <ul class="pager">';
        
        // see if there is a newer(!) post
        $sql = "SELECT id FROM articles WHERE gendate > '".$art['gendate']." ORDER BY gendate ASC';";
        $dbc = new DBC();
        $q = $dbc->query($sql) or die("ERROR ArticleView / article - ".$dbc->error());
        if ($q->num_rows > 0) { 
            $aid = $q->fetch_assoc()['id'];
            $this->content .= '
                <li><a href="'.WWW.'article/'.$aid.'/">Newer</a></li>';
        }
        $sql = "SELECT id FROM articles WHERE gendate < '".$art['gendate']." ORDER BY gendate DESC';";
        $q = $dbc->query($sql) or die("ERROR ArticleView / article / 2 - ".$dbc->error());
        if ($q->num_rows > 0) {
            $aid = $q->fetch_assoc()['id'];
            $this->content .= '
                <li><a href="'.WWW.'article/'.$aid.'/">Older</a></li>';
        }
        $this->content .= ' 
            </ul>
          </nav>

        </div><!-- /.blog-main -->

        '.$this->sidebar().' 

      </div><!-- /.row -->

    </div><!-- /.container -->
    '.$this->footer();
        $this->page();
    }
    public function articles($arts) {
        foreach ($arts as $art) {
            $this->content .= $this->articleBlock($art);
        }
        $this->layout();
    }
    
    public function articleShort($art) 
    {
        $this->content .= $this->articleBlock($art);
        $this->layout();
    }

    public function articles_olist(Array $arts)
    {
        $this->content .= '<h1 class="page-header">All Posts</h1>';
        $this->content .= '
            
            <ol class="list-unstyled">';
        foreach ($arts as $art) {
            $this->content .= '
                <li><a href="'.WWW.'article/'.$art['id'].'/">'.$art['title'].'</a></li>';
        }
        $this->content .= '
            </ol>';
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
    
    public function pageHeader($title,$subtitle) {
        return '      
            <div class="blog-header">
                <h1 class="blog-title">'.$title.'</h1>
                <p class="lead blog-description">'.$subtitle.'</p>
            </div>';     
    }
}
