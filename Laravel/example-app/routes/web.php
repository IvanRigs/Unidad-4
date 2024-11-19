<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/operacion/{tipo}/{x}/{x1}', function ($tipo, $x, $x1) {

    $result = 0;

    if ($tipo == 'suma') {
        $result = $x + $x1;
    } elseif ($tipo == 'resta') {
        $result = $x - $x1;
    } elseif ($tipo == 'division') {
        $result = $x / $x1;
    } elseif ($tipo == 'multiplicacion') {
        $result = $x * $x1;
    }

    return ('Hello ' . $result);
}) -> where(['x' => '[0-9]+', 'x1' => '[0-9]+']);

Route::get('/saludo/{nombre}/{apellido}', function ($nombre, $apellido) {
    return ('Hola '. $nombre .' '. $apellido);
});

Route::get('/saludo/{nombre}/{apellido}', function ($nombre) {
    return view('Hola '. $nombre);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
