<?php

declare(strict_types=1);

namespace App\FrontModule\Presenters;

use Nette;
use Nette\Model;


class BasePresenter extends Nette\Application\UI\Presenter
{   

     /** @var \App\Model\PagesModel */
     public $pagesModel;

     /** @var \App\Model\PagesDayModel */
     public $pagesDayModel;
 
     /** @var \App\Model\PagesColumnModel */
     public $pagesColumnModel;
 
     /** @var \App\Model\DotaceModel */
     public $dotaceModel;
 
     /** @var \App\Model\DotacKrajeModel */
     public $dotaceKrajeModel;
 
     /** @var \App\Model\SettingsModel */
     public $settingsModel;

     /** @var \App\Model\GalleryModel */
     public $galleryModel;
 
     public function inject(
         \App\Model\PagesModel $pagesModel,
         \App\Model\PagesDayModel $pagesDayModel,
         \App\Model\PagesColumnModel $pagesColumnModel,
         \App\Model\DotaceModel $dotaceModel,
         \App\Model\SettingsModel $settingsModel,
         \App\Model\DotaceKrajeModel $dotaceKrajeModel,
         \App\Model\galleryModel $galleryModel
         
     ) {
         $this->pagesModel = $pagesModel;
         $this->pagesDayModel = $pagesDayModel;
         $this->pagesColumnModel = $pagesColumnModel;
         $this->dotaceModel = $dotaceModel;
         $this->dotaceKrajeModel = $dotaceKrajeModel;
         $this->settingsModel = $settingsModel;
         $this->galleryModel = $galleryModel;
     }

    public function beforeRender() {
        $this->template->settings = $this->makeSettings($this->settingsModel->getSettings());
        $this->template->ohrev = $this->pagesModel->getPageByCategory('ohrev-teple-vody');
        $this->template->baterie = $this->pagesModel->getPageByCategory('akumulace-do-baterii');
    }

    public function makeSettings($settings): array
    {
        
        $newList = [];
        foreach ($settings as $value) {
            $newList[$value['meta_key']] = $value['meta_value'];
        }
        return $newList;

    }
 
}
