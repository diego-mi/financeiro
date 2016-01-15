<?php
namespace Categoria\Form;

use Zend\InputFilter\InputFilter;

/**
 * Class CategoriaFilter
 * @package Categoria\Form
 */
class CategoriaFilter extends InputFilter
{
    /**
     * CategoriaFilter constructor.
     */
    public function __construct()
    {
//        $name = new Input('name');
//        $name->setRequired(true)
//            ->getFilterChain()
//                ->attach(new StringTrim())
//                ->attach(new StripTags());
//        $name->getValidatorChain()->attach(new NotEmpty());
//        $this->add($name);

        $this->add([
            'name' => 'name',
            'required' => true,
            'filters' => [
                ['name' => 'StripTags'],
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);


    }

}