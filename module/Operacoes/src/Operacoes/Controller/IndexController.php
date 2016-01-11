<?php
namespace Operacoes\Controller;

use Base\Controller\AbstractCrudController;

/**
 * Class IndexController
 * @package Operacoes\Controller
 */
class IndexController extends AbstractCrudController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->strForm = 'Operacoes\Form\OperacoesForm';
        $this->controller = 'operacoes';
        $this->route = 'operacoes/default';
        $this->strService = 'Operacoes\Service\OperacoesService';
        $this->strEntity = 'Operacoes\Entity\Operacoes';
    }
}
