<?php
namespace Categoria\Form;

use Zend\Form\Element\Button;
use Zend\Form\Element\Text;
use Zend\Form\Form;

use Categoria\Form\CategoriaFilter;

/**
 * Class CategoriaForm
 * @package Categoria\Form
 */
class CategoriaForm extends Form
{
    /**
     * CategoriaForm constructor.
     */
    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute('method', 'POST');
        $this->setInputFilter(new CategoriaFilter());

        $this->add([
            'name' => 'name',
            'type' => 'Text',
            'options' => [
                'label' => 'Nome',
            ],
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'class' => 'btn btn-success',
                'value' => 'Salvar'
            ],
        ]);
    }

}