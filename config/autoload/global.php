<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Laminas\Session\Storage\SessionArrayStorage;

return [
    'session_config' => [
        'save_path' => 'data/session',
        // Session cookie will expire in 1 hour.
        'cookie_lifetime' => 60 * 60 * 1,
        // Session data will be stored on server maximum for 30 days.
        'gc_maxlifetime' => 60 * 60 * 24 * 30,
    ],
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Inicio',
                'route' => 'home',
            ],
            [
                'label' => 'Dashboard',
                'route' => 'dashboard'
            ],
        ],
        'dashboard' => [
            [
                'label' => 'Ing. Des. en la Web',
                'route' => 'dashboard/album',
                'pages' => [
                    [
                        'label' => 'Practica 1',
                        'route' => 'dashboard/album',
                        'pages' => [
                            [
                                'label' => 'Info. Practica 1',
                                'route' => 'dashboard/album',
                                'action' => 'info'
                            ],
                            [
                                'label' => 'Lista de albumes',
                                'route' => 'dashboard/album',
                                'action' => 'index'
                            ],
                            [
                                'label' => 'Agregar album',
                                'route' => 'dashboard/album',
                                'action' => 'add'
                            ]
                        ]
                    ],
                ]
            ],
        ]
    ]
];
