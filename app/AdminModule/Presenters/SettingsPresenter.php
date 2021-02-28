<?php

namespace App\AdminModule\Presenters;

use App\AdminModule\Presenters\BasePresenter;
use Nette;
use Nette\Application\UI\Form;
use Nette\Model;

class SettingsPresenter extends BasePresenter 
{
    /** @var \App\Model\SettingsModel */
    protected $settingsModel;

    public function inject(
        \App\Model\SettingsModel $settingsModel
    ) {
        $this->settingsModel = $settingsModel;
    }

    public function renderDefault() {

        /* DECLARE */
        $settings = $this->settingsModel->getSettings();

        /* TEMPLATE */ 
        $this->template->settings = $settings;
    }

    protected function createComponentSettingsForm(): Form
    {

        $form = new Form;

        $form->addText('meta_key', 'Klíč')
            ->setRequired();
        
        $form->addTextArea('describtion', 'Popisek')
            ->setRequired();   
        
        $form->addTextArea('meta_value', 'Hodnota')
            ->setRequired();
        
        $form->addHidden('id', 'id')
            ->setRequired();
        
        $form->addSubmit('send', 'Uložit');

        $form->onSuccess[] = [$this, 'settingsFormSucceeded'];

        return $form;
    
    } 


    public function settingsFormSucceeded(Form $form,array $values): void
    {
        $this->settingsModel->editSettingsById($values); 
    }

    public function actionDetail($id) {
        /* DECLARE */
        $settings = $this->settingsModel->getSettingsById($id);

        /* TEMPLATE */ 
        $this->template->settings = $settings;

        $this['settingsForm']->setDefaults($settings);
    }

    public function renderDetail($id) {
        /* DECLARE */
        $settings = $this->settingsModel->getSettingsById($id);

        /* TEMPLATE */ 
        $this->template->settings = $settings;

    }
}   