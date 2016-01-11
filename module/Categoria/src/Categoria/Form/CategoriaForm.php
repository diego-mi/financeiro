<?php
namespace Categoria\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;

use Categoria\Form\CategoriaFilter;

class CategoriaForm extends Form
{
    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setInputFilter(new CategoriaFilter());

        //Input name
        $name = new Text('name');
        $name->setLabel('Nome')
            ->setAttributes(array(
                    'maxlength' => 45
                ));
        $this->add($name);

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