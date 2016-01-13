<?php
namespace Gerador\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;

use Gerador\Form\GeradorFilter;

/**
 * Class GeradorForm
 * @package Gerador\Form
 */
class GeradorForm extends Form
{
    /**
     * GeradorForm constructor.
     */
    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setInputFilter(new GeradorFilter());

        //Input name
        $name = new Text('name');
        $name->setLabel('Nome')
            ->setAttributes(array(
                    'maxlength' => 50
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