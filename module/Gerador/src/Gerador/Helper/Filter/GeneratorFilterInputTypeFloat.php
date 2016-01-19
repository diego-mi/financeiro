<?php

namespace Gerador\Helper\Filter;

use Gerador\Common\Nomenclatura;
use Doctrine\DBAL\Schema\Column;
use Zend\Validator\InArray;

/**
 * Class GeneratorFilterInputTypeFloat
 * @package Gerador\Helper\Filter
 */
class GeneratorFilterInputTypeFloat
{
    use Nomenclatura;

    private $objColumn;
    private $arrForeignKeys;

    /**
     * GeneratorFilterInputTypeFloat constructor.
     * @param $objColumn
     * @param $arrForeignKeys
     */
    public function __construct(Column $objColumn, $arrForeignKeys)
    {
        $this->objColumn = $objColumn;
        $this->arrForeignKeys = $arrForeignKeys[$this->objColumn->getName()];

    }

    /**
     * Create String for input filter
     * @param $objColumn
     * @param $arrForeignKeys
     * @return string
     */
    public function getStrCreateInputFilter()
    {
        $strDeclaracaoDoInputFilter = $this->getStrDeclaracaoDoInputFilter();

        $strCreateInput = $this->getComment();
        $strCreateInput .= $strDeclaracaoDoInputFilter . $this->getInicializacaoInputFilter();
        $strCreateInput .= $strDeclaracaoDoInputFilter . PHP_EOL . $this->getStrRequired() . PHP_EOL;
        $strCreateInput .= $this->getFilters() . PHP_EOL;
        $strCreateInput .= $strDeclaracaoDoInputFilter . $this->getValidators() . PHP_EOL;

        return $strCreateInput;
    }

    /**
     * Comentario para o input filter
     * @return string
     */
    private function getComment()
    {
        return
            '/**' . PHP_EOL .
            '* Column ' . $this->objColumn->getName() . PHP_EOL .
            '* Type ' . $this->objColumn->getType() . PHP_EOL .
            '*/' . PHP_EOL;
    }

    /**
     * @return mixed
     */
    private function getStrDeclaracaoDoInputFilter()
    {
        return '$filter' . $this->underscoreToCamelcase($this->objColumn->getName());
    }

    /**
     * @return string
     */
    private function getInicializacaoInputFilter()
    {
        return ' = new Input("' . $this->underscoreToLowerCamelcase($this->objColumn->getName()) . '");'  . PHP_EOL;
    }

    /**
     * @return string
     */
    private function getStrRequired()
    {
        return '->setRequired(' . $this->objColumn->getNotnull() . ')' . PHP_EOL;
    }

    /**
     * Metodo responsavel por criar a string de validators
     */
    private function getFilters()
    {
        return '->getFilterChain()' . PHP_EOL . '->attach(new StringTrim())' . PHP_EOL . '->attach(new StripTags());';
    }

    /**
     * Metodo responsavel por criar os Validators
     *
     * @return string
     */
    private function getValidators()
    {
        return '->getValidatorChain()' . PHP_EOL . $this->getValidatorsType() .
            $this->getValidatorStringLength() .
            $this->getValidatorInArray() . ';' . PHP_EOL;
    }

    /**
     * Metodo responsavel por adicionar validators padroes. StringTrim e StripTags
     */
    private function getValidatorsType()
    {
        return '->attach(new \Zend\I18n\Validator\IsFloat(["locale" => "pt_BR"]))' . PHP_EOL;
    }


    /**
     * Metodo responsavel por adicionar validators padroes. StringTrim e StripTags
     */
    private function getValidatorStringLength()
    {
        $intMaxLength = $this->objColumn->getPrecision();
        $strValidatorStringLength = '';

        if ($intMaxLength) {
            $strValidatorStringLength = PHP_EOL . '->attach(new StringLength([' . PHP_EOL .
                '"max" => '. $intMaxLength .',' . PHP_EOL .
                '"message" => "Atingiu o limite de caracteres"' . PHP_EOL .
                ']))' . PHP_EOL;
        }

        return $strValidatorStringLength;
    }

    /**
     * Metodo para criar o validator InArray para chaves estrangeiras
     * @return string
     */
    private function getValidatorInArray()
    {
        $strValidatorInArray = '';
        if ($this->arrForeignKeys) {
            $strValidatorInArray = '->attach(new \Zend\Validator\InArray(["haystack" => $' .
                $this->objColumn->getName() .']))';
        }
        return $strValidatorInArray;
    }
}
