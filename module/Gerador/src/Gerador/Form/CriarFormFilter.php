<?php
namespace Gerador\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

/**
 * Class CriarFormFilter
 * @package Gerador\Form
 */
class CriarFormFilter extends InputFilter
{
    /**
     * CriarFormFilter constructor.
     */
    public function __construct()
    {
        # filter for strModuleName
        $strModuleName = new Input('strModuleName');
        $strModuleName->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strModuleName->getValidatorChain()->attach(new NotEmpty());
        $this->add($strModuleName);

        # filter for strFormName
        $strFormName = new Input('strFormName');
        $strFormName->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strFormName->getValidatorChain()->attach(new NotEmpty());
        $this->add($strFormName);

        # filter for strFilterName
        $strFilterName = new Input('strFilterName');
        $strFilterName->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strFilterName->getValidatorChain()->attach(new NotEmpty());
        $this->add($strFilterName);

        # filter for strTableName
        $strTableName = new Input('strTableName');
        $strTableName->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strTableName->getValidatorChain()->attach(new NotEmpty());
        $this->add($strTableName);
    }
}
