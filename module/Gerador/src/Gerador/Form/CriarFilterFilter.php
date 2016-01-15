<?php
namespace Gerador\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

/**
 * Class CriarFilterFilter
 * @package Gerador\Form
 */
class CriarFilterFilter extends InputFilter
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
