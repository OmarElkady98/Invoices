<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Models\invoices;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
// Auth::routes(['register'=>false]);

Route::group(['middleware' => 'auth'] , function() {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/index', [AdminController::class , 'index'])->name('index');



    ///////////////////////////////////Start Invoices Route/////////////////////////////////////

    Route::group(['prefix' => 'invoices'] , function() {
        Route::get('/' , [InvoicesController::class , 'index'])->name('invoices.index') ;
    }) ;

    ///////////////////////////////////End Invoices Route/////////////////////////////////////


    ///////////////////////////////////Start Section Route/////////////////////////////////////

    Route::group(['prefix' => 'section'] , function()   {
        Route::get('/' , [SectionController::class , 'index'])->name('section.index') ;
        Route::post('/store' , [SectionController::class , 'store'])->name('section.store') ;
        Route::post('/update' , [SectionController::class , 'update'])->name('section.update') ;
        Route::post('/delete' , [SectionController::class , 'destroy'])->name('section.delete') ;
    }) ;

    ///////////////////////////////////End Section Route/////////////////////////////////////


    ///////////////////////////////////Start Product Route/////////////////////////////////////

    Route::group(['prefix' => 'product'] , function()   {
        Route::get('/' , [ProductController::class , 'index'])->name('product.index') ;
        Route::post('/store' , [ProductController::class , 'store'])->name('product.store') ;
        Route::post('/update' , [ProductController::class , 'update'])->name('product.update') ;
        Route::post('/delete' , [ProductController::class , 'destroy'])->name('product.delete') ;
    }) ;

    ///////////////////////////////////End Product Route/////////////////////////////////////
}) ;
