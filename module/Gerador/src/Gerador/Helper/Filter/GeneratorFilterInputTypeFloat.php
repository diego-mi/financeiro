<?php

namespace Gerador\Helper\Filter;

use Gerador\Common\Nomenclatura;
use Doctrine\DBAL\Schema\Column;

/**
 * Class GeneratorFilterInputTypeFloat
 * @package Gerador\Helper\Filter
 */
class GeneratorFilterInputTypeFloat
{
    use Nomenclatura;

    private $objColumn;
    private $objForeignKey;

    /**
     * GeneratorFilterInputTypeFloat constructor.
     * @param $objColumn
     * @param $arrForeignKeys
     */
    public function __construct(Column $objColumn, $arrForeignKeys)
    {
        $this->objColumn = $objColumn;
        $this->objForeignKey = $arrForeignKeys[$this->objColumn->getName()];

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
        $strCreateInput .= $strDeclaracaoDoInputFilter . $this->getStrRequired();
        $strCreateInput .= $this->getValidators() . PHP_EOL;

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
    private function getValidators()
    {
        return '->getFilterChain()' . PHP_EOL .
            $this->getValidatorsDefault() .
            $this->getValidatorsType() .
            $this->getValidatorStringLength() . ';' . PHP_EOL;
    }

    /**
     * Metodo responsavel por adicionar validators padroes. StringTrim e StripTags
     */
    private function getValidatorsDefault()
    {
        return '->attach(new StringTrim())' . PHP_EOL . '->attach(new StripTags())';
    }

    /**
     * Metodo responsavel por adicionar validators padroes. StringTrim e StripTags
     */
    private function getValidatorsType()
    {
        return PHP_EOL . '->attach(new \Zend\I18n\Validator\IsFloat(["locale" => "pt_BR"]))';
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
                ']))';
        }

        return $strValidatorStringLength;
    }
}
