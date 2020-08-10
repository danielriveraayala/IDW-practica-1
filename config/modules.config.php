<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Laminas\Mvc\Plugin\FlashMessenger',
    'Laminas\Session',
    'Laminas\I18n',
    'Laminas\Cache',
    'Laminas\Form',
    'Laminas\InputFilter',
    'Laminas\Filter',
    'Laminas\Hydrator',
    'Laminas\Navigation',
    'Laminas\Paginator',
    'Laminas\Router',
    'Laminas\Validator',
    'Laminas\DeveloperTools',
    'DoctrineModule',
    'DoctrineORMModule',
    'Dashboard',
    'Application',
    'CoursesAndWorkshops',
    'Users',
];
