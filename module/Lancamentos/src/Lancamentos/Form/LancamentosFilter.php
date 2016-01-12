<?php
namespace Lancamentos\Form;

use Zend\Filter\StringTrim;
use Zend\Filter\StripTags;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\Validator\InArray;
use Zend\Validator\NotEmpty;

class LancamentosFilter extends InputFilter
{
    protected $categoria;
    protected $operacao;
    protected $origem;

    public function __construct(
        Array $categoria = array(),
        Array $operacao = array(),
        Array $origem = array(),
        Array $tipo = array()
    ) {
        $this->categoria = $categoria;
        $this->operacao = $operacao;
        $this->origem = $origem;
        $this->tipo = $tipo;

        $arrCategoria = new InArray();
        $arrCategoria->setOptions(array('haystack' => $this->haystack($this->categoria)));

        $categoria = new Input('categoria');
        $categoria->setRequired(true)
            ->getFilterChain()->attach(new StripTags())->attach(new StringTrim());
        $categoria->getValidatorChain()->attach($arrCategoria);
        $this->add($categoria);

        $arrOperacoes = new InArray();
        $arrOperacoes->setOptions(array('haystack' => $this->haystack($this->operacao)));

        $operacao = new Input('operacao');
        $operacao->setRequired(true)
            ->getFilterChain()->attach(new StripTags())->attach(new StringTrim());
        $operacao->getValidatorChain()->attach($arrOperacoes);
        $this->add($operacao);

        $arrOrigem = new InArray();
        $arrOrigem->setOptions(array('haystack' => $this->haystack($this->origem)));

        $origem = new Input('origem');
        $origem->setRequired(true)
            ->getFilterChain()->attach(new StripTags())->attach(new StringTrim());
        $origem->getValidatorChain()->attach($arrOrigem);
        $this->add($origem);

        $valorInicial = new Input('valorInicial');
        $valorInicial->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $valorInicial->getValidatorChain()->attach(new NotEmpty());
        $this->add($valorInicial);

        $valorFinal = new Input('valorFinal');
        $valorFinal->setRequired(true)
            ->getFilterChain()
            ->attach(new StringTrim())
            ->attach(new StripTags());
        $valorFinal->getValidatorChain()->attach(new NotEmpty());
        $this->add($valorFinal);


        $arrTipo = new InArray();
        $arrTipo->setOptions(array('haystack' => $this->haystack($this->tipo)));

        $tipo = new Input('tipo');
        $tipo->setRequired(true)
            ->getFilterChain()->attach(new StripTags())->attach(new StringTrim());
        $tipo->getValidatorChain()->attach($arrTipo);
        $this->add($tipo);
    }

    /**
     * @param array $haystack
     *
     * @return array
     */
    public function haystack(Array $haystack = array())
    {
        $array = array();
        foreach ($haystack as $value) {
            if ($value) {
                $array[$value['value']] = $value['label'];
            }
        }


        return array_keys($array);
    }

}