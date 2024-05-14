<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorApi;


Route::get('/', function () {
    return view('index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/apiActor/{date}', [ActorApi::class, 'fetchActorsByBirthday'])->name('apiActor');
Route::get('locale/{lang}', [LocaleController::class, 'setLocale'])->name('languageConverter');
Route::post('/addUser', [UserController::class, 'store'])->name('add');

Route::get('/send', [MailController::class, 'sendEmail']);


