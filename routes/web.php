<?php

use App\Http\Controllers\Admin\AdminController;
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
});
