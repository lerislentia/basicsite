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

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [
        'uses'          => 'Admin\AdminController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.index'
    ]);

    Route::get('/layouts', [
        'uses'          => 'Admin\LayoutsController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.layouts'
    ]);

    Route::any('/layouts/new', [
        'uses'          => 'Admin\LayoutsController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.layouts.new'
    ]);

    Route::any('/layouts/edit/{layout}', [
        'uses'          => 'Admin\LayoutsController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.layouts.edit'
    ]);

    Route::get('/categories', [
        'uses'          => 'Admin\CategorieController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.categories'
    ]);

    Route::any('/categories/new', [
        'uses'          => 'Admin\CategorieController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.categories.new'
    ]);

    Route::any('/categories/edit/{categorie}', [
        'uses'          => 'Admin\CategorieController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.categories.edit'
    ]);

    Route::get('/entities', [
        'uses'          => 'Admin\EntityController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.entities'
    ]);

    Route::any('/entities/new', [
        'uses'          => 'Admin\EntityController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.entities.new'
    ]);

    Route::any('/entities/edit/{entity}', [
        'uses'          => 'Admin\EntityController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.entities.edit'
    ]);

    Route::get('/entitystates', [
        'uses'          => 'Admin\EntityStateController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.entitystates'
    ]);

    Route::any('/entitystates/new', [
        'uses'          => 'Admin\EntityStateController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.entitystates.new'
    ]);

    Route::any('/entitystates/edit/{entitystate}', [
        'uses'          => 'Admin\EntityStateController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.entitystates.edit'
    ]);

    Route::get('/sections', [
        'uses'          => 'Admin\SectionsController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.sections'
    ]);

    Route::any('/sections/new', [
        'uses'          => 'Admin\SectionsController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.sections.new'
    ]);

    Route::any('/sections/child/new', [
        'uses'          => 'Admin\SectionsController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.sections.child.new'
    ]);

    Route::any('/sections/edit/{section}', [
        'uses'          => 'Admin\SectionsController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.sections.edit'
    ]);

    Route::any('/sections/delete/{section}', [
        'uses'          => 'Admin\SectionsController@delete',
        'roles'         => ['admin'],
        'as'            => 'admin.sections.delete'
    ]);

    Route::any('/sections/elements/edit/{section}/', [
        'uses'          => 'Admin\SectionsController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.sections.elements.edit'
    ]);


    Route::any('/sections/properties/edit/{section}/', [
        'uses'          => 'Admin\SectionsController@editProperties',
        'roles'         => ['admin'],
        'as'            => 'admin.sections.properties.edit'
    ]);

    Route::get('/translations', [
        'uses'          => 'Admin\TranslationsController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.translations'
    ]);


    Route::get('/types', [
        'uses'          => 'Admin\TypeController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.types'
    ]);

    Route::any('/types/new', [
        'uses'          => 'Admin\TypeController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.types.new'
    ]);

    Route::any('/types/edit/{type}', [
        'uses'          => 'Admin\TypeController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.types.edit'
    ]);

    Route::get('/properties', [
        'uses'          => 'Admin\PropertiesController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.properties'
    ]);



    Route::get('/locales', [
        'uses'          => 'Admin\LocalesController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.locales'
    ]);

    Route::get('/locales/new', [
        'uses'          => 'Admin\LocalesController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.locales.new'
    ]);

    Route::get('/locales/edit/{locale}', [
        'uses'          => 'Admin\LocalesController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.locales.edit'
    ]);

    Route::get('/products', [
        'uses'          => 'Admin\ProductsController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.products'
    ]);

    Route::get('/events', [
        'uses'          => 'Admin\EventsController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.events'
    ]);

    Route::get('/states', [
        'uses'          => 'Admin\StatesController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.states'
    ]);

    Route::get('/states/new', [
        'uses'          => 'Admin\StatesController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.states.new'
    ]);

    Route::any('/states/edit/{state}', [
        'uses'          => 'Admin\StatesController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.states.edit'
    ]);

    Route::get('/entitytypes', [
        'uses'          => 'Admin\EntityTypeController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.entitytypes'
    ]);

    Route::any('/entitytypes/new', [
        'uses'          => 'Admin\EntityTypeController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.entitytypes.new'
    ]);

    Route::any('/entitytypes/edit/{entitytype}', [
        'uses'          => 'Admin\EntityTypeController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.entitytypes.edit'
    ]);

    Route::post('/structure/show', [
        'uses'          => 'Admin\StructureController@show',
        'roles'         => ['admin'],
        'as'            => 'admin.type.ajax'
    ]);

    Route::any('/structure/preview', [
        'uses'          => 'Admin\StructureController@preview',
        'roles'         => ['admin'],
        'as'            => 'admin.type.preview.ajax'
    ]);

    Route::any('/structure/properties', [
        'uses'          => 'Admin\StructureController@getproperties',
        'roles'         => ['admin'],
        'as'            => 'admin.type.properties.ajax'
    ]);

    Route::any('/structure/properties/update', [
        'uses'          => 'Admin\StructureController@updateproperties',
        'roles'         => ['admin'],
        'as'            => 'admin.type.properties.update.ajax'
    ]);

    Route::get('/pages', [
        'uses'          => 'Admin\PageController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.pages'
    ]);

    Route::any('/pages/new', [
        'uses'          => 'Admin\PageController@new',
        'roles'         => ['admin'],
        'as'            => 'admin.pages.new'
    ]);

    Route::any('/pages/delete/{page}', [
        'uses'          => 'Admin\PageController@delete',
        'roles'         => ['admin'],
        'as'            => 'admin.pages.delete'
    ]);

    Route::any('/pages/edit/{page}', [
        'uses'          => 'Admin\PageController@edit',
        'roles'         => ['admin'],
        'as'            => 'admin.pages.edit'
    ]);

    Route::any('/pagesections', [
        'uses'          => 'Admin\PageSectionController@index',
        'roles'         => ['admin'],
        'as'            => 'admin.sectionpages'
    ]);



    Route::get('resizeImage', 'Admin\ImageController@resizeImage');

    Route::post('resizeImagePost',[
        'as'=>'resizeImagePost',
        'uses'=>'Admin\ImageController@resizeImagePost'
        ]
    );

});

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
//     Route::post('/laravel-filemanager/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
//     // list all lfm routes here...
// });

// Route::get('/', function () {
//     return view('home');
// });

// Auth::routes();
