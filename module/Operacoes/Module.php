<?php
namespace Operacoes;

use Operacoes\Service\OperacoesService;
use Operacoes\Form\OperacoesForm;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Operacoes
 */
class Module
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * @return array
     */
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Operacoes\Service\OperacoesService' => function ($em) {
                    return new OperacoesService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Operacoes\Form\OperacoesForm' => function ($em) {
                    return new OperacoesForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }


}
