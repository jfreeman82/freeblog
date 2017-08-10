<?php
namespace freest\blog\mvc\controller\admin;

/**
 * Description of FrontAdminController
 *
 * @author myrmidex
 */
class FrontAdminController extends AdminController
{

    public function invoke()
    {        
        $this->setView(new FrontAdminView());
        $this->view->front();
    }
    
    
}
