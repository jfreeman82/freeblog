<?php
namespace freest\blog\admin\modules\auth;

function isLoggedIn(): bool 
{
  if (isset($_SESSION['uid']) && $_SESSION['uid'] > 0) {
    return TRUE;
  }
  else {
    return FALSE;
  }
}

function logout() 
{
  $_SESSION['uid'] = 0;
  session_destroy();
  header("Location: index.php");
}