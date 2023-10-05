<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\ProjectController;
use App\Http\Controllers\Company\PaymentController;

Route::prefix('company')->middleware('auth:company')->name('company.')->group(function () {
    Route::redirect('/', 'company/dashboard');
    Route::get('dashboard', [CompanyController::class, 'dashboard'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::get('projects/edit_status/{id?}', [ProjectController::class, 'edit_status'])->name('projects.edit_status');

    Route::get('projects/{project}/pay',[PaymentController::class ,'pay'])->name('projects.pay');
    Route::get('projects/{project}/payment',[PaymentController::class ,'payment'])->name('projects.payment');
});
//
