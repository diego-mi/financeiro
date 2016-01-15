<?php
namespace Gerador\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;

/**
 * Class CriarFilterForm
 * @package Gerador\Form
 */
class CriarFilterForm extends Form
{
    /**
     * GeradorForm constructor.
     */
    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setInputFilter(new CriarFilterFilter());

        //Input strModuleName
        $strModuleName = new Text('strModuleName');
        $strModuleName->setLabel('strModuleName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strModuleName);

        //Input strFilterName
        $strFilterName = new Text('strFilterName');
        $strFilterName->setLabel('strFilterName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strFilterName);

        //Input strTableName
        $strTableName = new Text('strTableName');
        $strTableName->setLabel('strTableName')
            ->setAttributes(array(
                'maxlength' => 100,
                'class' => 'form-control'
            ));
        $this->add($strTableName);

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
