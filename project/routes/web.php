<?php

//Route::get('change-language/{language}', 'Web\LocalisationController@index')->name('change-language');
$localisationToggleService = new \App\Services\LocalisationService\LocalisationToggleService();

$language = $localisationToggleService->getLanguageSegment();
if (!$localisationToggleService->isLanguage($language)) {
    $language = null;
}

Route::middleware(['localisation'])->namespace('Web')->prefix($language)->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
});

Route::middleware(['auth', 'admin'])->namespace('Admin')->prefix('admin')->group(function () {

    /* Dashboard */
    Route::get('/', 'Controller@index')->name('admin');
    Route::get('dashboard', 'DashboardController@index')->name('admin-dashboard');


    /* Languages */
    Route::get('languages', 'LanguagesController@index')->name('admin-languages');
    Route::match(['post', 'get'], 'languages/create', 'LanguagesController@create')->name('admin-languages-create');
    Route::match(['post', 'get'], 'languages/{id}/update', 'LanguagesController@update')->name('admin-languages-update');
    Route::get('languages/{id}', 'LanguagesController@delete')->name('admin-languages-delete');


    /* Projects */
    Route::get('projects', 'ProjectsController@index')->name('admin-projects');
    Route::match(['get', 'post'], 'projects/create', 'ProjectsController@create')->name('admin-projects-create');
    Route::match(['get', 'post'], 'projects/{id}/update', 'ProjectsController@update')->name('admin-projects-update');
    Route::get('projects/{id}', 'ProjectsController@delete')->name('admin-projects-delete');


    /* Projects screenshots */
    Route::post('projects-screenshot/{projectId}/screenshot/{id}/delete', 'ProjectsScreenshotsController@delete')->name('admin-projects-screenshots-delete');


    /* Tags */
    Route::get('tags', 'TagsController@index')->name('admin-tags');
    Route::match(['get', 'post'], 'tags/create', 'TagsController@create')->name('admin-tags-create');
    Route::match(['get', 'post'], 'tags/{id}/update', 'TagsController@update')->name('admin-tags-update');
    Route::get('tags/{id}', 'TagsController@delete')->name('admin-tags-delete');


    /* Users */
    Route::get('users', 'UsersController@index')->name('admin-users');
    Route::match(['get', 'post'],'users/create', 'UsersController@create')->name('admin-users-create');
    Route::match(['get', 'post'], 'users/{id}/update', 'UsersController@update')->name('admin-users-update');
    Route::get('users/{id}/delete', 'UsersController@delete')->name('admin-users-delete');


    /* Settings */
    Route::get('settings', 'SettingsController@index')->name('admin-settings');
    Route::post('settings/update', 'SettingsController@update')->name('admin-settings-update');


    /* System */
    Route::post('toggle-model-status', 'SystemController@toggleEnable')->name('toggle-model-status');
});

Auth::routes();
