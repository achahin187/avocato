<?php

Route::group(['middleware' => 'web', 'prefix' => 'landing', 'namespace' => 'Modules\Landing\Http\Controllers'], function()
{
    Route::get('/landing', 'LandingController@index');
});
