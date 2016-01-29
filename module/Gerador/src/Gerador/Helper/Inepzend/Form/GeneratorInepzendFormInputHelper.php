<?php
namespace Gerador\Helper\Inepzend\Form;

use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\IntegerType;
use Gerador\Common\Nomenclatura;
use Doctrine\DBAL\Schema\Column;

/**
 * Class GeneratorFormInputHelper
 * @package Gerador\Helper\Inepzend\Form
 */
class GeneratorInepzendFormInputHelper
{
    use Nomenclatura;

    private $objColumn;
    private $booIsPrimaryKey;
    private $arrForeignKeys;

    private $arrTypes = [
        'Integer' => [
            'strForm' => 'Text',
            'strPrefixo' => 'int',
        ],
        'String' => [
            'strForm' => 'Text',
            'strPrefixo' => 'str',
        ],
        'DateTime' => [
            'strForm' => 'Date',
            'strPrefixo' => 'dt',
        ],
        'Float' => [
            'strForm' => '',
            'strPrefixo' => 'flo',
        ],
    ];

    private $strNameColumn;
    private $booRequired;
    private $arrFormType;

    /**
     * GeneratorFormInputTypeFloat constructor.
     * @param Column $objColumn
     * @param float $booIsPrimaryKey Valor informativo se a coluna eh chave primaria
     * @param array $arrForeignKeys Array com informacoes, caso a coluna for chave estrangeira
     */
    public function __construct(Column $objColumn, $booIsPrimaryKey, $arrForeignKeys)
    {
        $this->objColumn = $objColumn;
        $this->booIsPrimaryKey = $booIsPrimaryKey;
        $this->setStrNameColumn()->setArrFormType()->setBooRequired();
    }

    /**
     *
     */
    private function setArrFormType()
    {
        $this->arrFormType = [];

        if (array_key_exists($this->getType(), $this->arrTypes)) {
            $this->arrFormType = $this->arrTypes[$this->getType()];
        } else {
            $this->arrFormType = [
                'form' => '',
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
        return (string)$this->objColumn->getType();
    }

    /**
     * Create String for input form
     * @return string
     */
    public function getStrCreateInputForm()
    {
        $strCreateInput =
            $this->getInputOpenHtml() .
            $this->getStrAddForm() . '([' . PHP_EOL
            . $this->getStrParamName()
            . $this->getStrLabelName()
            . $this->getStrParamRequired()
            . ']);'
            . $this->getInputCloseHtml()
            . PHP_EOL;

        return $strCreateInput;
    }

    private function getInputOpenHtml()
    {
        return '# ROW Inicio.' . PHP_EOL .
        '$this->addHtml(' . "'" . '<div class="row">' . "'" . ');' . PHP_EOL .
        '$this->addHtml(' . "'" . '<div class="col-md-12">' . "'" . ');' . PHP_EOL . PHP_EOL;
    }


    private function getInputCloseHtml()
    {
        return PHP_EOL . PHP_EOL . '$this->addHtml(' . "'" . '</div>' . "'" . ');' . PHP_EOL .
        '$this->addHtml(' . "'" . '</div>' . "'" . ');' . PHP_EOL .
        '# ROW Fim.' . PHP_EOL . PHP_EOL;
    }


    /**
     * @return mixed
     */
    private function getStrAddForm()
    {
        $strInputType = $this->arrFormType['strForm'];

        if ($this->booIsPrimaryKey) {
            $strInputType = 'Hidden';
        }

        return '$this->add' . $strInputType;
    }

    /**
     * @return string
     */
    private function getStrParamName()
    {
        return '"name" => "' . $this->arrFormType['strPrefixo'] .
        $this->underscoreToCamelcase($this->objColumn->getName()) . '", ' . PHP_EOL;
    }

    /**
     * @return string
     */
    private function getStrLabelName()
    {
        $strLabelName = '';

        if (!$this->booIsPrimaryKey) {
            $strLabelName = '"label" => "' . $this->underscoreToCamelcase($this->objColumn->getName()) . '",' . PHP_EOL;
        }

        return $strLabelName;
    }


    /**
     * @return string
     */
    private function getStrParamRequired()
    {
        $strRequired = 'false';

        if ($this->booIsPrimaryKey) {
            $strRequired = 'false';
        } elseif ($this->objColumn->getNotnull()) {
            $strRequired = 'true';
        }

        return '"required" => "' . $strRequired . '", ' . PHP_EOL;
    }
}
