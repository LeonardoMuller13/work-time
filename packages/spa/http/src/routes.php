<?php

use Illuminate\Support\Facades\Route;

Route::group([
	'middleware' => 'web',
	'namespace' => 'Spa\Http\Controllers'
], function () {
    Route::group(['prefix' => '/'], function () {
		Route::get('/', 'SpaController@index');
		Route::get('/{any}', 'SpaController@index')->where('any', '.*');
	});
});