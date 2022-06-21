<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

Route::controller(RestaurantController::class)->group(function () {
    Route::get('/restaurants', 'index');
    Route::get('/restaurants/list_state', 'list_state');
    Route::get('/restaurants/list_state/{state}', 'search_restaurants');
});
