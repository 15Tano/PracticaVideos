<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $users = App\Models\User::get();

    return view('welcome', ['users' => $users]);
});
