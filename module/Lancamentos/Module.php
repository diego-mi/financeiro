<?php
namespace Lancamentos;

use Lancamentos\Service\LancamentosService;
use Lancamentos\Form\LancamentosForm;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Lancamentos
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
                'Lancamentos\Service\LancamentosService' => function ($em) {
                    return new LancamentosService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Lancamentos\Form\LancamentosForm' => function ($em) {
                    return new LancamentosForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }
}
