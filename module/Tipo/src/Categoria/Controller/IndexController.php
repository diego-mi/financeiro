<?php
namespace Categoria\Controller;

use Base\Controller\AbstractCrudController;

/**
 * Class IndexController
 * @package Categoria\Controller
 */
class IndexController extends AbstractCrudController
{

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->strForm = 'Categoria\Form\CategoriaForm';
        $this->controller = 'categoria';
        $this->route = 'categoria/default';
        $this->strService = 'Categoria\Service\CategoriaService';
        $this->strEntity = 'Categoria\Entity\Categoria';
    }
}
