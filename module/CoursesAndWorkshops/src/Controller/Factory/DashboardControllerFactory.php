<?php

namespace CoursesAndWorkshops\Controller\Factory;

use CoursesAndWorkshops\Controller\DashboardController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DashboardControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        return new DashboardController($entityManager);
    }
}