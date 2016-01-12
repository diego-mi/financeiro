<?php
namespace Tipo\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class TipoFilter extends InputFilter
{
    public function __construct()
    {
        $name = new Input('name');
        $name->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $name->getValidatorChain()->attach(new NotEmpty());
        $this->add($name);

        $icon = new Input('icon');
        $icon->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $icon->getValidatorChain()->attach(new NotEmpty());
        $this->add($icon);


    }

}