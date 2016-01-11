<?php

namespace Auth\Authentication\Factory;

use Auth\Authentication\Adapter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;

class AuthenticationFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $entityManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $adapter = new Adapter($entityManager);
        $adapter->setEm($entityManager);
        return new AuthenticationService(
            new Session(),
            $adapter
        );
    }
}
