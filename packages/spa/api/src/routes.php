<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['web', 'api'],
    'namespace' => 'Spa\Api\Controllers',
    'prefix' => 'api',
], function () {
    Route::group(['prefix' => 'worktime'], function () {
        Route::post('/hours', 'WorktimeController@postHours');
    });
});