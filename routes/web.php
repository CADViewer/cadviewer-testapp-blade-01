<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/cadviewer', function () { return view('cadviewer'); }); 
Route::get('/fixed-admin-header-test', function () { return view('fixed-admin-header-test'); }); 
