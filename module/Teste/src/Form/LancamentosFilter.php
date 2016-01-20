<?php

namespace Teste\Form;

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
            ->setRequired(false)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterId->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsInt());
        $this->add($filterId);

        /**
         * Filter Categoria
         * Type Integer
         */
        $filterCategoria = new Input("categoria");
        $filterCategoria
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterCategoria->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsInt())->attach(new \Zend\Validator\InArray(["haystack" => $categoria]));
        $this->add($filterCategoria);

        /**
         * Filter Operacao
         * Type Integer
         */
        $filterOperacao = new Input("operacao");
        $filterOperacao
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterOperacao->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsInt())->attach(new \Zend\Validator\InArray(["haystack" => $operacao]));
        $this->add($filterOperacao);

        /**
         * Filter Origem
         * Type Integer
         */
        $filterOrigem = new Input("origem");
        $filterOrigem
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterOrigem->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsInt())->attach(new \Zend\Validator\InArray(["haystack" => $origem]));
        $this->add($filterOrigem);

        /**
         * Filter Tipo
         * Type Integer
         */
        $filterTipo = new Input("tipo");
        $filterTipo
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterTipo->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsInt())->attach(new \Zend\Validator\InArray(["haystack" => $tipo]));
        $this->add($filterTipo);

        /**
         * Filter Prioridade
         * Type Integer
         */
        $filterPrioridade = new Input("prioridade");
        $filterPrioridade
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterPrioridade->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsInt())->attach(new \Zend\Validator\InArray(["haystack" => $prioridade]));
        $this->add($filterPrioridade);

        /**
         * Filter DataLancamento
         * Type DateTime
         */
        $filterDataLancamento = new Input("dataLancamento");
        $filterDataLancamento
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterDataLancamento->getValidatorChain()
            ->attach(new \Zend\Validator\Date(["locale" => "pt_BR", "format" => "d-m-Y"]));
        $this->add($filterDataLancamento);

        /**
         * Filter DataPagamento
         * Type DateTime
         */
        $filterDataPagamento = new Input("dataPagamento");
        $filterDataPagamento
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterDataPagamento->getValidatorChain()
            ->attach(new \Zend\Validator\Date(["locale" => "pt_BR", "format" => "d-m-Y"]));
        $this->add($filterDataPagamento);

        /**
         * Filter ValorInicial
         * Type Float
         */
        $filterValorInicial = new Input("valorInicial");
        $filterValorInicial
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterValorInicial->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsFloat(["locale" => "pt_BR"]));
        $this->add($filterValorInicial);

        /**
         * Filter ValorFinal
         * Type Float
         */
        $filterValorFinal = new Input("valorFinal");
        $filterValorFinal
            ->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $filterValorFinal->getValidatorChain()
            ->attach(new \Zend\I18n\Validator\IsFloat(["locale" => "pt_BR"]));
        $this->add($filterValorFinal);
    }
}
