<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Dashboard;

use Laminas\ModuleManager\ModuleManager;
use Laminas\Mvc\MvcEvent;

class Module
{
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function init(ModuleManager $manager)
    {
        // Get event manager.
        $eventManager = $manager->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
        // Register the event listener method.
        $sharedEventManager->attach(__NAMESPACE__, 'dispatch',
            [$this, 'onDispatch'], 100);
    }

    public function onDispatch(MvcEvent $event)
    {
        // Get controller to which the HTTP request was dispatched.
        $controller = $event->getTarget();
        // Get fully qualified class name of the controller.
        $controllerClass = get_class($controller);
        // Get module name of the controller.
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

        // Switch layout only for controllers belonging to our module.
        if ($moduleNamespace == __NAMESPACE__) {
            $viewModel = $event->getViewModel();
            $viewModel->setTemplate('partial/layout');
        }
    }
}
