<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceOfferController;
use App\Http\Controllers\Admin\ServicesContentController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\WebsiteController;
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

    Route::controller(WebsiteController::class)->group(function () {
        Route::get('website/{id?}', 'index')->name('website');
        Route::post('website/post', 'post')->name('website.post');
        Route::get('website/delete/{id}', 'delete')->name('website.delete');
        Route::get('website/status/{id}', 'status')->name('website.status');
    });

    Route::controller(TechnologyController::class)->group(function () {
        Route::get('technology/{id?}', 'index')->name('technology');
        Route::post('technology/post', 'post')->name('technology.post');
        Route::get('technology/delete/{id}', 'delete')->name('technology.delete');
        Route::get('technology/status/{id}', 'status')->name('technology.status');
    });

    Route::controller(ServiceOfferController::class)->group(function () {
        Route::get('service-offer/{id?}', 'index')->name('service.offer');
        Route::post('service-offer/post', 'post')->name('service.offer.post');
        Route::get('service-offer/delete/{id}', 'delete')->name('service.offer.delete');
        Route::get('service-offer/status/{id}', 'status')->name('service.offer.status');
    });
});
