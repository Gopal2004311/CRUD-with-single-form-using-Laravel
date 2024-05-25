<?php

use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name("home");
Route::controller(DataController::class)->group(function () {
    Route::get('/getLast', 'getLast')->name("LastEntry");

    Route::post('/insert/student', 'insert')->name('Insert');

    Route::put('/update/student/{id}', 'update')->name('Update');

    Route::get('/delete/student/{id}', 'delete')->name('Delete');

    Route::get('/getSingle/{id}', 'getSingle')->name('Individual');
});
