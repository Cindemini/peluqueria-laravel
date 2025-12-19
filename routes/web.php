<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;

Route::get('/', function () {
    return redirect()->route('citas.index');
});

Route::resource('citas', CitaController::class)->except(['destroy']);
Route::delete('citas/{cita}', [CitaController::class, 'destroy'])->name('citas.destroy');

Route::get('/citas/hoy', [CitaController::class, 'citasHoy'])->name('citas.hoy');
Route::get('/citas/historial', [CitaController::class, 'historial'])->name('citas.historial');
Route::post('/citas/{id}/estado', [CitaController::class, 'cambiarEstado'])->name('citas.estado');
Route::get('/citas/buscar', [CitaController::class, 'buscar'])->name('citas.buscar');