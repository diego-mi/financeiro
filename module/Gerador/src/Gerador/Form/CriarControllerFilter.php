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
        # filter for strForm
        $strForm = new Input('strForm');
        $strForm->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strForm->getValidatorChain()->attach(new NotEmpty());
        $this->add($strForm);

        # filter for strController
        $strController = new Input('strController');
        $strController->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strController->getValidatorChain()->attach(new NotEmpty());
        $this->add($strController);

        # filter for strRoute
        $strRoute = new Input('strRoute');
        $strRoute->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strRoute->getValidatorChain()->attach(new NotEmpty());
        $this->add($strRoute);

        # filter for strService
        $strService = new Input('strService');
        $strService->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strService->getValidatorChain()->attach(new NotEmpty());
        $this->add($strService);

        # filter for strEntity
        $strEntity = new Input('strEntity');
        $strEntity->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $strEntity->getValidatorChain()->attach(new NotEmpty());
        $this->add($strEntity);
    }
}
