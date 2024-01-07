<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\LateController;
use App\Http\Controllers\AuthController;

Route::middleware('IsGuest')->group(function(){
    Route::get('/',function(){
        return view('login');
    })->name('login');
        Route::post('/login-auth', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware('IsLogin')->group(function() {

    Route::get('/dashboard', function () {
        
        return view('home.index');
    });

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware('IsAdmin')->group(function () {
Route::prefix('/admin')->name('admin.user.')->group(function() {
    Route::get('/', [LateController::class, 'index'])->name('index');
    Route::get('/create', [LateController::class, 'create'])->name('create');
    Route::post('/store', [LateController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [LateController::class, 'destroy'])->name('delete'); 
    Route::get('/search', [LateController::class, 'data'])->name('search');
    Route::get('/edit/{id}', [LateController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [LateController::class, 'update'])->name('update');
    Route::get('/rekap', [LateController::class, 'rekap'])->name('rekap');
    Route::get('/show/{id}', [LateController::class, 'show'])->name('show');
    Route::get('/excel', [LateController::class, 'ExportExcel'])->name('excel');
    Route::get('/download/{id}', [LateController::class, 'downloadPDF'])->name('download');
});

Route::prefix('/student')->name('admin.student.')->group(function() {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('delete'); 
    Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [StudentController::class, 'update'])->name('update');
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
});

Route::prefix('/rayon')->name('rayon.')->group(function() {
    Route::get('/dashboard', [RayonController::class, 'index'])->name('index');
    Route::get('/create', [RayonController::class, 'create'])->name('create');
    Route::post('/store', [RayonController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [RayonController::class, 'destroy'])->name('delete'); 
    Route::get('/edit/{id}', [RayonController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [RayonController::class, 'update'])->name('update');
});

Route::prefix('/rombel')->name('rombel.')->group(function() {
    Route::get('/data', [RombelController::class, 'index'])->name('index');
    Route::get('/create', [RombelController::class, 'create'])->name('create');
    Route::post('/store', [RombelController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [RombelController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [RombelController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [RombelController::class, 'destroy'])->name('delete');  
    Route::get('/search', [RombelController::class, 'data'])->name('search');
});

Route::prefix('/user1')->name('user1.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete'); 
    Route::get('/search', [UserController::class, 'data'])->name('search'); 
});
});

Route::middleware(['IsPs'])->group(function () {
    Route::prefix('/student')->name('ps.student.')->group(function() {
        Route::get('/data/{id}', [StudentController::class, 'data'])->name('data');
    });
    Route::prefix('/user')->name('ps.user.')->group(function() {
        Route::get('/data', [LateController::class, 'data'])->name('data');
        Route::get('/search1', [LateController::class, 'search'])->name('search');
        Route::get('/excel1', [LateController::class, 'ExportExcel'])->name('excel');
        Route::get('/rekap1', [LateController::class, 'rekap1'])->name('rekap1');
        Route::get('/show1/{id}', [LateController::class, 'show1'])->name('show1');
        Route::get('/download/{id}', [LateController::class, 'downloadPDF1'])->name('download');
        });
});
});