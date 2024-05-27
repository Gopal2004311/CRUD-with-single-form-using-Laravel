<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::controller(DataController::class)->group(function () {

    Route::get('/', 'getAll')->name("home");

    Route::get('/getLast', 'getLast')->name("LastEntry");

    Route::post('/insert/student', 'insert')->name('Insert');

    Route::put('/update/student/{id}', 'update')->name('Update');

    Route::get('/delete/student/{id}', 'delete')->name('Delete');

    Route::get('/getSingle/{id}', 'getSingle')->name('Individual');
});
