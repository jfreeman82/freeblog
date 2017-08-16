<?php
namespace freest\blog\mvc\model;

use freest\modules\DB\DBC as DBC;
use freest\blog\modules\articles\Article as Article;

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
    
    public function retrieve_archives() {
        //$sql = "SELECT id, gendate, DISTINCT MONTH(gendate) AS 'month', DISTINCT YEAR(gendate) AS 'year' FROM articles;";
        $sql = "SELECT DATE_FORMAT(gendate, '%m%Y') AS month FROM articles GROUP BY month";
        $dbc = new DBC();
        $q = $dbc->query($sql) or die("ERROR Model - ".$dbc->error());
        $out = array();
        while ($row = $q->fetch_assoc()) {
            //echo $row['month'];
            $monthyear = $row['month'];
            $month = substr($monthyear,0,2);
            $year = substr($monthyear,2);
            $out[] = array( 'month' => $month,
                            'monthname' => date("F",mktime(0,0,0,$month,1,$year)),
                            'year'  => $year
                    );
        }
        return $out;
    }
}
