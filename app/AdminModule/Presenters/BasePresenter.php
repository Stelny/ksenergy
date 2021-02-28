<?php

namespace App\AdminModule\Presenters;

use Nette;
use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter 
{
    
    public function startup() {
        
        parent::startup();

        $session = $this->getSession();
        $section = $session->getSection('login');
        $session->start();
        
        if (!$section->auth) {
            $this->redirect('Auth:In');
        }
    }
}