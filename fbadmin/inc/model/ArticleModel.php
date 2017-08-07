<?php

namespace FreeBlog\Admin\Model;

use FreeBlog\Articles\Article as Article;
use FreeBlog\Modules\DB\DBC as DBC;

/**
 * Description of ArticleModel
 *
 * @author myrmidex
 */
class ArticleModel extends Model 
{

    public function articles_all(): Array 
    {
        $dbc = new DBC();
        $sql = "SELECT id FROM articles ORDER BY gendate,title DESC;";
        $q = $dbc->query($sql) or die("ERROR Model - ".$dbc->error());
        $out = array();
        while ($row = $q->fetch_assoc()) {
            array_push($out, $this->article($row['id']));
        }    
        return $out;
    }
  
    public function articles_arraytable(): Array 
    {
        $sql = "SELECT id FROM articles ORDER BY gendate,title DESC;";
        $dbc = new DBC();
        $q = $dbc->query($sql) or die("ERROR Model - ".$dbc->error());
        $data = array();
        $data[] = array(
                array('value' => 'id',        'class' => 'col-lg-1'),
                array('value' => 'title',     'class' => ''),
                array('value' => 'actions',   'class' => 'col-lg-2')
              );
        while ($row = $q->fetch_assoc()) {
            $aid = $row['id'];
            $art = new Article($aid);
            $title = '<a href="index.php?page=article&id='.$aid.'">'.$art->getTitle().'</a>';
            $action = '
                <a href="index.php?page=article&id='.$aid.'&action=edit">   Edit    </a>&nbsp;
                <a href="index.php?page=article&id='.$aid.'&action=delete"> Delete  </a>';
            $data[] = array($row['id'], $title, $action);
        }    
        $out['title'] = 'articles';
        $out['table-class'] = 'table table-bordered';
        $out['data'] = $data;
        $out['footer'] = '  
      <a href="index.php?page=article&action=new" class="btn btn-primary">Add New Article</a>';
    
        return $out;
    }

    // Obsolete - use articleArray instead
    public function article(int $aid): Article 
    {
        return new Article($aid);
    }
    // Newest version of article
    public function articleArray(int $aid): Array 
    {
        $article = new Article($aid);
        return $article->dataArray();
    }
    // new article Object donation
    public function articleObject(int $aid): Article 
    {
        return new Article($aid);
    }
    
    /* FORM PROCESSORS */
    // validate New Article Form
    
    /*
     * TODO: Replace integer outputs to array('status' => 0)
     * 
     * 
     */
    public function fp_articleNew(): Array
    {
        if (filter_input(INPUT_POST, 'anform') == "go") {
            $title = filter_input(INPUT_POST, 'an_title');
            $article = filter_input(INPUT_POST, 'an_article');
            if ($title == "" || $article == "") { 
                return array('status' => 'warning', 'warning' => 'Some fields were empty.');
            }
            $uid = $_SESSION['uid'];
            $sql = "INSERT INTO articles (title,article,uid,gendate) VALUES ('$title','$article','$uid',NOW());";
            $dbc = new DBC();
            if ($dbc->query($sql)) {
                return array('status' => '1');
            }
            else {
                return array('status' => 'warning', 'warning' => $dbc->error());
            }       
        }
        else {
            return array('status' => '0');
        }
    }
  
    public function fp_articleEdit(): Array 
    {
    if (filter_input(INPUT_POST, 'aeform') == "go") {
      if (!filter_input(INPUT_GET, 'id')) { return array('status' => 'warning', 'warning' => 'ArticleID missing.'); }
      $aid = filter_input(INPUT_GET, 'id');
      $title = filter_input(INPUT_POST, 'ae_title');
      $article = filter_input(INPUT_POST, 'ae_article');
      if ($title == "" || $article == "") {return array('status' => 'warning', 'warning' => 'Some fields were empty.');}
      $sql = "UPDATE articles  SET title = '$title', article = '$article'
              WHERE id = '$aid';";
      $dbc = new DBC();
      if ($dbc->query($sql)) {
        return array('status' => '1');
      }
      else {
        return array('warning' => $dbc->error());
      }
    }
    else {
      return array('status' => '0');
    }
  }
  public function fp_articleDelete(): Array 
  {
    if (filter_input(INPUT_POST, 'adform') == "go") {
      if (!filter_input(INPUT_GET, 'id')) { return array('status' => 'warning', 'warning' => 'articleID missing.'); }
      $aid = filter_input(INPUT_GET, 'id');
      $sql = "DELETE FROM articles WHERE id = '$aid';";
      $dbc = new DBC();
      if ($dbc->query($sql)) {
        return array('status' => '1');
      }
      else {
        return array('status' => 'warning', 'warning' => $dbc->error());
      }
    }
    else {
      return array('status' => '0');
    }
  }
  
    /*
     * Form Arrays
     * 
     */
    public function formArray_articleNew()
    {
        return array (
            'form-action'   => 'index.php?page=article&action=new',
            'form-title'    => 'New Article',
            'elements'      => array(
                array(
                    'type'          => 'text',
                    'name'          => 'an_title',
                    'id'            => 'an_title',
                    'class'         => 'form-control',
                    'placeholder'   => 'Title',
                    'setlabel'      => 1,
                    'label'         => 'Title'
                ),
                array(
                    'type'  => 'textarea',
                    'name'  => 'an_article',
                    'id'    => 'an_article',
                    'class' => 'form-control',
                    'placeholder' => 'Article',
                    'setlabel' => 1,
                    'label' => 'Article'
                ),
                array(
                    'type'  => 'hidden',
                    'name'  => 'anform',
                    'value' => 'go'
                ),
                array(
                    'type'  => 'submit',
                    'value' => 'Add Article',
                    'class' => 'btn btn-primary'
                )
            )
        );
    }
}
