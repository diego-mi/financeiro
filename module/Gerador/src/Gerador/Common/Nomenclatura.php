<?php

namespace Gerador\Common;

/**
 * Class Nomenclatura
 *
 * Trait contendo funcoes de tratamento de strings, normalmente usadas em nomenclaturas
 *
 * @package Gerador\Common
 */
trait Nomenclatura
{

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
