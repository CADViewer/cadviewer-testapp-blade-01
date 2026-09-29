<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/cadviewer');
Route::view('/cadviewer', 'cadviewer');
Route::view('/fixed-admin-header-test', 'fixed-admin-header-test');
