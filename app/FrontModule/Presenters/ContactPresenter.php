<?php

namespace App\FrontModule\Presenters;

use App\FrontModule\Presenters\BasePresenter;
use Nette;
use Nette\Application\UI\Form;

class ContactPresenter extends BasePresenter {

    public function renderDefault() {   
        $this->template->title = "Ksenergy - Kontakt";

        $this->template->kontakt = true;
        
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

    public function renderComplete() {

        $this->template->title = "Ksenergy - Výborně";

        $this->template->kontakt = true;


    }

}