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
    private $booIsPrimaryKey;
    private $arrForeignKeys;

    /**
     * GeneratorFilterInputTypeFloat constructor.
     * @param Column $objColumn
     * @param float $booIsPrimaryKey Valor informativo se a coluna eh chave primaria
     * @param array $arrForeignKeys Array com informacoes, caso a coluna for chave estrangeira
     */
    public function __construct(Column $objColumn, $booIsPrimaryKey, $arrForeignKeys)
    {
        $this->objColumn = $objColumn;
        $this->booIsPrimaryKey = $booIsPrimaryKey;
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
        $strCreateInput .= $strDeclaracaoDoInputFilter . $this->getInicializacaoInputFilter() . PHP_EOL;
        $strCreateInput .= $strDeclaracaoDoInputFilter . PHP_EOL . $this->getStrRequired() . PHP_EOL;
        $strCreateInput .= $this->getFilters() . PHP_EOL;
        $strCreateInput .= $strDeclaracaoDoInputFilter . $this->getValidators() . PHP_EOL;
        $strCreateInput .= '$this->add(' . $strDeclaracaoDoInputFilter . ');' . PHP_EOL . PHP_EOL;

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
        return ' = new Input("' . $this->underscoreToLowerCamelcase($this->objColumn->getName()) . '");';
    }

    /**
     * @return string
     */
    private function getStrRequired()
    {
        $booRequired = 'false';

        #chaves primarias nao sao obrigatorias, para que seja possivel utilizar o mesmo form para update e insert
        if ($this->booIsPrimaryKey) {
            $booRequired = 'false';
        } elseif ($this->objColumn->getNotnull()) {
            $booRequired = 'true';
        }

        return '->setRequired(' . (string) $booRequired . ')';
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
        $this->getValidatorInArray() . ';';
    }

    /**
     * Metodo responsavel por adicionar validators padroes. StringTrim e StripTags
     */
    private function getValidatorsType()
    {
        $strValidatorsType = '';
        $objType = $this->objColumn->getType();

        switch ($objType) {
            case 'Integer':
                $strValidatorsType = '->attach(new \Zend\I18n\Validator\IsInt())';
                break;

            case 'DateTime':
                $strValidatorsType = '->attach(new \Zend\Validator\Date(["locale" => "pt_BR", "format" => "d-m-Y"]))';
                break;

            case 'Float':
                $strValidatorsType = '->attach(new \Zend\I18n\Validator\IsFloat(["locale" => "pt_BR"]))';
                break;

            case 'String':
                $strValidatorsType = $this->getValidatorStringLength();
                break;

            default:
                //sem filtros
                break;
        }

        return $strValidatorsType;
    }


    /**
     * Metodo responsavel por adicionar validators padroes. StringTrim e StripTags
     */
    private function getValidatorStringLength()
    {
        $intMaxLength = $this->objColumn->getLength();
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
