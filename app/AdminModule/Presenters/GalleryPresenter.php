<?php

namespace App\AdminModule\Presenters;

use App\AdminModule\Presenters\BasePresenter;
use Nette;
use Nette\Application\UI\Form;
use Nette\Http;

class GalleryPresenter extends BasePresenter
{
    /** @var \App\Model\GalleryModel */
    protected $galleryModel;

    public function inject(
        \App\Model\GalleryModel $galleryModel
    ) {
        $this->galleryModel = $galleryModel;
    }

    public function renderDefault() {
        
        $gallery = $this->galleryModel->getGallery();

        $this->template->gallery = $gallery;
    }

    public function renderCreate() {
        
    }

    protected function createComponentCreatePhoto(): Form
    {

        $form = new Form;

        $form->addUpload('file', 'Obrázek')
            ->addRule(Form::IMAGE, 'Image must be JPEG, PNG or GIF.')
            ->addRule(Form::MAX_FILE_SIZE, 'Max size of file is 4 mB.', 4 * 1024 * 1024)
            ->setRequired(); 
        
        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'createPhotoSucceeded'];

        return $form;
    
    } 

    public function createPhotoSucceeded($form,$values) {

        $image = $values->file;

        if ($image->isOk() && $image->isImage()){

            $contentType = $image->getContentType();

            $explode = explode("/",$contentType);

            $extension = $explode[1];

            $this->galleryModel->insertImage($extension);

            $photo = $this->galleryModel->getGallery("DESC")[0];

            $path = 'content/gallery/' . $photo->id . "." . $photo->extension;
            $image->move($path);
        }
    }

    public function actionDelete($id) {

        $this->galleryModel->deleteImage($id);

        $this->redirect("Gallery:default");
    }

}