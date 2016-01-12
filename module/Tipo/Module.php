<?php
namespace Tipo;

use Tipo\Service\TipoService;
use Tipo\Form\TipoForm;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Tipo
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
                'Tipo\Service\TipoService' => function ($em) {
                    return new TipoService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Tipo\Form\TipoForm' => function ($em) {
                    return new TipoForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }


}
