<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/properties', [HomeController::class, 'properties'])->name('properties');
Route::get('/aboutUs', [HomeController::class, 'aboutUs'])->name('aboutUs');

// Become Owner
Route::get('/becomeOwner', [OwnerController::class, 'becomeOwner'])->name('becomeOwner');
Route::post('/becomeOwnerPost/{userId}', [OwnerController::class, 'becomeOwnerPost'])->name('becomeOwnerPost');
//Owner

Route::get('/Owner/showMyPostedProperties/{ownerId}', [OwnerController::class, 'showMyPostedProperties'])->name('showMyPostedProperties');
Route::get('/Owner/postProperty', [OwnerController::class, 'showPropertyForm'])->name('showPropertyForm');
Route::post('/Owner/postProperty', [OwnerController::class, 'postProperty'])->name('postProperty');

Route::get('/Owner/deleteProperty/{propertyId}', [OwnerController::class, 'deleteProperty'])->name('deleteProperty');
Route::get('/Owner/modifyProperty/{propertyId}', [OwnerController::class, 'modifyProperty'])->name('modifyProperty');
Route::post('/Owner/modifyPropertyPost/{propertyId}', [OwnerController::class, 'modifyPropertyPost'])->name('modifyPropertyPost');


// User
Route::get('/user/filter', [UserController::class, 'filter'])->name('filter');
Route::get('/user/propertyInfo/{propertyId}', [UserController::class, 'propertyInfo'])->name('propertyInfo');
Route::get('/user/property/like/{propertyId}', [UserController::class, 'like'])->name('like');
Route::get('/user/property/bookMark/{propertyId}', [UserController::class, 'bookMark'])->name('bookMark');
Route::get('/user/property/showBookMark', [UserController::class, 'showBookMark'])->name('showBookMark');


Route::get('api/users', [\App\Http\Controllers\UserController::class, 'index']);
// ==========


Route::group(['middleware' => 'auth'], function () {



    Route::group(['middleware' => ['isAdmin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // categories
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::post('categories/images', [\App\Http\Controllers\Admin\CategoryController::class, 'storeImage'])->name('categories.storeImage');

        // tags
        Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);

        // products
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::post('products/images', [\App\Http\Controllers\Admin\ProductController::class, 'storeImage'])->name('products.storeImage');
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
