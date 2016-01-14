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

        //Input strModuleName
        $strModuleName = new Text('strModuleName');
        $strModuleName->setLabel('strModuleName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strModuleName);

        //Input strFormName
        $strFormName = new Text('strFormName');
        $strFormName->setLabel('strFormName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strFormName);

        //Input strControllerName
        $strControllerName = new Text('strControllerName');
        $strControllerName->setLabel('strControllerName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strControllerName);

        //Input strRouteName
        $strRouteName = new Text('strRouteName');
        $strRouteName->setLabel('strRouteName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strRouteName);

        //Input strServiceName
        $strServiceName = new Text('strServiceName');
        $strServiceName->setLabel('strServiceName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strServiceName);

        //Input strEntityName
        $strEntityName = new Text('strEntityName');
        $strEntityName->setLabel('strEntityName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strEntityName);

        //Botao submit
        $button = new Button('submit');
        $button->setLabel('Salvar')
            ->setAttributes(array(
                'type' => 'submit',
                'class' => 'btn btn-success',
                'value' => 'Criar'
            ));
        $this->add($button);
    }
}
