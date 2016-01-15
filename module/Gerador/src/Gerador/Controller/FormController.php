<?php
namespace Gerador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class FormController
 * @package Gerador\Controller
 */
class FormController extends AbstractActionController
{

    /**
     * Metodo para criar listar opcoes do generator
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        return new ViewModel();
    }

    /**
     * Metodo para criar um controller
     */
    public function criarControllerAction()
    {

    }
}
