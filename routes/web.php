<?php

use App\Livewire\ManagerCategoryComponent;
use App\Livewire\ManagerUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/categorias', ManagerCategoryComponent::class)->name('manager-category');
    Route::get('/manager-user', ManagerUser::class)->name('manager-user');
});
