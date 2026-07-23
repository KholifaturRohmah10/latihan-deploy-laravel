<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    try {
        $users = DB::table('users')->get();
        $error = null;
    } catch (\Exception $e) {
        $users = collect();
        $error = "Gagal terhubung ke database: " . $e->getMessage();
    }
    
    return view('welcome', compact('users', 'error'));
});
