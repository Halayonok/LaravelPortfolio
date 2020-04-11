<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BootController;

class Controller extends BootController
{
    public function __construct()
    {
        $this->middleware(function ($request, \Closure $next) {
            \View::share('adminMainMenu', [
                'dashboard' => [
                    'type' => 'route',
                    'title' => 'Главная',
                    'icon' => 'fas fa-fw fa-tachometer-alt',
                    'route' => route('admin-dashboard'),
                    'blank' => false
                ],

                'portfolio' => [
                    'type' => 'group',
                    'title' => 'Портфолио',
                    'icon' => 'fas fa-code',

                    'routes' => [
                        'projects' => [
                            'type' => 'route',
                            'title' => 'Проекты',
                            'route' => route('admin-projects'),
                            'blank' => false
                        ],
                        'tags' => [
                            'type' => 'route',
                            'title' => 'Теги',
                            'route' => route('admin-tags'),
                            'blank' => false
                        ],
                    ]
                ],

                'system' => [
                    'type' => 'group',
                    'title' => 'Система',
                    'icon' => 'fas fa-fw fa-cog',

                    'routes' => [
                        'languages' => [
                            'type' => 'route',
                            'title' => 'Локализация',
                            'route' => route('admin-languages'),
                            'blank' => false
                        ],
                        'users' => [
                            'type' => 'route',
                            'title' => 'Пользователи',
                            'route' => route('admin-users'),
                            'blank' => false
                        ],
                        'settings' => [
                            'type' => 'route',
                            'title' => 'Настройки',
                            'route' => route('admin-settings'),
                            'blank' => false
                        ],
                        'file-manager' => [
                            'type' => 'route',
                            'title' => 'Менеджер файлов',
                            'route' => '/file-manager/tinymce',
                            'blank' => true
                        ]
                    ]

                ]
            ]);

            /*foreach (Settings::all() as $settingsParameter) {
                \View::share($settingsParameter->label, $settingsParameter->value);
            }*/

            return $next($request);
        });
    }

    public function index()
    {
        return redirect()->route('admin-dashboard');
    }
}
