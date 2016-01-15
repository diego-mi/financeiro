<?php
namespace Gerador;

use Gerador\Form\CriarFormForm;
use Gerador\Form\CriarFilterForm;
use Gerador\Service\GeradorFormService;
use Gerador\Service\GeradorService;
use Gerador\Form\CriarControllerForm;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 * @package Gerador
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
                'Gerador\Service\GeradorService' => function ($em) {
                    return new GeradorService($em->get('Doctrine\ORM\EntityManager'));
                },
                'Gerador\Form\CriarControllerForm' => function () {
                    return new CriarControllerForm();
                },
                'Gerador\Form\CriarFormForm' => function () {
                    return new CriarFormForm();
                },
                'Gerador\Form\CriarFilterForm' => function () {
                    return new CriarFilterForm();
                }
            )
        );
    }


}
