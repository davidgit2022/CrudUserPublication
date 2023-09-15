<?php

use App\Http\Controllers\PublicationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(PublicationController::class)->group(function(){
    
    Route::get('/publications', 'index')->name('publications.index');

    Route::post('/publications', 'store')->name('publications.store');

    Route::get('/publications/{id}', 'show')->name('publications.show');

    Route::get('/publications/edit/{id}', 'edit')->name('publications.edit');

    Route::post('/publications/update/{id}', 'update')->name('publications.update');

    Route::delete('/publications/delete/{id}', 'destroy')->name('publications.delete');
});


