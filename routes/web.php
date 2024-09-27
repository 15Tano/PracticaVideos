<?php

use App\Models\Level;
use Illuminate\Support\Facades\Route;
use App\Models\User; // Importa el modelo correcto


// Ruta para la página principal
Route::get('/', function () {
    $users = User::all(); // Usa all() para obtener todos los registros
    
    return view('welcome', ['users' => $users]);
});

// Ruta para el perfil de usuario
Route::get('/profile/{id}',function($id){

    // Encuentra el usuario por ID
    $user = User::find($id);

    // Obtiene los posts del usuario y cuenta los comentarios asociados
    $posts = $user->posts()->with('category','image','tags')
    ->withCount('comments')->get();
    

    // Obtiene los videos del usuario y cuenta los comentarios asociados
    $videos = $user->videos()->with('category','image','tags')
    ->withCount('comments')->get();

    // Devuelve la vista 'profile' con los datos
    return view('profile',[
        'user' => $user, // Faltaba una coma aquí
        'posts' => $posts,
        'videos' => $videos
    ]);

})->name('profile');

Route::get('/level/{id}',function($id){

    // Encuentra el usuario por ID
    $level = Level::find($id);

    // Obtiene los posts del usuario y cuenta los comentarios asociados
    $posts = $level->posts()->with('category','image','tags')
    ->withCount('comments')->get();
    

    // Obtiene los videos del usuario y cuenta los comentarios asociados
    $videos = $level->videos()->with('category','image','tags')
    ->withCount('comments')->get();

    // Devuelve la vista 'profile' con los datos
    return view('level',[
        'level' => $level,
        'posts' => $posts,
        'videos' => $videos
    ]);

})->name('level');