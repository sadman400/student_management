<?php

use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// get -> index
Route::get('/students', [StudentController::class, 'index']);
// post -> store
Route::post('/students', [StudentController::class, 'store']);
// post -> show
Route::get('/students/{id}', [StudentController::class, 'show']);
// post -> edit
Route::get('/students/{id}/edit', [StudentController::class, 'edit']);
// post -> update
Route::put('/students/{id}', [StudentController::class, 'update']);
// delete -> destroy
Route::delete('/students/{id}/delete', [StudentController::class, 'destroy']);
