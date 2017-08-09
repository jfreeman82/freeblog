<?php
namespace freest\blog\mvc\model;

use freest\modules\DB\DBC as DBC;
use freest\blog\modules\Article;
/**
 * Description of Model
 *
 * @author myrmidex
 */
class Model 
{
    public function __construct() {}

    public function articles_lastx($x) 
    {
        $dbc = new DBC();
        $sql = "SELECT id FROM articles ORDER BY gendate,title DESC LIMIT $x ;";
        $q = $dbc->query($sql) or die("ERROR Model - ".$dbc->error());
        $out = array();
        while ($row = $q->fetch_assoc()) {
            $article = new Article($row['id']);
            array_push($out, $article->dataArray());
        }    
        return $out;
    }    
}
