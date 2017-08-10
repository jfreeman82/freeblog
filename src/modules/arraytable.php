<?php
namespace freest\blog\modules\arrays;

/*
 * array( 'table-class' => 'table table-bordered',
 *        'data' => array( array('value' => 'name'
 * 
 */

function array2table(Array $array): string
{
  //var_dump($array);
  $items = $array["data"];
  $firstrow = array_shift($items);
    
  $out = '
      <table';
  if (isset($array['table-class'])) { $out .= ' class="'.$array['table-class'].'"';}
  $out .= '>
        <tr class="row">';
  foreach($firstrow as $fr) {
    $out .= '
          <th';
    if (isset($fr['class'])) {
      $out .= ' class="'.$fr['class'].'"';
    }
    $out .= '>'.$fr['value'].'</th>';
  }
  $out .= ' 
        </tr>';
  foreach ($items as $item) {
    $out .= '
        <tr class="row">';
    foreach ($item as $i) {
      $out .= '
          <td>'.$i.'</td>';
    }
    $out .= ' 
        </tr>';      
  }
    
  $out .= ' 
      </table>';
  return $out;
}
