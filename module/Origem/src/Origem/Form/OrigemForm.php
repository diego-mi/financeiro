<?php
namespace Origem\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class OrigemForm extends Form
{

    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class', 'form-horizontal');

        //Input Name
        $name = new Text('name');
        $name->setLabel('Name')
            ->setAttributes(array(
                'maxlength' => 50
            ));
        $this->add($name);

        //Input Saldo Inicial
        $saldoInicial = new Text('saldoInicial');
        $saldoInicial->setLabel('Saldo Inicial')
            ->setAttributes(array(
                'maxlength' => 10
            ));
        $this->add($saldoInicial);

        //Botao submit
        $button = new Button('submit');
        $button->setLabel('Salvar')
            ->setAttributes(array(
                    'type' => 'submit',
                    'class' => 'btn'
                ));
        $this->add($button);

        $this->setInputFilter(new OrigemFilter());
    }
}
