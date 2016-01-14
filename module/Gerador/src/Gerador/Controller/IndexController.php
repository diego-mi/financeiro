<?php
namespace Gerador\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Class IndexController
 * @package Gerador\Controller
 */
class IndexController extends AbstractActionController
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
        $form = $this->getServiceLocator()->get('Gerador\Form\CriarControllerForm');
        $service = $this->getServiceLocator()->get('Gerador\Service\GeradorService');

        $objRequest = $this->getRequest();

        if ($objRequest->isPost()) {
            $form->setData($objRequest->getPost());
            if ($form->isValid()) {
                $arrDataFromForm = $form->getData();

                try {
                    $service->criarController($arrDataFromForm);
                    //return $this->redirect()
                    //    ->toRoute($this->route, array('controller' => 'gerador', 'action' => 'criarController'));
                } catch (\Exception $objException) {
                    $this->flashMessenger()->addErrorMessage($objException->getMessage());
                }
            } else {
                echo ("Form Inválido");
            }
        }

        return new ViewModel(compact('form'));
    }
}
