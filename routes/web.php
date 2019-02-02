<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * cache control
 */
Route::get('clear-views', 'Admin\CacheController@clear_views')
      ->name('clear-views');
Route::get('clear-cache', 'Admin\CacheController@clear_cache')
      ->name('clear-cache');


Route::get('/', 'IndexController@index')->name('home');

Route::any('/admin/login', 'Auth\AuthController@login')->name('login');

Route::any('/admin/logout', 'Auth\AuthController@logout')->name('logout');

Route::get('/admin/reset', 'Auth\AuthController@showReset')->name('password.request');

Route::get('locale', function () {
    return \App::getLocale();
});

Route::get('locale/{locale}', function ($locale) {
    session(['locale' => $locale]);
});

Route::prefix('admin')->group(function () {
    Route::get('/', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\AdminController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.index'
    ]);

    Route::get('/layouts', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\LayoutsController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.layouts'
    ]);

    Route::any('/layouts/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\LayoutsController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.layouts.new'
    ]);

    Route::any('/layouts/edit/{layout}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\LayoutsController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.layouts.edit'
    ]);

    Route::get('/categories', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\CategorieController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.categories'
    ]);

    Route::any('/categories/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\CategorieController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.categories.new'
    ]);

    Route::any('/categories/edit/{categorie}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\CategorieController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.categories.edit'
    ]);

    Route::get('/entities', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entities'
    ]);

    Route::any('/entities/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entities.new'
    ]);

    Route::any('/entities/edit/{entity}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entities.edit'
    ]);

    Route::get('/entitystates', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityStateController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entitystates'
    ]);

    Route::any('/entitystates/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityStateController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entitystates.new'
    ]);

    Route::any('/entitystates/edit/{entitystate}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityStateController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entitystates.edit'
    ]);

    Route::get('/sections', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\SectionsController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.sections'
    ]);

    Route::any('/sections/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\SectionsController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.sections.new'
    ]);

    Route::any('/sections/edit/{section}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\SectionsController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.sections.edit'
    ]);

    Route::any('/sections/delete/{section}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\SectionsController@delete',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.sections.delete'
    ]);

    Route::any('/sections/elements/edit/{section}/', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\SectionsController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.sections.elements.edit'
    ]);


    Route::any('/sections/properties/edit/{section}/', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\SectionsController@editProperties',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.sections.properties.edit'
    ]);

    Route::get('/translations', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\TranslationsController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.translations'
    ]);


    Route::get('/types', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\TypeController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.types'
    ]);

    Route::any('/types/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\TypeController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.types.new'
    ]);

    Route::any('/types/edit/{type}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\TypeController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.types.edit'
    ]);

    Route::get('/properties', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\PropertiesController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.properties'
    ]);



    Route::get('/locales', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\LocalesController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.locales'
    ]);

    Route::get('/locales/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\LocalesController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.locales.new'
    ]);

    Route::get('/locales/edit/{locale}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\LocalesController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.locales.edit'
    ]);

    Route::get('/products', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\ProductsController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.products'
    ]);

    Route::get('/events', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EventsController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.events'
    ]);

    Route::get('/states', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\StatesController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.states'
    ]);

    Route::get('/states/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\StatesController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.states.new'
    ]);

    Route::any('/states/edit/{state}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\StatesController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.states.edit'
    ]);

    Route::get('/entitytypes', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityTypeController@index',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entitytypes'
    ]);

    Route::any('/entitytypes/new', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityTypeController@new',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entitytypes.new'
    ]);

    Route::any('/entitytypes/edit/{entitytype}', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\EntityTypeController@edit',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.entitytypes.edit'
    ]);

    // Route::any('/elements', [
    //     'middleware'    => ['auth'],
    //     'uses'          => 'Admin\ElementsController@index',
    //     'roles'         => ['admin', 'manager'],
    //     'as'            => 'admin.elements'
    // ]);

    // Route::any('/elements/new', [
    //     'middleware'    => ['auth'],
    //     'uses'          => 'Admin\ElementsController@new',
    //     'roles'         => ['admin', 'manager'],
    //     'as'            => 'admin.elements.new'
    // ]);

    // Route::any('/elements/edit/{element}', [
    //     'middleware'    => ['auth'],
    //     'uses'          => 'Admin\ElementsController@edit',
    //     'roles'         => ['admin', 'manager'],
    //     'as'            => 'admin.elements.edit'
    // ]);

    // Route::any('/elements/delete/{element}', [
    //     'middleware'    => ['auth'],
    //     'uses'          => 'Admin\ElementsController@delete',
    //     'roles'         => ['admin', 'manager'],
    //     'as'            => 'admin.elements.delete'
    // ]);

    // Route::any('/elements/properties/edit/{element}/', [
    //     'middleware'    => ['auth'],
    //     'uses'          => 'Admin\ElementsController@editProperties',
    //     'roles'         => ['admin', 'manager'],
    //     'as'            => 'admin.elements.properties.edit'
    // ]);

    Route::post('/structure/show', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\StructureController@show',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.type.ajax'
    ]);

    Route::any('/structure/preview', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\StructureController@preview',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.type.preview.ajax'
    ]);

    Route::any('/structure/properties', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\StructureController@getproperties',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.type.properties.ajax'
    ]);

    Route::any('/structure/properties/update', [
        'middleware'    => ['auth'],
        'uses'          => 'Admin\StructureController@updateproperties',
        'roles'         => ['admin', 'manager'],
        'as'            => 'admin.type.properties.update.ajax'
    ]);
});

// Route::get('/', function () {
//     return view('home');
// });

// Auth::routes();
