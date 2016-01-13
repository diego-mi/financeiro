<?php
namespace Gerador\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;

use Gerador\Form\CriarControllerFilter;

/**
 * Class GeradorForm
 * @package Gerador\Form
 */
class CriarControllerForm extends Form
{
    /**
     * GeradorForm constructor.
     */
    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setInputFilter(new CriarControllerFilter());

        //Input strForm
        $strForm = new Text('strForm');
        $strForm->setLabel('strForm')
            ->setAttributes(array(
                'maxlength' => 100
            ));
        $this->add($strForm);

        //Input strController
        $strController = new Text('strController');
        $strController->setLabel('strController')
            ->setAttributes(array(
                'maxlength' => 100
            ));
        $this->add($strController);

        //Input strRoute
        $strRoute = new Text('strRoute');
        $strRoute->setLabel('strRoute')
            ->setAttributes(array(
                'maxlength' => 100
            ));
        $this->add($strRoute);

        //Input strService
        $strService = new Text('strService');
        $strService->setLabel('strService')
            ->setAttributes(array(
                'maxlength' => 100
            ));
        $this->add($strService);

        //Input strEntity
        $strEntity = new Text('strEntity');
        $strEntity->setLabel('strEntity')
            ->setAttributes(array(
                'maxlength' => 100
            ));
        $this->add($strEntity);

        //Botao submit
        $button = new Button('submit');
        $button->setLabel('Salvar')
            ->setAttributes(array(
                'type' => 'submit',
                'class' => 'btn'
            ));
        $this->add($button);
    }
}
