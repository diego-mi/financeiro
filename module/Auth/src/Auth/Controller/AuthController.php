<?php

namespace Auth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Auth\Form\FormLogin;

class AuthController extends AbstractActionController
{
    public function loginAction()
    {
        $form = new FormLogin();
        $form->prepareElements();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost()->toArray());
            if ($form->isValid()) {
                $data = $form->getData();
                $auth = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
                $adapter = $auth->getAdapter();
                $adapter->setLogin($data['login'])->setPassword($data['password']);
                if ($auth->authenticate()->isValid()) {
                    return $this->redirect()->toRoute(
                        'categoria',
                        array(
                            'controller' => 'categoria',
                            'action' => 'index'
                        )
                    );
                }
                $mensagem = $auth->authenticate()->getMessages();
                $this->flashMessenger()->AddErrorMessage($mensagem[0]);
            }
        }
        /*
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $user =  $entityManager->getRepository('Auth\Entity\User')->findByLoginAndPassword(
            new User(),
            'aaa',
            'aaa'
        );
        var_dump($user);
        */
        return new ViewModel(array('form' => $form));
    }
}
