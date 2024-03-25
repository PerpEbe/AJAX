<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/category/index', [CategoryController::class,'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class,'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class,'store'])->name('category.store');
Route::get('/fetch-category', [CategoryController::class,'fetch'])->name('category.fetch');

Route::post('/ajaxupload',[HomeController::class,'upload'])->name('ajaxupload');