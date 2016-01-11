<?php
namespace Origem;

use Origem\Service\OrigemService;
use Origem\Form\OrigemForm;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

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

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Origem\Service\OrigemService' => function($em){
                    return new OrigemService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Origem\Form\OrigemForm' => function($em){
                    return new OrigemForm($em->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }


}
