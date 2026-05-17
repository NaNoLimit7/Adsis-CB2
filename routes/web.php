<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return redirect('/mahasiswa');
});

Route::resource('mahasiswa', MahasiswaController::class);