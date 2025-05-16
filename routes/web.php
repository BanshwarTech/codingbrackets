<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServicesContentController;
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
        Route::get('our-team/delete/{id}', 'deleteTeamMember')->name('our-team.delete');
        Route::get('our-team/status/{id}', 'statusTeamMember')->name('our-team.status');
    });

    Route::controller(ServicesController::class)->group(function () {
        Route::get('services/{id?}', 'index')->name('services');
        Route::post('services/post', 'post')->name('services.post');
        Route::get('services/delete/{id}', 'delete')->name('services.delete');
        Route::get('/services/status/{id}/{status}', 'status')->name('services.status');
    });

    Route::controller(ServicesContentController::class)->group(function () {
        Route::get('services-content', 'manage')->name('services.content');
        Route::get('services-content/manage/{id?}', 'manageContent')->name('services.content.manage');
        Route::post('services-content/manage/post', 'manageContentPost')->name('services.content.manage.post');
        Route::get('services-content/delete/{id}', 'deleteContent')->name('services.content.delete');
        Route::get('services-content/status/{id}', 'statusContent')->name('services.content.status');
    });
});
