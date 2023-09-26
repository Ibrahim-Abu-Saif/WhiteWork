<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\ProjectController;

Route::prefix('company')->name('company.')->group(function () {
    Route::redirect('/', 'company/dashboard');
    Route::get('dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::get('projects/edit_status/{id?}', [ProjectController::class, 'edit_status'])->name('projects.edit_status');
});
//
