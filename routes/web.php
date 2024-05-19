<?php

use App\Livewire\ManagerCategoryComponent;
use App\Livewire\ManagerCourse;
use App\Livewire\ManagerUser;
use App\Livewire\ShoppingCart;
use App\Livewire\Welcome;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

Route::get('/',Welcome::class);

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
    Route::get('/manager-course', ManagerCourse::class)->name('manager-course');
    // routes/web.php

    Route::post('/cart/add/{course}', ManagerCourse::class)->name('cart.add');
    Route::get('/cart', ShoppingCart::class)->name('cart');
    Route::get('/courses/{course}', ManagerCourse::class)->name('courses.show');

});
