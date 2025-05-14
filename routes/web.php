<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'loginPost')->name('login.post');
        Route::get('logout', 'logout')->name('logout');
        Route::get('dashboard', 'dashboard')->name('dashboard');
        Route::get('our-team', 'ourTeam')->name('ourTeam');
        Route::get('our-team/manage/{id?}', 'manageTeamMember')->name('our-team.manage');
        Route::post('our-team/manage/post', 'manageTeamMemberPost')->name('our-team.manage.post');
    });

    Route::controller(ServicesController::class)->group(function () {
        Route::get('services/{id?}', 'index')->name('services');
        Route::post('services/post', 'post')->name('services.post');
        Route::get('services/delete/{id}', 'delete')->name('services.delete');
        Route::get('/services/status/{id}/{status}', 'status')->name('services.status');
    });
});
