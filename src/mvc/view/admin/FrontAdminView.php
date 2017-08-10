<?php
namespace freest\blog\mvc\view\admin;

/**
 * Description of FrontAdminView
 *
 * @author myrmidex
 */
class FrontAdminView extends AdminView
{

    // Front
    public function front() 
    {
        $this->content = ' 
      <h1>Home</h1>
      <p>The front page</p>';
        $this->dashboard();
    }
  
}
