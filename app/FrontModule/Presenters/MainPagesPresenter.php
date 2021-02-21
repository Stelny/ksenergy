<?php


namespace App\FrontModule\Presenters;

use Nette;
use App\Model;

class MainPagesPresenter extends BasePresenter
{
     /** @var \App\Model\PagesModel */
     protected $pagesModel;

    /** @var \App\Model\PagesDayModel */
    protected $pagesDayModel;

    /** @var \App\Model\PagesColumnModel */
    protected $pagesColumnModel;

    /** @var \App\Model\DotaceModel */
    protected $dotaceModel;

    /** @var \App\Model\DotacKrajeModel */
    protected $dotaceKrajeModel;

    public function inject(
        \App\Model\PagesModel $pagesModel,
        \App\Model\PagesDayModel $pagesDayModel,
        \App\Model\PagesColumnModel $pagesColumnModel,
        \App\Model\DotaceModel $dotaceModel,
        \App\Model\DotaceKrajeModel $dotaceKrajeModel
        
    ) {
        $this->pagesModel = $pagesModel;
        $this->pagesDayModel = $pagesDayModel;
        $this->pagesColumnModel = $pagesColumnModel;
        $this->dotaceModel = $dotaceModel;
        $this->dotaceKrajeModel = $dotaceKrajeModel;
    }

    public function renderDefault($category, $name) {
        
        /* IMPORT */

        $page = $this->pagesModel->getPage($category, $name);

        if (empty($page)) {
            $this->error();
        }

        $pageDay = $this->pagesDayModel->getPagesDayById($page->id, $page->category);
        
        $pageColumn = $this->pagesColumnModel->getPagesColumnById($page->id);

        $dotace = $this->dotaceModel->getDotaceByPageId($page->id);

        foreach ($dotace as $key => $value) {
            
            $dotace[$key]->kraj = $this->dotaceKrajeModel->getDotaceKrajeById($value->dotace_kraje_id);
        }


        /* COLUMNS */

        $columns = [];

        if (count($pageColumn) > 1) {
            foreach ($pageColumn as $key => $value) {
                if ($key%2 == 0) {
                    $columns['first_part'][$key] = $value;
                } else {
                    $columns['last_part'][$key] = $value;
                }    
            }
           
        } else {
            $columns["first_part"][$key] = $pageColumn[0];
        }

        
        

        /* TEMPLATE */
        $this->template->dotace = $dotace;

        $this->template->pageDay = $pageDay;

        $this->template->columns = $columns;
        
        $this->template->page = $page;


    }   


}
