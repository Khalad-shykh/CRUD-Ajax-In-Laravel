<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('AddProducts', [ProductsController::class, 'show']);
Route::post('AddProducts', [ProductsController::class, 'CreateProducts']);
Route::get('ViewProducts', [ProductsController::class, 'ViewProducts']);
Route::post('GetValues', [ProductsController::class, 'GetValues']);
Route::post('UpdateProducts', [ProductsController::class, 'UpdateProducts']);
Route::post('DeleteProducts', [ProductsController::class, 'DeleteProducts']);
Route::get('ImageUpload',[ImageController::class , 'show']);
Route::post('ImageUpload',[ImageController::class , 'Upload'])->name('store');
Route::get('ImageView', [ImageController::class , 'ImageView']);
Route::get('AddCategory',[CategoryController::class,'show']);
Route::post('AddCategory',[CategoryController::class,'AddCategory']);
Route::get('ViewCategories',[CategoryController::class,'ViewCategories']);
Route::get('DelCategories',[CategoryController::class,'DelCategories']);
Route::get('test', function(){
    return view('test');
});