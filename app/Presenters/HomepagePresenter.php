<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use App\Model;


final class HomepagePresenter extends BasePresenter
{
    /** @var \App\Model\PagesModel */
    protected $pagesModel;

    /** @var \App\Model\DotaceModel */
    protected $dotaceModel;

    /** @var \App\Model\DotacKrajeModel */
    protected $dotaceKrajeModel;

    public function inject(
        \App\Model\PagesModel $pagesModel,
        \App\Model\DotaceModel $dotaceModel,
        \App\Model\DotaceKrajeModel $dotaceKrajeModel
    ) {
        $this->pagesModel = $pagesModel;
        $this->dotaceModel = $dotaceModel;
        $this->dotaceKrajeModel = $dotaceKrajeModel;
    }

    function renderDefault() {
        
        $dotace = $this->dotaceModel->getDotace();
        
        foreach ($dotace as $key => $value) {
            $dotace[$key]->kraj = $this->dotaceKrajeModel->getDotaceKrajeById($value->id);
            $dotace[$key]->page = $this->pagesModel->getPageById($value->page_id);
        }

        $this->template->dotace = $dotace;

        $this->setLayout('home');
    }
}
