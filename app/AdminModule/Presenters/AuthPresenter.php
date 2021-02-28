<?php

    namespace App\AdminModule\Presenters;

use Nette\Application\UI\Form;
use Nette\Application\UI\Presenter;
use Nette\Http\Session;

class AuthPresenter extends Presenter {
    

    public function renderIn() {
        $this->setLayout("auth");
    }

    protected function createComponentLoginForm(): Form
    {
        $form = new Form;

        $form->addPassword("password", "Heslo")
            ->setRequired();

        $form->addSubmit("send", "send");

        $form->onSuccess[] = [$this, 'loginFormSucceeded'];

        return $form;
    }

    public function loginFormSucceeded(Form $form, $values) {
        $session = $this->getSession();
        $section = $session->getSection('login');
        $session->start();

        if ($values->password == "KSENERGY532684") {
            
            $section->auth = true;
            $this->redirect('Dashboard:default');

        } else {
            $form->addError("Heslo není správné");
        }
    }




    }