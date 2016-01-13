<?php
namespace Prioridade;

use Prioridade\Service\PrioridadeService;
use Prioridade\Form\PrioridadeForm;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Prioridade
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
                'Prioridade\Service\PrioridadeService' => function ($em) {
                    return new PrioridadeService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Prioridade\Form\PrioridadeForm' => function ($em) {
                    return new PrioridadeForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }


}
