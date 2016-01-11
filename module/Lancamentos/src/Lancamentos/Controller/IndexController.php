<?php
namespace Lancamentos\Controller;

use Base\Controller\AbstractCrudController;

class IndexController extends AbstractCrudController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->strForm = 'Lancamentos\Form\LancamentosForm';
        $this->controller = 'lancamentos';
        $this->route = 'lancamentos/default';
        $this->strService = 'Lancamentos\Service\LancamentosService';
        $this->strEntity = 'Lancamentos\Entity\Lancamentos';
    }
}
