<?php

namespace App\FrontModule\Presenters;

use App\FrontModule\Presenters\BasePresenter;
use Nette;
use Nette\Application\UI\Form;

class ContactPresenter extends BasePresenter {

    public function renderDefault() {   
        $this->template->title = "Ksenergy - Kontakt";

        
    }


    protected function createComponentContactForm(): Form
    {

        $form = new Form;

        $form->addText('name', 'Jméno')
            ->setHtmlAttribute('placeholder', 'Jméno')
            ->setRequired(); 
        
        $form->addText('phone', 'Telefon')
            ->setHtmlAttribute('placeholder', 'Telefon')
            ->setRequired(); 
    
        $form->addText('email', 'Email')
            ->setHtmlAttribute('placeholder', 'Email')
            ->setRequired(); 

        $form->addTextArea('text', 'Text')
            ->setValue("Dobrý den, mám zájem o vytvoření kalkulace na rodinný dům v Moravskoslezském kraji. Děkuji")
            ->setRequired(); 

        
       /*$form->addSubmit('send', 'Uložit');*/

        $form->onSuccess[] = [$this, 'pagesFormSucceeded'];

        return $form;
    
    } 

}