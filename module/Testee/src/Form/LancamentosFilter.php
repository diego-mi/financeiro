<?php

namespace Testee\Form;

use Zend\InputFilter\InputFilter;
use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\Validator\StringLength;

/**
 * Filter for Entity Categoria
 *
 * This is a class generated with Generator for skeleton-zend. By Diego-Mi
 */
class LancamentosFilter extends InputFilter
{

    /**
     * CategoriaFilter constructor.
     *
     * @param array $categoria Valores da tabela categoria
     * @param array $operacao Valores da tabela operacao
     * @param array $origem Valores da tabela origem
     * @param array $tipo Valores da tabela tipo
     * @param array $prioridade Valores da tabela prioridade
     */
    public function __construct($categoria, $operacao, $origem, $tipo, $prioridade)
    {
        /**
         * Filter Id
         * Type Integer
         */
        $filterId = new Input("id");
        $filterId
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterId->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsInt())
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]));

        /**
         * Filter Categoria
         * Type Integer
         */
        $filterCategoria = new Input("categoria");
        $filterCategoria
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterCategoria->getValidatorChain()
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]))
            ->attach(new \Zend\Validator\InArray(["haystack" => $categoria]));

        /**
         * Filter Operacao
         * Type Integer
         */
        $filterOperacao = new Input("operacao");
        $filterOperacao
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterOperacao->getValidatorChain()
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]))
            ->attach(new \Zend\Validator\InArray(["haystack" => $operacao]));

        /**
         * Filter Origem
         * Type Integer
         */
        $filterOrigem = new Input("origem");
        $filterOrigem
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterOrigem->getValidatorChain()
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]))
            ->attach(new \Zend\Validator\InArray(["haystack" => $origem]));

        /**
         * Filter Tipo
         * Type Integer
         */
        $filterTipo = new Input("tipo");
        $filterTipo
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterTipo->getValidatorChain()
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]))
            ->attach(new \Zend\Validator\InArray(["haystack" => $tipo]));

        /**
         * Filter Prioridade
         * Type Integer
         */
        $filterPrioridade = new Input("prioridade");
        $filterPrioridade
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterPrioridade->getValidatorChain()
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]))
            ->attach(new \Zend\Validator\InArray(["haystack" => $prioridade]));

        /**
         * Filter DataLancamento
         * Type DateTime
         */
        $filterDataLancamento = new Input("dataLancamento");
        $filterDataLancamento
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterDataLancamento->getValidatorChain()
            ->attach(new \Zend\Validator\Date(["locale" => "pt_BR"]))
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]));

        /**
         * Filter DataPagamento
         * Type DateTime
         */
        $filterDataPagamento = new Input("dataPagamento");
        $filterDataPagamento
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterDataPagamento->getValidatorChain()
            ->attach(new \Zend\Validator\Date(["locale" => "pt_BR"]))
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]));

        /**
         * Filter ValorInicial
         * Type Float
         */
        $filterValorInicial = new Input("valorInicial");
        $filterValorInicial
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterValorInicial->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsFloat(["locale" => "pt_BR"]))
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]));

        /**
         * Filter ValorFinal
         * Type Float
         */
        $filterValorFinal = new Input("valorFinal");
        $filterValorFinal
            ->setRequired(1)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterValorFinal->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsFloat(["locale" => "pt_BR"]))
            ->attach(new StringLength([
                "max" => 10,
                "message" => "Atingiu o limite de caracteres"
            ]));
    }


}

