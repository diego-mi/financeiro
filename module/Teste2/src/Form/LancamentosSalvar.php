<?php

namespace Teste2\Form;

use Zend\Form\Form;
use Teste2\Form\LancamentosSalvarFilter;

/**
 * Form for Entity Categoria
 *
 * This is a class generated with Generator for skeleton-zend. By Diego-Mi
 */
class LancamentosSalvar extends Form
{

    /**
     * CategoriaForm constructor.
     */
    public function __construct()
    {
        parent::__construct(null);
        $this->setAttribute("method", "POST");
        $this->setInputFilter(new LancamentosSalvarFilter());

        $this->add([
            'name' => 'id',
            'type' => 'Text',
            'options' => [
                'label' => 'Id',
            ],
            'attributes' => [
                'id' => 'inputId',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'categoria',
            'type' => 'Text',
            'options' => [
                'label' => 'Categoria',
            ],
            'attributes' => [
                'id' => 'inputCategoria',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'operacao',
            'type' => 'Text',
            'options' => [
                'label' => 'Operacao',
            ],
            'attributes' => [
                'id' => 'inputOperacao',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'origem',
            'type' => 'Text',
            'options' => [
                'label' => 'Origem',
            ],
            'attributes' => [
                'id' => 'inputOrigem',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'tipo',
            'type' => 'Text',
            'options' => [
                'label' => 'Tipo',
            ],
            'attributes' => [
                'id' => 'inputTipo',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'prioridade',
            'type' => 'Text',
            'options' => [
                'label' => 'Prioridade',
            ],
            'attributes' => [
                'id' => 'inputPrioridade',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'dataLancamento',
            'type' => 'Text',
            'options' => [
                'label' => 'Data Lancamento',
            ],
            'attributes' => [
                'id' => 'inputDataLancamento',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'dataPagamento',
            'type' => 'Text',
            'options' => [
                'label' => 'Data Pagamento',
            ],
            'attributes' => [
                'id' => 'inputDataPagamento',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'valorInicial',
            'type' => 'Text',
            'options' => [
                'label' => 'Valor Inicial',
            ],
            'attributes' => [
                'id' => 'inputValorInicial',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'valorFinal',
            'type' => 'Text',
            'options' => [
                'label' => 'Valor Final',
            ],
            'attributes' => [
                'id' => 'inputValorFinal',
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'class' => 'btn btn-success',
                'value' => 'Go',
            ],
        ]);
    }


}

