<?php
namespace Prioridade\Controller;

use Base\Controller\AbstractCrudController;

/**
 * Class IndexController
 * @package Prioridade\Controller
 */
class IndexController extends AbstractCrudController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->strForm = 'Prioridade\Form\PrioridadeForm';
        $this->controller = 'prioridade';
        $this->route = 'prioridade/default';
        $this->strService = 'Prioridade\Service\PrioridadeService';
        $this->strEntity = 'Prioridade\Entity\Prioridade';
    }
}
