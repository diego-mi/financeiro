<?php
namespace Gerador\Helper;

use Doctrine\DBAL\Schema\Column;
use Gerador\Common\Nomenclatura;

use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\DateTimeType;
use Doctrine\DBAL\Types\FloatType;
use Gerador\Helper\Filter\GeneratorFilterInputTypeFloat;

/**
 * Class GeneratorInputFilterHelper
 * @package Gerador\Service
 */
class GeneratorInputFilterHelper
{

    use Nomenclatura;

    /**
     * Method for create a input for new form
     *
     * @param \Doctrine\DBAL\Schema\Column $objColumn
     * @param array $arrForeignKeys Foreign keys
     * @return string
     */
    public function createInput(Column $objColumn, $arrForeignKeys)
    {
        if ($objColumn->getType() instanceof FloatType) {
            $objInputFilter = new GeneratorFilterInputTypeFloat($objColumn, $arrForeignKeys);
            return $objInputFilter->getStrCreateInputFilter();
        }

        return
            '$filter' . $this->underscoreToCamelcase($objColumn->getName()) . ' = new BaseInputFilter(' .
            '"' . $this->underscoreToLowerCamelcase($objColumn->getName()) . '", ' .
            $this->getParamsToHaystack($arrForeignKeys[$objColumn->getName()]) . ', '.
            (boolean) $objColumn->getNotnull() . ', true' .
            $this->getStrMinAndMaxlength($objColumn, $arrForeignKeys) . ');' . PHP_EOL .
            '$this->add($filter' . $this->underscoreToCamelcase($objColumn->getName()) . ');' . PHP_EOL . PHP_EOL;
    }

    /**
     * Metodo responsavel por setar o parametro para o haystack
     * @param array $arrParamToHaystack
     * @return string
     */
    private function getParamsToHaystack($arrParamToHaystack = array())
    {
        $strHaystack = '[]';
        if (count($arrParamToHaystack)) {
            $strHaystack = '$' . $arrParamToHaystack["strColumns"];
        }
        return $strHaystack;
    }

    /**
     * Metodo para criar a string para min e max length
     *
     * @param $objColumn
     * @return string
     */
    private function getStrMinAndMaxlength($objColumn, $arrForeignKeys)
    {
        if ($arrForeignKeys[$objColumn->getName()]) {
            return '';
        }

        $strMinAndMaxLength = '';
        $intMaxLength = $this->getMaxlength($objColumn);

        if (($objColumn->getNotnull() && ($intMaxLength))) {
            $strMinAndMaxLength = ', ' . $this->getMinlength($objColumn) . ', ' . $this->getMaxlength($objColumn);
        }

        return $strMinAndMaxLength;

    }

    /**
     * Metodo responsavel por recuperar o maxlength
     *
     * @param Column $objColumn
     * @return int|null
     */
    private function getMaxlength($objColumn)
    {
        $intMaxLength = 0;
        $objType = $objColumn->getType();

        if ($objType instanceof IntegerType) {
            $intMaxLength = $objColumn->getPrecision();
        } elseif ($objType instanceof StringType) {
            $intMaxLength = $objColumn->getLength();
        } elseif ($objType instanceof DateTimeType) {
            $intMaxLength = 0;
        } elseif ($objType instanceof FloatType) {
            $intMaxLength = $objColumn->getPrecision();
        }

        return $intMaxLength;
    }

    /**
     * Metodo responsavel por recuperar o maxlength
     *
     * @param Column $objColumn
     * @return int|null
     */
    private function getMinlength($objColumn)
    {
        $intMinLength = 0;

        if ($objColumn->getNotnull()) {
            $intMinLength = 1;
        }

        return $intMinLength;
    }
}
