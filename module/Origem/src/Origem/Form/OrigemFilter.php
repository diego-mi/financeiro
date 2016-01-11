<?php
namespace Origem\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

class OrigemFilter extends InputFilter
{
    protected $operacao;
    public function __construct(Array $operacao = array())
    {
        $this->operacao = $operacao;

        $name = new Input('name');
        $name->setRequired(true)
            ->getFilterChain()
                ->attach(new StringTrim())
                ->attach(new StripTags());
        $name->getValidatorChain()->attach(new NotEmpty());
        $this->add($name);

        $saldoInicial = new Input('saldoInicial');
        $saldoInicial->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $saldoInicial->getValidatorChain()->attach(new NotEmpty());
        $this->add($saldoInicial);
    }
}
