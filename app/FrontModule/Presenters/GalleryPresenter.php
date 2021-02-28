<?php

namespace App\FrontModule\Presenters;

use App\FrontModule\Presenters\BasePresenter;
use Nette;

class GalleryPresenter extends BasePresenter {

    public function renderDefault() {

        $gallery = $this->galleryModel->getGallery();

        $this->template->gallery = $gallery;

        $this->template->title = "Ksenergy - Galerie";

    }

}