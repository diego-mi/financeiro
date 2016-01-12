<?php
namespace Tipo\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;
use Base\Form\InputAbstract;

use Tipo\Form\TipoFilter;

/**
 * Class TipoForm
 * @package Tipo\Form
 */
class TipoForm extends Form
{
    /**
     * TipoForm constructor.
     */
    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setInputFilter(new TipoFilter());

        //Input name
        $name = new InputAbstract('name');
        $name->setLabel('Nome')
            ->setAttributes([
                'type' => 'text',
                'maxlength' => 50,
                'id' => 'inputName',
                'class' => 'form-control'
            ])
            ->setOpentag('<div class="form-group">')
            ->setClosetag('</div>');
        $this->add($name);

        //Input Icone
        $name = new InputAbstract('icon');
        $name
            ->setLabel('Icone')
            ->setLabelAttributes([
                'for' => 'inputIcon'
            ])
            ->setAttributes([
                'type' => 'text',
                'maxlength' => 50,
                'id' => 'inputIcon',
                'class' => 'form-control'
            ])
            ->setOpentag('<div class="form-group">')
            ->setClosetag('</div>');
        $this->add($name);

        //Botao submit
        $button = new InputAbstract('submit');
        $button->setLabel('Salvar')
            ->setAttributes(array(
                'type' => 'submit',
                'class' => 'btn',
                'value' => 'Salvar'
            ))
            ->setOpentag('<div class="form-group">')
            ->setClosetag('</div>');
        $this->add($button);
    }
}
