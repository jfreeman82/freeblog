<?php


// check var, return if found, else return False
function fbvar($var) {
  $dbc = new \FreeBlog\Modules\DB\DBC();
  $sql = "SELECT fb_value FROM freeblog WHERE fb_field = '$var';";
  $q = $dbc->query($sql) or die("ERROR fbvars - ".$dbc->error());
  if ($q->num_rows == 0) { return False; }
  return $q->fetch_assoc()['fb_value'];
}
