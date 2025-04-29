<?php
use App\Http\Controllers\ScoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ScoreController::class, 'index'])->name('score.index');

Route::post('/add-score/{player}', [ScoreController::class, 'addScore'])->name('score.add');

Route::post('/reset', [ScoreController::class, 'reset'])->name('score.reset');

Route::post('/toggle-set', [ScoreController::class, 'toggleSet'])->name('score.toggle');
