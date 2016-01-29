<?php

namespace Teste2\Form;

use InepZend\Filter\Filter;
use Teste2\Message\Message;

/**
 * LancamentosSalvarFilter
 *
 * Filter do form LancamentosSalvar
 *
 * @name LancamentosSalvarFilter
 * @package Teste2
 * @subpackage Form
 * @since 29/01/2016
 */
class LancamentosSalvarFilter extends Filter
{

    /**
     * LancamentosSalvarFilter constructor.
     */
    public function __construct()
    {
        use Message;
        
        $this->addFilter(["name" => "intId", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilter(["name" => "intCategoria", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilter(["name" => "intOperacao", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilter(["name" => "intOrigem", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilter(["name" => "intTipo", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilter(["name" => "intPrioridade", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilterDate(["name" => "dtDataLancamento", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilterDate(["name" => "dtDataPagamento", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilter(["name" => "floValorInicial", "required" => "true", "message_required" => $this->strMsgE2,]);
        $this->addFilter(["name" => "floValorFinal", "required" => "true", "message_required" => $this->strMsgE2,]);
    }


}

