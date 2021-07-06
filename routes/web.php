<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


Route::view('/', 'layouts.app')->name('home');

Route::resource('forms', FormController::class)->except('show');
