<?php

namespace Teste2\Form;

use InepZend\Filter\Filter;
use Module\Message\Message;

/**
 * Lancamentos
 *
 * Filter do form Lancamentos
 *
 * @name Lancamentos
 * @package Modulo
 * @subpackage Form
 * @since 00/00/0000
 */
class IgoMeninoBaumFilter extends Filter
{

    /**
     * IgomeninobaumfilterFilter constructor.
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

