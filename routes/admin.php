<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\CategoryController;


Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function(){
    Route::redirect('','admin/dashboard');
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
    Route::resource('Category',CategoryController::class);
    Route::resource('skills',SkillController::class);
});


//
