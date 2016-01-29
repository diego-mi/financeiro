<?php

namespace Gerador\Helper\Inepzend\Filter;

use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\IntegerType;
use Gerador\Common\Nomenclatura;
use Doctrine\DBAL\Schema\Column;

/**
 * Class GeneratorFilterInputHelper
 * @package Gerador\Helper\Filter
 */
class GeneratorInepzendFilterInputHelper
{
    use Nomenclatura;

    private $objColumn;
    private $booIsPrimaryKey;
    private $arrForeignKeys;

    private $arrTypes = [
        'Integer' => [
            'strFilter' => '',
            'strPrefixo' => 'int',
        ],
        'String' => [
            'strFilter' => '',
            'strPrefixo' => 'str',
        ],
        'DateTime' => [
            'strFilter' => 'Date',
            'strPrefixo' => 'dt',
        ],
        'Float' => [
            'strFilter' => '',
            'strPrefixo' => 'flo',
        ],
    ];

    private $strNameColumn;
    private $booRequired;
    private $arrFilterType;

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
        $this->setStrNameColumn()->setArrFilterType()->setBooRequired();
    }


    /**
     *
     */
    private function setArrFilterType()
    {
        $this->arrFilterType =[];

        if (array_key_exists($this->getType(), $this->arrTypes)) {
            $this->arrFilterType = $this->arrTypes[$this->getType()];
        } else {
            $this->arrFilterType = [
                'filter' => '',
                'prefixo' => '',
            ];
        }

        return $this;
    }

    /**
     * @return $this
     */
    private function setStrNameColumn()
    {
        $this->strNameColumn = $this->underscoreToCamelcase($this->objColumn->getName());

        return $this;
    }

    /**
     * @return $this
     */
    private function setBooRequired()
    {
        if ($this->booIsPrimaryKey) {
            $this->booRequired = 'false';
        } elseif ($this->objColumn->getNotnull()) {
            $this->booRequired = 'true';
        }

        return $this;
    }

    /**
     * Metodo responsavel por recuperar o tipo de dado da coluna
     *
     * @return string
     */
    private function getType()
    {
        return (string) $this->objColumn->getType();
    }

    /**
     * Create String for input filter
     * @return string
     */
    public function getStrCreateInputFilter()
    {
        $strCreateInput = $this->getStrAddFilter() . '(['
            . $this->getStrParamName()
            . $this->getStrParamRequired()
            . $this->getStrParamMessage() . ']);' . PHP_EOL;

        return $strCreateInput;
    }


    /**
     * @return mixed
     */
    private function getStrAddFilter()
    {
        return '$this->addFilter' . $this->arrFilterType['strFilter'];
    }

    /**
     * @return string
     */
    private function getStrParamName()
    {
        return '"name" => "' .
        $this->arrFilterType['strPrefixo'] .
        $this->underscoreToCamelcase($this->objColumn->getName()) . '", ';
    }


    /**
     * @return string
     */
    private function getStrParamRequired()
    {
        $strRequired = 'false';

        if ($this->booIsPrimaryKey) {
            $strRequired = 'true';
        } elseif ($this->objColumn->getNotnull()) {
            $strRequired = 'true';
        }

        return '"required" => "' . $strRequired . '", ';
    }

    /**
     * @return string
     */
    private function getStrParamMessage()
    {
        $strMessage = '';

        if ($this->objColumn->getNotnull()) {
            $strMessage = '"message_required" => $this->strMsgE2,';
        }

        return $strMessage;
    }
}
