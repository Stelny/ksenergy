<?php

namespace App\AdminModule\Presenters;

use Nette;
use App\Model;
use App\AdminModule\Presenters\BasePresenter;

class BlogPresenter extends BasePresenter {
    
     /** @var \App\Model\BlogModel */
     protected $blogModel;

     public function inject(
        \App\Model\BlogModel $blogModel
     ) {
        $this->$blogModel = $blogModel;
     }

    public function renderDefault() {

    }
}