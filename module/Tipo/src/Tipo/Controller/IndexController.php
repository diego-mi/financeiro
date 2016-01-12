<?php
namespace Tipo\Controller;

use Base\Controller\AbstractCrudController;

/**
 * Class IndexController
 * @package Tipo\Controller
 */
class IndexController extends AbstractCrudController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->strForm = 'Tipo\Form\TipoForm';
        $this->controller = 'tipo';
        $this->route = 'tipo/default';
        $this->strService = 'Tipo\Service\TipoService';
        $this->strEntity = 'Tipo\Entity\Tipo';
    }
}
