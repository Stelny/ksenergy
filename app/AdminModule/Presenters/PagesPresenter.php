<?php

namespace App\AdminModule\Presenters;

use App\AdminModule\Presenters\BasePresenter;
use Nette\Application\UI\Form;

class PagesPresenter extends BasePresenter 
{
    /** @var \App\Model\PagesModel */
    protected $pagesModel;

    /** @var \App\Model\PagesColumnModel */
    protected $pagesColumnModel;

    /** @var \App\Model\DotaceModel */
    protected $dotaceModel;

    /** @var \App\Model\DotaceKrajeModel */
    protected $dotaceKrajeModel;

    public function inject(
        \App\Model\PagesColumnModel $pagesColumnModel,
        \App\Model\PagesModel $pagesModel,
        \App\Model\DotaceModel $dotaceModel,
        \App\Model\DotaceKrajeModel $dotaceKrajeModel
    ) {
        $this->pagesModel = $pagesModel;
        $this->pagesColumnModel = $pagesColumnModel;
        $this->dotaceModel = $dotaceModel;
        $this->dotaceKrajeModel = $dotaceKrajeModel;
    }

    protected function createComponentEditPage(): Form
    {

        $form = new Form;

        $form->addText('name', 'Jméno')
            ->setRequired(); 

        $form->addText('heading', 'Nadpis')
            ->setRequired();
        
        $form->addText('subHeading', 'Podnadpis')
            ->setRequired();   
        
        $form->addTextArea('info', 'Popisek')
            ->setRequired();

        $form->addText('name_pretty', 'name_pretty')
            ->setRequired();  

        $form->addUpload('file', 'Obrázek');
        
        $form->addHidden('id', 'id')
            ->setRequired();
        
        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'pagesFormSucceeded'];

        return $form;
    
    } 

    public function pagesFormSucceeded(Form $form,$values): void
    {
        

        $image = $values->file;

        if ($image->isOk() && $image->isImage()){

            $contentType = $image->getContentType();

            $explode = explode("/",$contentType);

            $extension = $explode[1];

            $this->pagesModel->editPageById($values->name, $values->heading, $values->subHeading, $values->info, $values->name_pretty, $extension, $values->id); 

            $path = 'content/page/' . $values->id . "." . $extension;
            $image->move($path);
        } else {

            $page = $this->pagesModel->getPageById($values->id);


            $response = $this->pagesModel->editPageById($values->name, $values->heading, $values->subHeading, $values->info, $values->name_pretty, $page->extension, $values->id); 
        }
        

        
    }

    public function renderDefault($category) {

        /* DECLARE */
        $pages = $this->pagesModel->getPageByCategory($category);

        /* TEMPLATE */ 
        $this->template->pages = $pages;
    }

    public function actionDetail($id) {
        /* DECLARE */
        $page = $this->pagesModel->getPageById($id);

        /* TEMPLATE */ 
        $this->template->page = $page;

        $this['editPage']->setDefaults($page);
    }

    public function renderColumns($id) {

        $pageColumn = $this->pagesColumnModel->getPagesColumnByPageId($id);

        $this->template->pageColumn = $pageColumn;
    
    }
    

    protected function createComponentEditColumn(): Form
    {

        $form = new Form;

        $form->addText('text', 'Text')
            ->setRequired(); 
        
        $form->addHidden('id', 'id')
            ->setValue("");

        $form->addHidden('page_id', 'page_id')
             ->setValue("");
        
        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'editColumnSucceeded'];

        return $form;
    
    } 

    public function editColumnSucceeded(Form $form,array $values): void
    {
        if (empty($values['id'])) {
            $this->pagesColumnModel->insertPageColumnById($values, $values["page_id"]); 
            
        } else {
            $this->pagesColumnModel->editPageColumnById($values, $values["id"]); 

        }
        $this->redirect("Pages:columns", $values['page_id']);
    }

    public function actionDetailColumn($id ,$reg = false) { 

            

            if ($reg) {
                $this->template->page_id = $id;
            } else {
                $pageColumn = $this->pagesColumnModel->getPagesColumnById($id);

                $this->template->pageColumn = $pageColumn;

                $this['editColumn']->setDefaults($pageColumn);
            }

    }

    public function actionDeleteColumn($id, $page_id) {

        $this->pagesColumnModel->deletePageColumnById($id);
        
        $this->redirect("Pages:columns", $page_id );
    }

    public function renderDotace($id) {

        $dotace = $this->dotaceModel->getDotaceByPageId($id);


        foreach ($dotace as $key => $value) {
            
        $dotace[$key]['kraj'] = $this->dotaceKrajeModel->getDotaceKrajeById($value->dotace_kraje_id);
        
        }

        $this->template->dotace = $dotace;
        
    }




    protected function createComponentEditDotace(): Form
    {

        $form = new Form;

        $form->addText('watt', 'Watt');
        

        $form->addText('phase', 'Phase');
         
        
        $form->addText('dotace_price', 'dotace_price');
       
        
        $form->addText('price', 'price');
     

        $form->addText('your_price', 'your_price');
           
    
        $form->addText('heading', 'heading');
          
    
        $form->addTextArea('content', 'content');
           

        $form->addTextArea('menic', 'menic');
       
        $form->addTextArea('panel', 'panel');
         

        $form->addTextArea('prebytky', 'prebytky');
       

        $form->addTextArea('regulace', 'regulace');


        $form->addHidden('id', 'id')
            ->setValue("");
        
        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'editDotaceSucceeded'];

        return $form;
    
    } 

    public function editDotaceSucceeded(Form $form,$values): void
    {
        $this->dotaceModel->updateDotaceById($values);

    }

    public function actionDotaceDetail($id) { 

            
            $dotace = $this->dotaceModel->getDotaceById($id);

            $this->template->dotace = $dotace;


            $this['editDotace']->setDefaults($dotace);

    }

}   