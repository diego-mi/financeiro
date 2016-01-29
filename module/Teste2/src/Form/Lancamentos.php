<?php

namespace Teste2\Form;

use InepZend\FormGenerator\FormGenerator;

/**
 * Lancamentos
 *
 * @name Lancamentos
 * @package Teste2
 * @subpackage Form
 * @since 29/01/2016
 */
class Lancamentos extends FormGenerator
{

    /**
     * Adiciona os filtros no form e habilitando a validacao na view.
     *
     * @name __construct
     * @param string $strName
     * @param array $arrOption
     */
    public function __construct($strName, $arrOption)
    {
        parent::__construct($strName, $arrOption);
        $this->setViewValidate(true);
        $this->setInputFilter(new LancamentosFilter());
    }

    /**
     * Adicionando html, campos e botoes no formulario.
     *
     * @name prepareElements
     * @return $this
     */
    public function prepareElements()
    {
        # WELL Inicio.
        $this->addHtml('<div class="well">');

        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->addHidden([
            "name" => "intId",
            "required" => "false",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->addText([
            "name" => "intCategoria",
            "label" => "Categoria",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->addText([
            "name" => "intOperacao",
            "label" => "Operacao",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->addText([
            "name" => "intOrigem",
            "label" => "Origem",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->addText([
            "name" => "intTipo",
            "label" => "Tipo",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->addText([
            "name" => "intPrioridade",
            "label" => "Prioridade",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->addDate([
            "name" => "dtDataLancamento",
            "label" => "DataLancamento",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->addDate([
            "name" => "dtDataPagamento",
            "label" => "DataPagamento",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->add([
            "name" => "floValorInicial",
            "label" => "ValorInicial",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        # ROW Inicio.
        $this->addHtml('<div class="row">');
        $this->addHtml('<div class="col-md-12">');

        $this->add([
            "name" => "floValorFinal",
            "label" => "ValorFinal",
            "required" => "true",
        ]);

        $this->addHtml('</div>');
        $this->addHtml('</div>');
        # ROW Fim.


        $this->addHtml("</ div>");
        # WELL Fim.
    }
}
