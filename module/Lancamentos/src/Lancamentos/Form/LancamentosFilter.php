<?php
namespace Lancamentos\Form;

use Base\Form\BaseInputFilter;
use Zend\InputFilter\InputFilter;

/**
 * Class LancamentosFilter
 * @package Lancamentos\Form
 */
class LancamentosFilter extends InputFilter
{
    protected $categoria;
    protected $operacao;
    protected $origem;
    protected $tipo;
    protected $prioridade;

    /**
     * LancamentosFilter constructor.
     * @param array $categoria
     * @param array $operacao
     * @param array $origem
     * @param array $tipo
     * @param array $prioridade
     */
    public function __construct(
        Array $categoria = array(),
        Array $operacao = array(),
        Array $origem = array(),
        Array $tipo = array(),
        Array $prioridade = array()
    ) {
        $this->add(new BaseInputFilter('categoria', $categoria));

        $this->add(new BaseInputFilter('operacao', $operacao));

        $this->add(new BaseInputFilter('origem', $origem));

        $this->add(new BaseInputFilter('valorInicial'));

        $this->add(new BaseInputFilter('valorFinal'));

        $this->add(new BaseInputFilter('tipo', $tipo));

        $this->add(new BaseInputFilter('prioridade', $prioridade));
    }
}
