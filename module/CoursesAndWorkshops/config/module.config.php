<?php

declare(strict_types=1);

namespace CoursesAndWorkshops;

use CoursesAndWorkshops\Controller\DashboardController;
use CoursesAndWorkshops\Controller\Factory\DashboardControllerFactory;
use CoursesAndWorkshops\Controller\Factory\IndexControllerFactory;
use CoursesAndWorkshops\Controller\IndexController;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    'session_containers' => [

    ],
    'router' => [
        'routes' => [
            'CoursesAndWorkshops' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/cursos-y-talleres',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'previewOfCoursesAndWorkshops' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '[/:titulo[/:id]]',
                            'constrains' => [
                                'id' => '[0-9]*'
                            ],
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'preview'
                            ],
                        ],
                    ],
                    'createOrderOfCoursesAndWorkshops' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/create-order[/:id][/:debug]',
                            'constrains' => [
                                'id' => '[0-9]*',
                                'debug' => '{1}[0-1]'
                            ],
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'createOrder'
                            ],
                        ],
                    ],
                    'captureOrderOfCoursesAndWorkshops' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/capture-order[/:orderID]',
                            'constrains' => [
                                'id' => '[0-9a-zA-Z]*',
                            ],
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'captureOrder'
                            ],
                        ],
                    ],
                    'createInscriptionOfCoursesAndWorkshops' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/inscripcion[/:orderID]',
                            'constrains' => [
                                'orderID' => '[0-9a-zA-Z]*',
                            ],
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'getOrder'
                            ],
                        ],
                    ],
                    'freeCoursesAndWorkshops' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/inscripcion-sin-costo[/:id]',
                            'constrains' => [
                                'id' => '[0-9]*',
                            ],
                            'defaults' => [
                                'controller' => IndexController::class,
                                'action' => 'getFreeOrder'
                            ],
                        ],
                    ],
                ],
            ],
            'coursesAndWorkshopsDashboardAccess' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/dashboard'
                ],
                'may_termenate' => true,
                'child_routes' => [
                    'coursesAndWorkshops' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/cursos-y-talleres[/:action[/:id]]',
                            'constrains' => [
                                'action' => '[A-Za-z0-9-_]*',
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => DashboardController::class,
                                'action' => 'registrationAndEditing'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => IndexControllerFactory::class,
            Controller\DashboardController::class => DashboardControllerFactory::class
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'template_path_stack' => [
            'CoursesAndWorkshops' => __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
];



/*[
    'label' => '<i class="fas nav-icon fa-chalkboard-teacher"></i> <p>Cursos y Talleres <i class="right fas fa-angle-left"></i></p>',
    'route' => 'CoursesAndWorkshops',
    'pages' => [
        [
            'label' => '<i class="fas nav-icon fa-plus-square"></i> <p>Agregar nuevo</p>',
            'route' => 'coursesAndWorkshopsDashboardAccess/registrationAndEditing',
        ],
        [
            'label' => '<i class="fas nav-icon fa-list-ol"></i> <p>Lista</p>',
            'route' => 'coursesAndWorkshopsDashboardAccess/listOfCoursesAndWorkshops',
            'pages' => [
                [
                    'label' => '<i class="fas nav-icon fa-search"></i> <p>Previsualización</p>',
                    'route' => 'coursesAndWorkshopsDashboardAccess/listOfCoursesAndWorkshops/previewOfCoursesAndWorkshops'
                ],
            ],
        ],
    ],
],*/
