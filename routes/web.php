<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\hodim\HodimeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vacancy\VacancyController;
use App\Http\Controllers\vacancy\VacancyChildController;

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

});

require __DIR__.'/auth.php';
