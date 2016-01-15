<?php
namespace Gerador\Helper;

use Doctrine\DBAL\Schema\Column;

/**
 * Class GeneratorInputFormHelper
 * @package Gerador\Service
 */
class GeneratorInputFormHelper
{

    /**
     * Method for create a input for new form
     *
     * @param \Doctrine\DBAL\Schema\Column $objColumn
     * @return string
     */
    public function createInput(Column $objColumn)
    {
        return
            '$this->add([' . PHP_EOL .
            "'name' => '" . $this->underscoreToLowerCamelcase($objColumn->getName()) . "'," . PHP_EOL .
            "'type' => 'Text'," . PHP_EOL .
            "'options' => [" . PHP_EOL .
            "'label' => '" . $this->underscoreToSpaceCamelcase($objColumn->getName()) . "'," . PHP_EOL .
            "]," . PHP_EOL .
            "'attributes' => [" . PHP_EOL .
            "'id' => 'input" . $this->underscoreToCamelcase($objColumn->getName()) . "'," . PHP_EOL .
            "'class' => 'form-control'," . PHP_EOL .
            $this->checkInputMaxlength($objColumn) .
            "]," . PHP_EOL .
            "]);" . PHP_EOL . PHP_EOL;
    }

    /**
     * @param $objColumn
     * @return string
     */
    private function checkInputMaxlength($objColumn)
    {
        $strInputMaxLength = '';
        $intLength = $objColumn->getLength();

        if (!is_null($intLength)) {
            $strInputMaxLength = "'maxlength' => '$intLength'," . PHP_EOL;
        }

        return $strInputMaxLength;
    }

    /**
     * @return string
     */
    public function createInputBtnSubmit()
    {
        return
            '$this->add([' . PHP_EOL .
            "'name' => 'submit'," . PHP_EOL .
            "'type' => 'Submit'," . PHP_EOL .
            "'attributes' => [" . PHP_EOL .
            "'class' => 'btn btn-success'," . PHP_EOL .
            "'value' => 'Go'," . PHP_EOL .
            "]," . PHP_EOL .
            "]);" . PHP_EOL . PHP_EOL;
    }


    /**
     * Metodo responsavel por realizar a conversao de uma string com nomenclatura em underscore para
     * Camelcase e substituir '_' por espacos
     *
     * @param $str
     * @return string
     */
    public function underscoreToSpaceCamelcase($str)
    {
        return ucwords(str_replace('_', ' ', strtolower($str)));
    }

    /**
     * Metodo responsavel por realizar a conversao de uma string com nomenclatura em underscore
     * para Camelcase ou lowerCamelcase
     *
     * @param $str
     * @return string
     */
    public function underscoreToCamelcase($str)
    {
        return str_replace(' ', '', $this->underscoreToSpaceCamelcase($str));
    }

    /**
     * Metodo responsavel por realizar a conversao de uma string com nomenclatura em underscore para
     * lowerCamelcase
     *
     * @param $str
     * @return string
     */
    public function underscoreToLowerCamelcase($str)
    {
        return lcfirst($this->underscoreToCamelcase($str));
    }
}
