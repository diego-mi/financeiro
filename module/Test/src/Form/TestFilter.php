<?php

namespace Test\Form;

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
class TestFilter extends InputFilter
{

    /**
     * CategoriaFilter constructor.
     *
     * @param array $categoria Valores da tabela Array
     * @param array $operacao Valores da tabela Array
     * @param array $origem Valores da tabela Array
     * @param array $tipo Valores da tabela Array
     * @param array $prioridade Valores da tabela Array
     */
    public function __construct($categoria, $operacao, $origem, $tipo, $prioridade)
    {
        $filterId = new BaseInputFilter("id", [], 1, true, 1, 10);
        $this->add($filterId);

        $filterCategoria = new BaseInputFilter("categoria", $categoria, 1, true);
        $this->add($filterCategoria);

        $filterOperacao = new BaseInputFilter("operacao", $operacao, 1, true);
        $this->add($filterOperacao);

        $filterOrigem = new BaseInputFilter("origem", $origem, 1, true);
        $this->add($filterOrigem);

        $filterTipo = new BaseInputFilter("tipo", $tipo, 1, true);
        $this->add($filterTipo);

        $filterPrioridade = new BaseInputFilter("prioridade", $prioridade, 1, true);
        $this->add($filterPrioridade);

        $filterDataLancamento = new BaseInputFilter("dataLancamento", [], 1, true);
        $this->add($filterDataLancamento);

        $filterDataPagamento = new BaseInputFilter("dataPagamento", [], 1, true);
        $this->add($filterDataPagamento);

        /**
         * Column valor_inicial
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
         * Column valor_final
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

