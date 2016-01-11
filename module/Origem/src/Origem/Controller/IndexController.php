<?php
namespace Origem\Controller;

use Base\Controller\AbstractCrudController;

class IndexController extends AbstractCrudController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->strForm = 'Origem\Form\OrigemForm';
        $this->controller = 'origem';
        $this->route = 'origem/default';
        $this->strService = 'Origem\Service\OrigemService';
        $this->strEntity = 'Origem\Entity\Origem';
    }
}
