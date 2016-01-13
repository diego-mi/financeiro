<?php
namespace Prioridade\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;

use Prioridade\Form\PrioridadeFilter;

class PrioridadeForm extends Form
{
    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setInputFilter(new PrioridadeFilter());

        //Input name
        $name = new Text('name');
        $name->setLabel('Nome')
            ->setAttributes(array(
                'maxlength' => 50
            ));
        $this->add($name);

        //Input icon
        $icon = new Text('icon');
        $icon->setLabel('Icone')
            ->setAttributes(array(
                'maxlength' => 50
            ));
        $this->add($icon);

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