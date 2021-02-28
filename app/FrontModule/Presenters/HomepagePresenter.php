<?php

namespace App\FrontModule\Presenters;

use Nette;
use App\Model;


final class HomepagePresenter extends BasePresenter
{

      

    public function renderDefault() {
        
        $this->template->title = "Ksenergy - Ušetřete za vaší energii.";

        $dotace = $this->dotaceModel->getDotace();
        
        foreach ($dotace as $key => $value) {
            $dotace[$key]->kraj = $this->dotaceKrajeModel->getDotaceKrajeById($value->id);
            $dotace[$key]->page = $this->pagesModel->getPageById($value->page_id);
        }

        $gallery = $this->galleryModel->getGallery();

        $settings = $this->settingsModel->getSettings();




        $this->template->dotace = $dotace;

        $this->template->gallery = $gallery;

        

        $this->setLayout('home');
    }

}
