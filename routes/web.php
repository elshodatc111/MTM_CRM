<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\hodim\HodimeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vacancy\VacancyController;
use App\Http\Controllers\vacancy\VacancyChildController;
use App\Http\Controllers\Days\DaysController;
use App\Http\Controllers\Group\GroupController;
use App\Http\Controllers\Child\ChildController;

Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/meneger', [HodimeController::class, 'meneger'])->name('meneger');
    Route::post('/hodim/create', [HodimeController::class, 'store_create'])->name('hodim_create');
    Route::get('/tarbiyachi', [HodimeController::class, 'tarbiyachi'])->name('tarbiyachi');
    Route::get('/oqituvchi', [HodimeController::class, 'oqituvchi'])->name('oqituvchi');
    Route::get('/oshpaz', [HodimeController::class, 'oshpaz'])->name('oshpaz');
    Route::get('/hodimlar', [HodimeController::class, 'hodimlar'])->name('hodimlar');

    Route::get('/vacancy/hodim', [VacancyController::class, 'index'])->name('vacancy_hodim');
    Route::get('/vacancy/hodim/{id}', [VacancyController::class, 'show'])->name('vacancy_hodim_show');
    Route::post('/vacancy/hodim/create', [VacancyController::class, 'store'])->name('vacancy_hodim_create');
    Route::post('/vacancy/hodim/comment', [VacancyController::class, 'comment'])->name('vacancy_hodim_comment');
    Route::post('/vacancy/hodim/cancel', [VacancyController::class, 'cancel'])->name('vacancy_hodim_cancel');
    Route::post('/vacancy/hodim/success', [VacancyController::class, 'success'])->name('vacancy_hodim_success');
    
    Route::get('/vacancy/child', [VacancyChildController::class, 'index'])->name('vacancy_child');
    Route::get('/vacancy/child/{id}', [VacancyChildController::class, 'show'])->name('vacancy_child_show');
    Route::post('/vacancy/child/create', [VacancyChildController::class, 'store'])->name('vacancy_child_create');
    Route::post('/vacancy/child/comment/create', [VacancyChildController::class, 'CommentStore'])->name('vacancy_child_comment_create');
    Route::post('/vacancy/child/cancel', [VacancyChildController::class, 'CancelStore'])->name('vacancy_child_cancel_create');
    Route::post('/vacancy/child/success', [VacancyChildController::class, 'SuccessStory'])->name('vacancy_child_success_create');
    
    Route::get('/days', [DaysController::class, 'index'])->name('days');
    Route::post('/days/create/shanba', [DaysController::class, 'createShanba'])->name('createShanba');
    Route::post('/days/create/yakshanba', [DaysController::class, 'createYakshanba'])->name('createYakshanba');
    Route::post('/days/create/dam', [DaysController::class, 'crateDamKuni'])->name('crateDamKuni');
    Route::post('/days/delete-archive', [DaysController::class, 'deleteArchive'])->name('days.delete.archive');
    Route::post('/days/delete', [DaysController::class, 'destroy'])->name('days.destroy');

    Route::get('/groups', [GroupController::class, 'index'])->name('groups');
    Route::get('/groups/{id}', [GroupController::class, 'show'])->name('groups_show');
    Route::post('/groups/create', [GroupController::class, 'store'])->name('groups_create');
    Route::post('/groups/update', [GroupController::class, 'updateGroups'])->name('groups_update');
    Route::post('/groups/add/attach', [GroupController::class, 'attachTeacher'])->name('groups_add_attach');
    Route::post('/groups/update/attach', [GroupController::class, 'updateTecherGroup'])->name('groups_update_attach');
    Route::post('/groups/update/attachMin', [GroupController::class, 'updateTecherMinGroup'])->name('groups_update_min_attach');
    Route::post('/groups/create/comment', [GroupController::class, 'storeComment'])->name('groups_create_comment');

    Route::get('/child', [ChildController::class, 'index'])->name('child');
    Route::get('/nochild', [ChildController::class, 'noindex'])->name('nochild');
    Route::get('/childs/{id}', [ChildController::class, 'show'])->name('child_show');
    Route::get('/childsno/{id}', [ChildController::class, 'noshow'])->name('child_show_no');

});

require __DIR__.'/auth.php';
