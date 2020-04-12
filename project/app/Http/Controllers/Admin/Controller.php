<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BootController;
use App\Services\ResponseManager\ResponseTrait;
use Illuminate\Support\Facades\Route;

class Controller extends BootController
{
    use ResponseTrait;

    const NOTIFY_CREATED = ['created', 'Модель создана'];
    const NOTIFY_UPDATED = ['updated', 'Модель обновлена'];
    const NOTIFY_DELETED = ['deleted', 'Модель удалена'];

    const NOTIFY_ERROR_CREATED = ['create_error', 'Модель не создана'];
    const NOTIFY_ERROR_UPDATED = ['update_error', 'Модель не обновлена'];
    const NOTIFY_ERROR_DELETED = ['delete_error', 'Модель не удалена'];
    const NOTIFY_NOT_FOUND = ['not_found', 'Модель не найдена'];

    public function __construct()
    {
        $this->middleware(function ($request, \Closure $next) {
            \View::share('adminMainMenu', [
                'admin-dashboard' => [
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
                        'admin-projects' => [
                            'type' => 'route',
                            'title' => 'Проекты',
                            'route' => route('admin-projects'),
                            'blank' => false
                        ],
                        'admin-tags' => [
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
                        'admin-languages' => [
                            'type' => 'route',
                            'title' => 'Локализация',
                            'route' => route('admin-languages'),
                            'blank' => false
                        ],
                        'admin-users' => [
                            'type' => 'route',
                            'title' => 'Пользователи',
                            'route' => route('admin-users'),
                            'blank' => false
                        ],
                        'admin-settings' => [
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

            \View::share('currentRouteName', Route::currentRouteName());

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
