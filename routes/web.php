<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GroupController;


Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


Route::group(['middleware' => 'auth'], function () {

    Route::get('password-edit', [LoginController::class, 'editPasswordForm'])->name('password.edit');
    Route::post('password-edit', [LoginController::class, 'updatePassword']);

    Route::view('/', 'home')->name('home');

    Route::resource('forms.groups', GroupController::class);
    Route::resource('forms', FormController::class)->except('show');
});

