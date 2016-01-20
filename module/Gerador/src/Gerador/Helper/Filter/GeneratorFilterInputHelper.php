<?php

namespace Gerador\Helper\Filter;

use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\IntegerType;
use Gerador\Common\Nomenclatura;
use Doctrine\DBAL\Schema\Column;

/**
 * Class GeneratorFilterInputHelper
 * @package Gerador\Helper\Filter
 */
class GeneratorFilterInputHelper
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
        $this->arrForeignKeys = $arrForeignKeys;
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
            '* Filter ' . $this->underscoreToCamelcase($this->objColumn->getName()) . PHP_EOL .
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
        return ' = new Input("' . $this->underscoreToLowerCamelcase($this->objColumn->getName()) . '");' . PHP_EOL;
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
        $strValidatorsType = '';
        $objType = $this->objColumn->getType();

        if (count($this->arrForeignKeys)) {
            $strValidatorsType = '';
        } elseif ($objType == "Integer") {
            $strValidatorsType = '->attach(new \Zend\I18n\Validator\IsInt())' . PHP_EOL;
        } elseif ($objType == "DateTime") {
            $strValidatorsType = '->attach(new \Zend\Validator\Date(["locale" => "pt_BR"]))' . PHP_EOL;
        } elseif ($objType == "Float") {
            $strValidatorsType = '->attach(new \Zend\I18n\Validator\IsFloat(["locale" => "pt_BR"]))' . PHP_EOL;
        }

        return $strValidatorsType;
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
                '"max" => ' . $intMaxLength . ',' . PHP_EOL .
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
                $this->objColumn->getName() . ']))';
        }
        return $strValidatorInArray;
    }
}
