<?php
namespace freest\blog\mvc\model;

use freest\modules\DB\DBC as DBC;
use freest\blog\modules\Article;
use freest\blog\mvc\model\Model as Model;

/**
 * Description of ArticleModel
 *
 * @author myrmidex
 */
class ArticleModel extends Model
{

  
    public function articles_all()
    {
        $dbc = new DBC();
        $sql = "SELECT id FROM articles ORDER BY gendate,title DESC;";
        $q = $dbc->query($sql) or die("ERROR Model - ".$dbc->error());
        $out = array();
        while ($row = $q->fetch_assoc()) {
            $article = new Article($row['id']);
            array_push($out, $article->dataArray());
        }    
        return $out;        
    }
    
    public function article($aid): Array 
    {
        $article = new Article($aid);
        return $article->dataArray();
    }
    
}
