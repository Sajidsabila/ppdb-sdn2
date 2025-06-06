<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\Admin\Ppdb\ListComponent;
use App\Livewire\Backend\Admin\User\UserComponent;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::delete('students/{id}', [ListComponent::class, 'destroy']);
Route::delete('user/{id}', [UserComponent::class, 'deleteUser']);
