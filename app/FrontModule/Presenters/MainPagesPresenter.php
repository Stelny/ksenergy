<?php


namespace App\FrontModule\Presenters;

use Nette;
use App\Model;

class MainPagesPresenter extends BasePresenter
{
   

    public function renderDefault($category, $name) {
        
        /* IMPORT */

        $page = $this->pagesModel->getPage($category, $name);

        if (empty($page)) {
            $this->error();
        }

        $pageDay = $this->pagesDayModel->getPagesDayById($page->id, $page->category);
        
        $pageColumn = $this->pagesColumnModel->getPagesColumnByPageId($page->id);

        $dotace = $this->dotaceModel->getDotaceByPageId($page->id);

        foreach ($dotace as $key => $value) {
            
            $dotace[$key]->kraj = $this->dotaceKrajeModel->getDotaceKrajeById($value->dotace_kraje_id);
        }


        /* COLUMNS */

        $columns = [];

        if (count($pageColumn) > 0) {
            foreach ($pageColumn as $key => $value) {
                if ($key%2 == 0) {
                    $columns['first_part'][$key] = $value;
                } else {
                    $columns['last_part'][$key] = $value;
                }    
            }
           
        }

        
        

        /* TEMPLATE */
        $this->template->dotace = $dotace;

        $this->template->pageDay = $pageDay;

        $this->template->columns = $columns;
        
        $this->template->page = $page;

        $this->template->title = "Ksenergy - " . $page->name_pretty;

        $settings = $this->settingsModel->getSettings();

        $this->template->settings = $this->makeSettings($settings);


    }   

    public function renderCerpadlo() {
        $this->template->title = "Ksenergy - Tepelné čerpadla";
    }


}
