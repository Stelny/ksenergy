<?php

declare(strict_types=1);

namespace App\FrontModule\Presenters;

use Nette;
use Nette\Model;
use Nette\Application\UI\Form;

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

     /** @var \App\Model\BlogModel */
     public $blogModel;
 
     public function inject(
         \App\Model\PagesModel $pagesModel,
         \App\Model\PagesDayModel $pagesDayModel,
         \App\Model\PagesColumnModel $pagesColumnModel,
         \App\Model\DotaceModel $dotaceModel,
         \App\Model\SettingsModel $settingsModel,
         \App\Model\DotaceKrajeModel $dotaceKrajeModel,
         \App\Model\galleryModel $galleryModel,
         \App\Model\blogModel $blogModel
         
     ) {
         $this->pagesModel = $pagesModel;
         $this->pagesDayModel = $pagesDayModel;
         $this->pagesColumnModel = $pagesColumnModel;
         $this->dotaceModel = $dotaceModel;
         $this->dotaceKrajeModel = $dotaceKrajeModel;
         $this->settingsModel = $settingsModel;
         $this->galleryModel = $galleryModel;
         $this->blogModel = $blogModel;
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
        
        $form->addSubmit('send', 'Odeslat poptávku');

        $form->onSuccess[] = [$this, 'contactFormSucceeded'];

        return $form;
    
    }


    public function contactFormSucceeded(Form $form, $values) {

     
        $to = "kubikstel@seznam.cz";
        $subject = "KSENERGY - Kontakt";

        $message = "
        <html>
        <head>
        <title>Kontakt</title>
        </head>
        <body>
        <table>
        <tr>
        <th>Email</th>
        <th>Jméno</th>
        <th>Telefon</th>
        <th>Text</th>
        </tr>
        <tr>
        <td>" . $values->email . "</td>
        <td>" . $values->name . "</td>
        <td>" . $values->phone . "</td>
        <td>" . $values->text . "</td>
        </tr>
        </table>
        </body>
        </html>
        ";

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        $headers .= 'From: <info@ksenrgy.cz>' . "\r\n";

        if (mail($to,$subject,$message,$headers)) {
            $this->redirect("Contact:complete");
        } else {
            $this->redirect("Homepage:default");
        }
        

    }
 
}
