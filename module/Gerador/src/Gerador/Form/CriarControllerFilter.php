<?php
namespace Gerador\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\NotEmpty;

/**
 * Class CriarControllerFilter
 * @package Gerador\Form
 */
class CriarControllerFilter extends InputFilter
{
    /**
     * CriarControllerFilter constructor.
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

        # filter for strControllerName
        $strControllerName = new Input('strControllerName');
        $strControllerName->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strControllerName->getValidatorChain()->attach(new NotEmpty());
        $this->add($strControllerName);

        # filter for strRouteName
        $strRouteName = new Input('strRouteName');
        $strRouteName->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strRouteName->getValidatorChain()->attach(new NotEmpty());
        $this->add($strRouteName);

        # filter for strServiceName
        $strServiceName = new Input('strServiceName');
        $strServiceName->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strServiceName->getValidatorChain()->attach(new NotEmpty());
        $this->add($strServiceName);

        # filter for strEntityName
        $strEntityName = new Input('strEntityName');
        $strEntityName->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strEntityName->getValidatorChain()->attach(new NotEmpty());
        $this->add($strEntityName);
    }
}
