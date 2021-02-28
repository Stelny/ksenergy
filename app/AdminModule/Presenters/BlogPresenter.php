<?php

namespace App\AdminModule\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI\Form;
use App\AdminModule\Presenters\BasePresenter;
use Nette\Utils\Strings;
use Nette\Utils\DateTime;

class BlogPresenter extends BasePresenter {
    
    /** @var \App\Model\BlogModel */
    protected $blogModel;

    public function inject(
        \App\Model\BlogModel $blogModel
    ) {
        $this->blogModel = $blogModel;
    }

    public function renderDefault() {
        
        $blog = $this->blogModel->getBlog();

        $this->template->blog = $blog;

    }
  
    protected function createComponentEditBlog(): Form
    {

        $form = new Form;

        $form->addText("heading", "Jméno")
            ->setRequired();

        $form->addTextArea("content", "Popisek")
            ->setRequired();


        $form->addUpload('file', 'Obrázek')
            ->addRule(Form::IMAGE, 'Image must be JPEG, PNG or GIF.')
            ->addRule(Form::MAX_FILE_SIZE, 'Max size of file is 4 mB.', 4 * 1024 * 1024);
        
        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'editBlogSucceeded'];

        return $form;
    
    }
    
    public function editBlogSucceeded(Form $form,$values) {

        $id = $this->getParameter('id');
        $image = $values->file;
        $date = date('Y-m-d');

        $heading_web = Strings::webalize($values->heading);
        if ($image->isOk() && $image->isImage()){

            $contentType = $image->getContentType();

            $explode = explode("/",$contentType);

            $extension = $explode[1];

            if ($id) {
                $this->blogModel->editPageById($values->heading, $heading_web, $values->content, $extension, $id); 
                $path = 'content/blog/' . $id . "." . $extension;
                $image->move($path);

            } else {
                $this->blogModel->insertBlog($values->heading, $heading_web, $values->content, $extension, $date);

                $id = $this->blogModel->getBlogByName($heading_web)->id;

                $path = 'content/blog/' . $id . "." . $extension;
                $image->move($path);
                
            }

        } else {
            $blog = $this->blogModel->getBlogById($id);

            $this->blogModel->editPageById($values->heading, $values->heading_web, $values->content, $blog->extension, $id); 

        }   


    }

    public function actionDetail($id) {
        /* DECLARE */
        $blog = $this->blogModel->getBlogById($id);

        /* TEMPLATE */ 
        $this->template->blog = $blog;

        $this['editBlog']->setDefaults($blog);
    }
    public function renderDetail() {

    }

    public function actionDelete($id) {
        $this->blogModel->deleteBlog($id);
        $this->redirect("Blog:default");
    }

  /*  public function actionDelete($id) {

        $this->galleryModel->deleteImage($id);

        $this->redirect("Gallery:default");
    }*/



}