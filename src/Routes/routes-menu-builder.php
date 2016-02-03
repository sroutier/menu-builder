<?php
/**
 * This file is part of the Laravel package: Menu-Builder,
 * a menu and breadcrumb trails management solution for Laravel.
 *
 * @license GPLv3
 * @author Sebastien Routier (sroutier@gmail.com)
 * @package Sroutier\MenuBuilder
 */

// Site ADMIN section
Route::group(['prefix' => 'admin'], function () {

    Route::get(  'menus',                         ['as' => 'admin.menus.index',          'uses' => '\Sroutier\MenuBuilder\Controllers\MenusController@index']);
    Route::post( 'menus',                         ['as' => 'admin.menus.save',           'uses' => '\Sroutier\MenuBuilder\Controllers\MenusController@save']);
    Route::get(  'menus/getData/{menuId}',        ['as' => 'admin.menus.get-data',       'uses' => '\Sroutier\MenuBuilder\Controllers\MenusController@getData']);
    Route::get(  'menus/{menuId}/confirm-delete', ['as' => 'admin.menus.confirm-delete', 'uses' => '\Sroutier\MenuBuilder\Controllers\MenusController@getModalDelete']);
    Route::get(  'menus/{menuId}/delete',         ['as' => 'admin.menus.delete',         'uses' => '\Sroutier\MenuBuilder\Controllers\MenusController@destroy']);

}); // End of ADMIN group


// Menu-Builder DEMO section
Route::group(['prefix' => 'menu-builder-demo'], function () {

    Route::get( 'home', ['as' => 'menu-builder-demo.home', 'uses' => '\Sroutier\MenuBuilder\Controllers\MenusDemoController@demo']);
    Route::get( 'one',  ['as' => 'menu-builder-demo.one',  'uses' => '\Sroutier\MenuBuilder\Controllers\MenusDemoController@demo']);
    Route::get( 'two',  ['as' => 'menu-builder-demo.two',  'uses' => '\Sroutier\MenuBuilder\Controllers\MenusDemoController@demo']);

}); // End of DEMO section